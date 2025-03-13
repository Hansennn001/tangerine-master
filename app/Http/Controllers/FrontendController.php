<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceDetail;
use App\Models\Room;
use App\Models\Beautician;
use App\Models\Transaction;
use App\Models\Product;
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
    return view('frontend.service-detail', [ 
        "title" => "Services",
        "service" => $service, 
        "Beauticians" => Service::all(),
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
