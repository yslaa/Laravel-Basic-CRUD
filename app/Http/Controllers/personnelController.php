<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\personnel;

class personnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $personnels = Personnel::all();
       return view("personnels.index", [
        "personnels" => $personnels,
    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view::make("personnels.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $personnels = new Personnel();
        $personnels->first_name = $request->input("first_name");
        $personnels->last_name = $request->input("last_name");
        $personnels->phone_number = $request->input("phone_number");
        if ($request->hasfile("images")) {
            $file = $request->file("images");
             $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("uploads/personnels/", $filename);
            $personnels->images = $filename;
        }
        $personnels->save();
        return Redirect::to("personnel");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $personnels = DB::table('personnels')
        //     ->select('personnels.id', 'personnels.first_name', 'personnels.last_name', 'personnels.phone_number', 'personnels.images')
        //     ->where('personnels.id', $id)
        //     ->get();

        // return View::make('personnels.show', compact('personnels'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $personnels = Personnel::find($id);
        return view::make("personnels.edit", compact("personnels"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $personnels = Personnel::find($id);
        $personnels->first_name = $request->input("first_name");
        $personnels->last_name = $request->input("last_name");
        $personnels->phone_number = $request->input("phone_number");
        if ($request->hasfile("images")) {
            $destination = "uploads/personnels/" . $personnels->images;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("images");
             $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("uploads/personnels/", $filename);
            $personnels->images = $filename;
        }
        $personnels->update();
        return Redirect::to("personnel");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $personnels = Personnel::find($id);
        $destination = 'uploads/personnels/'.$personnels->images;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $personnels->delete();
        return Redirect::to("personnel");
    }
}