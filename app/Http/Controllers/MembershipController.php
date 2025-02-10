<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;
use App\Models\Club;

class MembershipController extends Controller
{
    public function index()
    {
        $clubs = Club::all();
        return view('membership', compact('clubs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'email' => 'required|email|unique:memberships,email',
            'phone' => 'required|string|max:15',
            'club' => 'nullable|exists:clubs,id',
            'terms' => 'accepted',
            'health_declaration' => 'accepted',
        ]);

        Membership::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'dob' => $request->dob,
            'email' => $request->email,
            'phone' => $request->phone,
            'club_id' => $request->club,
        ]);

        return redirect()->route('membership')->with('success', 'Registration successful!');
    }
}
