<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceDetail;
use Illuminate\Http\Request;

class ServiceDetailController extends Controller
{

    public function index()
{
    $categories = \App\Models\Category::with([
        'services' => function ($query) {
            $query->select('id', 'category_id', 'name', 'price'); 
        }
    ])->get();

    return view("backend.service-detail.index", [
        "title" => "Service Detail by Category",
        "categories" => $categories,
    ]);
}

    

    public function create()
{
    return view("backend.service-detail.create", [
        "title" => "Add Service Detail",
        "services" => Service::select('id', 'name', 'price')->get(),
    ]);
}


    public function store(Request $request)
    {
        ServiceDetail::create([
            "name" => $request->name,
            "service_id" => $request->service_id,
        ]);
        return redirect_user("success", "Successfully Added Service Detail", "admin.service-detail.index");
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
{
    $serviceDetail = ServiceDetail::findOrFail($id);
    $services = Service::select('id', 'name', 'price')->get(); // Hanya ambil yang dibutuhkan

    return view("backend.service-detail.edit", [
        "title" => "Edit Service Detail",
        "services" => $services,
        "service_detail" => $serviceDetail,
    ]);
}


    public function update(Request $request, $id)
    {
        $serviceDetail = ServiceDetail::find($id);
        $serviceDetail->update([
            "name" => $request->name,
            "service_id" => $request->service_id,
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
