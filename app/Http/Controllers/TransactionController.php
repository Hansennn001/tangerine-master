<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\ScheduleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Booking::select(
            'bookings.id',
            'bookings.customer_name',
            'services.name as service_name',
            'services.price as service_price',
            'bookings.booking_date',
            'schedule_services.session as session',
            'bookings.queue_number',
            'bookings.created_at',
            'bookings.status',
            'bookings.payment_proof',
            'bookings.phone_number',
        )
            ->join('services', 'bookings.service_id', '=', 'services.id')
            ->join('schedule_services', 'bookings.schedule_id', '=', 'schedule_services.id')
            ->orderBy('bookings.created_at', 'desc')
            ->get();


        return view("backend.transaction.index", [
            "title" => "Transaction",
            "transactions" => $transactions,
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $user_id = Auth::user()->id;

            $newTransaction = Booking::create([
                "customer_name" => $request->customer_name,
                "service_id" => $request->service_id,
                "schedule_id" => $request->schedule_id,
                "booking_date" => $request->booking_date,
                "queue_number" => $request->queue_number,
                "payment_status" => "waiting",
            ]);

            DB::commit();
            return response()->json(["redirect_url" => route("payment.waiting", $newTransaction->id)]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["redirect_url" => "", "message" => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $transaction = Booking::findOrFail($id);
            $transaction->update([
                "status" => $request->status // Sekarang bisa 'confirmed' atau 'cancelled'
            ]);
    
            DB::commit();
            notificationFlash("success", "Successfully updated transaction status.");
            return response()->json(["success" => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            notificationFlash("error", $e->getMessage());
            return response()->json(["success" => false, "message" => $e->getMessage()]);
        }
    }
    



    public function show($id)
    {
        $transaction = Booking::select(
            'bookings.customer_name',
            'services.name as service',
            'services.price',
            'bookings.booking_date',
            'schedule_services.session',
            'bookings.queue_number',
            'bookings.created_at',
            'bookings.payment_status'
        )
            ->join('services', 'bookings.service_id', '=', 'services.id')
            ->join('schedule_services', 'bookings.schedule_id', '=', 'schedule_services.id')
            ->where('bookings.id', $id)
            ->first();

        return response()->json([
            "html" => view("components.modal-detail-transaction", [
                "transaction" => $transaction,
            ])->render(),
        ]);
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $transaction = Booking::findOrFail($id);
            $transaction->delete();

            DB::commit();
            notificationFlash("success", "Transaction successfully deleted");
            return response()->json(["success" => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            notificationFlash("error", "Failed to delete transaction: " . $e->getMessage());
            return response()->json(["success" => false]);
        }
    }

    public function upload_proof(Request $request)
    {
        $transaction = Booking::findOrFail($request->transaction_id);
        if ($request->hasFile("proof_of_payment")) {
            $file = $request->file("proof_of_payment");
            $fileName = "PROOF_IMAGE_" . date("Ymdhis") . "_" . Str::random(10) . "." . $file->extension();
            $file->move(public_path("uploads/proofs"), $fileName);

            $transaction->update([
                "proof_of_payment" => $fileName,
                "payment_status" => "paid",
            ]);

            notificationFlash("success", "Successfully Upload Proof");
            return response()->json(["success" => true]);
        }

        notificationFlash("error", "No file uploaded");
        return response()->json(["success" => false]);
    }
}
