@extends('layouts')

@section('contents')
    <div class="pb-20 my-5">
        <div class="text-center">
            <h1 class="text-5xl">
                Update Customer
            </h1>
        </div>
        <div>
            <div class="flex justify-center pt-4">
                <form action="/customer/{{ $customers->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="block">
                        <div>
                            <label for="first_name" class="text-lg">First Name</label>
                            <input type="text" class="block shadow-5xl p-2 my-5 w-full" name="first_name"
                                value="{{ $customers->first_name }}">
                            @if ($errors->has('first_name'))
                                <p class="text-center text-red-500">{{ $errors->first('first_name') }}</p>
                            @endif
                        </div>

                        <div>
                            <label for="last_name" class="text-lg">Last_name</label>
                            <input type="text" class="block shadow-5xl p-2 my-5 w-full" name="last_name"
                                value="{{ $customers->last_name }}">
                            @if ($errors->has('last_name'))
                                <p class="text-center text-red-500">{{ $errors->first('last_name') }}</p>
                            @endif
                        </div>

                        <div>
                            <label for="phone_number" class="text-lg">Phone Number</label>
                            <input type="text" class="block shadow-5xl p-2 my-5 w-full" name="phone_number"
                                value="{{ $customers->phone_number }}">
                            @if ($errors->has('phone_number'))
                                <p class="text-center text-red-500">{{ $errors->first('phone_number') }}</p>
                            @endif
                        </div>

                        <div>
                            <label for="images" class="text-lg">customer Pic</label>
                            <input type="file" class="block shadow-5xl p-2 w-full" name="images">
                            <img src="{{ asset('uploads/customers/' . $customers->images) }}" alt="I am A Pic" width="100"
                                height="100" class="ml-24 pb-2">
                            @if ($errors->has('images'))
                                <p class="text-center text-red-500">{{ $errors->first('images') }}</p>
                            @endif
                        </div>

                        <div class="grid grid-cols-2 gap-2 w-full">
                            <button type="submit" class="bg-green-800 text-white font-bold p-2 mt-5">
                                Submit
                            </button>
                            <a href="{{ url()->previous() }}" class="bg-gray-800 text-white font-bold p-2 mt-5 text-center"
                                role="button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        @endsection
