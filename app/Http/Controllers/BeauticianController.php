<?php

namespace App\Http\Controllers;

use App\Models\Beautician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use phpseclib3\Math\BinaryField;

class BeauticianController extends Controller
{
    public function index()
    {
        return view('backend.beautician.index', [
            "title" => "Beautician",
            "beauticians" => Beautician::all(),
        ]);
    }

    public function create()
    {
        return view('backend.beautician.create', [
            "title" => "Add Beautician",
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $file = $request->file("image");
            $fileName = "BEAUTICIAN_IMAGE_" . date("Ymdhis") . "." . $file->extension();
            $file->move(public_path("uploads/beauticians"), $fileName);
            Beautician::create([
                "name" => $request->name,
                "description" => $request->description,
                "image" => $fileName,
                "facebook_link" => $request->facebook_link,
                "instagram_link" => $request->instagram_link,
                "twitter_link" => $request->twitter_link,
            ]);
            DB::commit();
            return redirect_user("success", "Successfully Add Beautician", "admin.Beautician.index");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect_user("error", $e->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $beautician = Beautician::find($id);
        return view('backend.beautician.edit', [
            "title" => "Edit Beautician {$beautician->name}",
            "beautician" => $beautician,
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $beautician = Beautician::find($id);
        $updatedData = [
            "name" => $request->name,
            "description" => $request->description,
            "facebook_link" => $request->facebook_link,
            "instagram_link" => $request->instagram_link,
            "twitter_link" => $request->twitter_link,
        ];
        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $fileName = "BEAUTICIAN_IMAGE_" . date("Ymdhis") . "." . $file->extension();
            $file->move(public_path("uploads/beauticians"), $fileName);
            if (File::exists(public_path("uploads/beauticians/{$beautician->image}"))) {
                unlink(public_path("uploads/beauticians/{$beautician->image}"));
            }
            $updatedData["image"] = $fileName;
        }
        try {
            $beautician->update($updatedData);
            DB::commit();
            return redirect_user("success", "Successfully Edit Beautician", "admin.beautician.index");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect_user("error", $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $beautician = beautician::find($id);
            $beautician->delete();

            notificationFlash("success", "Successfully Deleted Beautician");
            return response()->json([
                "success" => true,
            ]);
        } catch (\Exception $e) {
            notificationFlash("success", $e->getMessage());
            return response()->json([
                "success" => false,
            ]);
        }
    }
}
