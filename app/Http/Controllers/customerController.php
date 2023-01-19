<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use File;
use View;
use DB;
use App\Models\Customer;

class customerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $customers = Customer::all();
       return view("customers.index", [
        "customers" => $customers,
    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view::make("customers.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Customers = new Customer();
        $Customers->first_name = $request->input("first_name");
        $Customers->last_name = $request->input("last_name");
        $Customers->phone_number = $request->input("phone_number");
        if ($request->hasfile("images")) {
            $file = $request->file("images");
            $filename = $file->getClientOriginalName();
            $file->move("uploads/customers/", $filename);
            $Customers->images = $filename;
        }
        $Customers->save();
        return Redirect::to("customer");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $customers = DB::table('customers')
        //     ->select('customers.id', 'customers.first_name', 'customers.last_name', 'customers.phone_number', 'customers.images')
        //     ->where('customers.id', $id)
        //     ->get();

        // return View::make('customers.show', compact('customers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = Customer::find($id);
        return view::make("customers.edit", compact("customers"));
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
        $customers = Customer::find($id);
        $customers->first_name = $request->input("first_name");
        $customers->last_name = $request->input("last_name");
        $customers->phone_number = $request->input("phone_number");
        if ($request->hasfile("images")) {
            $destination = "uploads/customers/" . $customers->images;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("images");
            $filename = $file->getClientOriginalName();
            $file->move("uploads/customers/", $filename);
            $customers->images = $filename;
        }
        $customers->update();
        return Redirect::to("customer");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customers = Customer::find($id);
        $destination = 'uploads/customers/'.$customers->images;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $customers->delete();
        return Redirect::to("customer");
    }
}