<?php

use App\Models\Service;
use App\Models\ServiceDetail;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

if (!function_exists("setNotification")) {
    function setNotification($icon, $title, $text)
    {
        return [
            "icon" => $icon,
            "title" => $title,
            "text" => $text,
        ];
    }
}

if (!function_exists("getMenuSidebar")) {
    function getMenuSidebar()
    {
        if (Auth::check()) {
            return Menu::where("role", Auth::user()->role)->get();
        }
        return;
    }
}

if (!function_exists("active_sidebar")) {
    function active_sidebar($url)
    {
        return request()->is($url) || request()->is($url . '/*') ? 'text-white bg-stone-600' : 'text-gray-700 hover:bg-gray-100';
    }
}

if (!function_exists("redirect_user")) {
    function redirect_user(
        $icon,
        $text,
        $route = "",
    ) {
        return $route != ""
            ? redirect()->route($route)->with("notification", [
                "icon" => $icon,
                "title" => $icon == "success" ? "Success" : "Error",
                "text" => $text,
            ])
            : redirect()->back()->with("notification", [
                "icon" => $icon,
                "title" => $icon == "success" ? "Success" : "Error",
                "text" => $text,
            ]);
    }
}

if (!function_exists("notificationFlash")) {
    function notificationFlash($icon, $text)
    {
        session()->flash("notification", [
            "icon" => $icon,
            "title" => $icon == "success" ? "Success" : "Error",
            "text" => $text,
        ]);
    }
}

if (!function_exists("format_rupiah")) {
    function format_rupiah($number)
    {
        $formattedNumber = number_format($number, 0, ',', '.');
        return 'Rp ' . $formattedNumber;
    }
}

if (!function_exists("format_date")) {
    function format_date($date)
    {
        return date('l, d F Y - H:i:s', strtotime($date));
    }
}

if (!function_exists("getPlanLabel")) {
    function getPlanLabel($service_id, $service_detail_id)
    {
        $service = Service::find($service_id);
        $service_detail = ServiceDetail::find($service_detail_id);
        return $service->name . " - " . $service_detail->name;
    }
}

if (!function_exists("generateDate")) {
    function generateDate()
    {
        $currentYear = date('Y');
        $currentMonth = date('n');
        $years = [$currentYear, $currentYear + 1];

        $calendarData = [];
        $allDates = []; // Tambahkan array untuk menyimpan daftar tanggal

        foreach ($years as $year) {
            $startMonth = ($year == $currentYear) ? $currentMonth : 1;

            for ($month = $startMonth; $month <= 12; $month++) {
                $carbonDate = Carbon::createFromDate($year, $month, 1);
                $monthName = $carbonDate->translatedFormat('F');
                $daysInMonth = $carbonDate->daysInMonth;
                $firstDayOfWeek = $carbonDate->dayOfWeek;

                $calendarData[$year][$monthName] = [
                    'days' => range(1, $daysInMonth),
                    'startDay' => $firstDayOfWeek
                ];

                for ($day = 1; $day <= $daysInMonth; $day++) {
                    $dateString = Carbon::createFromDate($year, $month, $day)->format('Y-m-d');
                    $allDates[] = $dateString;
                }
            }
        }

        return [
            "years" => $years,
            "calendarData" => $calendarData,
            "allDates" => $allDates, 
        ];
    }
}
