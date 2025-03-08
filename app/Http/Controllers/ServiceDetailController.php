<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceDetail;
use Illuminate\Http\Request;

class ServiceDetailController extends Controller
{
    public function index()
    {
        return view("backend.service-detail.index", [
            "title" => "Service Detail",
            "service_details" => ServiceDetail::all(),
        ]);
    }

    public function create()
    {
        return view("backend.service-detail.create", [
            "title" => "Add Service Detail",
            "services" => Service::all(),
        ]);
    }

    public function store(Request $request)
    {
        ServiceDetail::create([
            "name" => $request->name,
            "service_id" => $request->service_id,
            "drop_in_price" => $request->drop_in_price,
            "price" => $request->price,
        ]);
        return redirect_user("success", "Successfully Added Service Detail", "admin.service-detail.index");
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $serviceDetail = ServiceDetail::find($id);
        return view("backend.service-detail.edit", [
            "title" => "Edit Service Detail",
            "services" => Service::all(),
            "service_detail" => $serviceDetail,
        ]);
    }

    public function update(Request $request, $id)
    {
        $serviceDetail = ServiceDetail::find($id);
        $serviceDetail->update([
            "name" => $request->name,
            "service_id" => $request->service_id,
            "drop_in_price" => $request->drop_in_price,
            "10_session_price" => $request->input("10_session_price"),
            "20_session_price" => $request->input("20_session_price"),
            "person_max" => $request->person_max,
        ]);
        return redirect_user("success", "Successfully Updated Service Detail", "admin.service-detail.index");
    }

    public function destroy($id)
    {
        $serviceDetail = ServiceDetail::find($id);
        $serviceDetail->delete();

        return redirect_user("success", "Successfully Deleted Service Detail", "admin.service-detail.index");
    }
}
