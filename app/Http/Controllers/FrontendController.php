<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceDetail;
use App\Models\Room;
use App\Models\Beautician;
use App\Models\Booking;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\ScheduleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function home()
    {
        return view('frontend.welcome', [
            "title" => "Home",
            "services" => Service::all(),
        ]);
    }


    public function about()
    {
        return view('frontend.about', [
            "title" => "About Us",
        ]);
    }

    public function beautician()
    {
        return view('frontend.beautician', [
            "title" => "Beautician",
            "beauticians" => Beautician::all(),
        ]);
    }

    public function services()
    {
        return view('frontend.services', [
            "title" => "Services",
            "services" => Service::all(),
        ]);
    }


    public function service_detail($slug)
    {
        $service = Service::firstWhere("slug", $slug);
        $years = generateDate()["years"];
        $calendarData = generateDate()["calendarData"];
        $allDates = generateDate()["allDates"]; // Ambil daftar tanggal yang benar

        // Ambil semua sesi yang tersedia
        $allSchedules = ScheduleService::pluck('id')->toArray(); // [1, 2, 3]

        // Ambil daftar booking yang sudah ada
        $bookedSessions = Booking::select('booking_date', 'schedule_id')
            ->groupBy('booking_date', 'schedule_id')
            ->havingRaw('COUNT(id) >= 3') // Sesi yang sudah penuh
            ->get()
            ->groupBy('booking_date')
            ->map(function ($items) {
                return $items->pluck('schedule_id')->toArray();
            });

        // Format data availableSessions
        $availableSessions = [];
        foreach ($allDates as $date) {
            // Jika tidak ada booking pada tanggal tersebut, semua sesi tersedia
            if (!isset($bookedSessions[$date])) {
                $availableSessions[$date] = $allSchedules;
            } else {
                // Ambil sesi yang belum penuh
                $availableSessions[$date] = array_diff($allSchedules, $bookedSessions[$date]);
            }
        }

        return view('frontend.service-detail', [
            "title" => "Services",
            "service" => $service,
            "Beauticians" => Service::all(),
            "years" => $years,
            "calendarData" => $calendarData,
            "availableSessions" => $availableSessions,
        ]);
    }

    public function checkout()
    {
        return view("frontend.checkout", [
            "title" => "Checkout",
        ]);
    }

    public function payment_waiting($invoice)
    {
        return view("frontend.payment-waiting", [
            "title" => "Payment Waiting",
            "transaction" => Transaction::firstWhere("invoice", $invoice)
        ]);
    }

    public function product()
    {
        return view('frontend.product', [
            "title" => "product",
            "products" => Product::all(),
        ]);
    }
}
