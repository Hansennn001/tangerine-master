<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceDetail;
use App\Models\Member;
use App\Models\MemberPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    public function index()
    {
        return view("backend.member.index", [
            "title" => "Member",
            "members" => MemberPlan::latest()->get(),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request) {}

    public function checkout(Request $request)
    {
        $user_id = Auth::user()->id;
        $service_id = $request->service_id;
        $service_detail_id = explode("#", $request->plan)[0];
        $service_detail_name = ServiceDetail::find($service_detail_id)->name;
        $service_detail_type = explode("#", $request->plan)[1];
        $service_label_taken = Service::find($service_id)->name . " - " . $service_detail_name . " - " .  Str::replace("Price", "", Str::headline(str_replace('_', ' ', $service_detail_type)));
        $total = ServiceDetail::find($service_detail_id)[$service_detail_type];
        session()->put("checkout_{$user_id}", [
            'user_id' => Auth::user()->id,
            'trainer_id' => $request->trainer,
            "service_id" => $service_id,
            "service_detail_id" => $service_detail_id,
            "service_detail_name" => $service_detail_name,
            "service_detail_type" => $service_detail_type,
            "service_label_taken" => $service_label_taken,
            "total" => $total,
        ]);

        return response()->json([
            "redirect_url" => route("member.checkout"),
        ]);
    }

    public function show($id)
    {
        $member = Member::find($id);
        return response()->json($member->memberPlans);
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
