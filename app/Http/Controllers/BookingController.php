<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\ScheduleService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function storeBooking(Request $request)
    {
        try {
            // Validasi
            $request->validate([
                'service_id' => 'required|exists:services,id',
                'name' => 'required|string|max:255',
                'whatsapp' => 'required|regex:/^\d{10,15}$/',
                'payment_proof' => 'required|image|mimes:jpg,jpeg,png',
                'session' => 'required|in:morning,afternoon,evening',
                'date' => 'required|date'
            ]);

            // Cari schedule_id berdasarkan session
            $schedule = ScheduleService::where('session', $request->session)->first();
            if (!$schedule) {
                throw new \Exception("Invalid session selection");
            }

            // Hitung queue_number berdasarkan schedule_id dan booking_date yang sama
            $queueNumber = Booking::where('schedule_id', $schedule->id)
                ->where('booking_date', $request->date)
                ->count() + 1;

            $file = $request->file("payment_proof");
            $fileName = "PROOF_IMAGE_" . date("Ymdhis") . "." . $file->extension();
            $file->move(public_path("uploads/proof"), $fileName);

            // Simpan booking ke database
            $booking = new Booking();
            $booking->schedule_id = $schedule->id;
            $booking->service_id = $request->service_id;
            $booking->booking_date = $request->date;
            $booking->customer_name = $request->name;
            $booking->phone_number = $request->whatsapp;
            $booking->payment_proof = $fileName;
            $booking->queue_number = $queueNumber;
            $booking->status = "pending";
            $booking->save();

            return response()->json(['redirect_url' => route('services')]);
        } catch (\Exception $e) {
            // dd($e->getMessage());
            \Log::error('Error in storeBooking:', ['error' => $e->getMessage()]);
            return response()->json([
                'redirect_url' => route('services'),
                'queue_number' => $booking->queue_number // Pastikan queue_number dikirim
            ]);
        }
    }
}
