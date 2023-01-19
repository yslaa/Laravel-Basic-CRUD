<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\Investor;

class investorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $investors = investor::all();
       return view("investors.index", [
        "investors" => $investors,
    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view::make("investors.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $investors = new investor();
        $investors->first_name = $request->input("first_name");
        $investors->last_name = $request->input("last_name");
        $investors->phone_number = $request->input("phone_number");
        if ($request->hasfile("images")) {
            $file = $request->file("images");
            $filename = $file->getClientOriginalName();
            $file->move("uploads/investors/", $filename);
            $investors->images = $filename;
        }
        $investors->save();
        return Redirect::to("investor");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $investors = DB::table('investors')
        //     ->select('investors.id', 'investors.first_name', 'investors.last_name', 'investors.phone_number', 'investors.images')
        //     ->where('investors.id', $id)
        //     ->get();

        // return View::make('investors.show', compact('investors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $investors = investor::find($id);
        return view::make("investors.edit", compact("investors"));
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
        $investors = investor::find($id);
        $investors->first_name = $request->input("first_name");
        $investors->last_name = $request->input("last_name");
        $investors->phone_number = $request->input("phone_number");
        if ($request->hasfile("images")) {
            $destination = "uploads/investors/" . $investors->images;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("images");
            $filename = $file->getClientOriginalName();
            $file->move("uploads/investors/", $filename);
            $investors->images = $filename;
        }
        $investors->update();
        return Redirect::to("investor");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $investors = investor::find($id);
        $destination = 'uploads/investors/'.$investors->images;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $investors->delete();
        return Redirect::to("investor");
    }
}