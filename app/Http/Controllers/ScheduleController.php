<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceDetail;
use App\Models\Member;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\Trainer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{

    public function index()
    {
        $currentYear = date('Y');
        $years = [$currentYear, $currentYear + 1, $currentYear + 2];

        $months = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ];

        $calendarData = [];

        foreach ($years as $year) {
            foreach ($months as $index => $month) {
                $monthNumber = $index + 1;
                $daysInMonth = Carbon::createFromDate($year, $monthNumber, 1)->daysInMonth;
                $firstDayOfWeek = Carbon::createFromDate($year, $monthNumber, 1)->dayOfWeek;

                $calendarData[$year][$month] = [
                    'days' => range(1, $daysInMonth),
                    'startDay' => $firstDayOfWeek
                ];
            }
        }

        return view("frontend.schedule", [
            "title" => "Schedule",
            "schedules" => Schedule::all(),
            "years" => $years,
            "months" => $months,
            "calendarData" => $calendarData,
            "trainers" => Trainer::all(),
        ]);
    }

    public function create()
    {
        return view("backend.schedule.create", [
            "title" => "Add Schedule",
            "services" => Service::all(),
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $plan = $request->plan;
            $service_name = trim(explode(" - ", $plan)[0]);
            $service_detail_name = trim(explode(" - ", $plan)[1]);
            $service_detail = ServiceDetail::where('name', $service_detail_name)->whereHas("service", function ($query) use ($service_name) {
                $query->where('name', $service_name);
            })->first();

            $newSchedule = [
                'member_id' => $request->member_id,
                'room_id' => $request->room_id,
                'service_detail_id' => $service_detail->id,
                'service_id' => $service_detail->service_id,
                'trainer_id' => $request->trainer_id,
                'date' => $request->date,
                'time' => $request->time,
            ];
            Schedule::create($newSchedule);
            DB::commit();
            notificationFlash("success", "Successfully Add Schedule");
            return response()->json(["success" => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            notificationFlash("error", $e->getMessage());
            return response()->json(["success" => false]);
        }
    }

    public function show($date)
    {
        try {
            $selectedDate = Carbon::createFromFormat('Y-m-d', $date);
        } catch (\Exception $e) {
            abort(404, 'Tanggal tidak valid');
        }

        $hours = range(6, 20);
        $dateFormatted = $selectedDate->isoFormat('dddd, D MMMM Y');
        $schedules = Schedule::where('date', $date)->get();

        return view("backend.schedule.show", [
            "title" => "Schedule Detail at {$dateFormatted}",
            "selectedDate" => $selectedDate,
            "hours" => $hours,
            "rooms" => Room::all(),
            "trainers" => Trainer::all(),
            "members" => Member::all(),
            "schedules" => $schedules,
        ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
