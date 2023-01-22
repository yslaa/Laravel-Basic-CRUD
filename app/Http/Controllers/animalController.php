<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\animal;
use App\Models\customer;

class animalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $animals = Animal::join(
            "customers",
            "customers.id",
            "=",
            "animals.customer_id"
        )
            ->select(
                "customers.first_name",
                "animals.id",
                "animals.animal_name",
                "animals.animal_type",
                "animals.age",
                "animals.gender",
                "animals.images",
                "animals.customer_id",
                "animals.deleted_at"
            )
            ->orderBy("animals.id", "DESC")
            ->withTrashed() //onlyTrashed withTrashed withoutTrashed
            ->get();

        return view("animals.index", ["animals" => $animals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = customer::pluck("first_name", "id");
        return view("animals.create", [
            "customers" => $customers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "animal_name" => ["required", "min:3", "max:12"],
            "animal_type" => ["required", "min:3", "max:12"],
            "age" => ["required", "numeric", "min:1", "max:100"],
            "gender" => ["required"],
            "images" => ["required","image","mimes:jpeg,png,jpg,gif,svg","max:2048"],
        ]);

        $animals = new animal();
        $animals->animal_name = $request->input("animal_name");
        $animals->animal_type = $request->input("animal_type");
        $animals->age = $request->input("age");
        $animals->gender = $request->input("gender");
        $animals->customer_id = $request->input("customer_id");
        if ($request->hasfile("images")) {
            $file = $request->file("images");
             $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("uploads/animals/", $filename);
            $animals->images = $filename;
        }
        $animals->save();
        return Redirect::to("animal")->with('success',
            "New Animal Added!"
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $animals = Animal::join(
            "customers",
            "customers.id",
            "=",
            "animals.customer_id"
        )
            ->select(
                "customers.first_name",
                "animals.id",
                "animals.animal_name",
                "animals.animal_type",
                "animals.age",
                "animals.gender",
                "animals.images",
                "animals.customer_id",
                "animals.deleted_at"
            )
            ->where('animals.id', $id)
            ->get();

        return View::make('animals.show', compact('animals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $animals = Animal::find($id);
        $customers = Customer::pluck("first_name", "id");
        return view("animals.edit", [
            "animals" => $animals,
            "customers" => $customers,
        ]);
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

        $request->validate([
            "animal_name" => ["required", "min:3", "max:12"],
            "animal_type" => ["required", "min:3", "max:12"],
            "age" => ["required", "numeric", "min:1", "max:100"],
            "gender" => ["required"],
            "images" => ["required","image","mimes:jpeg,png,jpg,gif,svg","max:2048"],
        ]);

        $animals = animal::find($id);
        $animals->animal_name = $request->input("animal_name");
        $animals->animal_type = $request->input("animal_type");
        $animals->age = $request->input("age");
        $animals->gender = $request->input("gender");
        $animals->customer_id = $request->input("customer_id");
        if ($request->hasfile("images")) {
            $destination = "uploads/animals/" . $animals->images;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("images");
             $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("uploads/animals/", $filename);
            $animals->images = $filename;
        }
        $animals->update();
        return Redirect::to("animal")->with('success',
            "Animal Updated!"
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        animal::destroy($id);
        return Redirect::to("animal")->with('success',
            "Animal Deleted!"
        );
    }

     public function restore($id)
    {
        animal::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("animal.index")->with('success',
            "Animal Restored!"
        );
    }

    public function forceDelete($id)
    {
        $animals = animal::findOrFail($id);
        $destination = "uploads/animals/" . $animals->images;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $animals->forceDelete();
        return Redirect::route("animal.index")->with('success',
            "Animal Data Permanently Deleted!"
        );
    }
}