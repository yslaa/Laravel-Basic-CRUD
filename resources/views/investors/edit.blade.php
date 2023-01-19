@extends('layouts')

@section('contents')
    <div class="pb-20 my-5">
        <div class="text-center">
            <h1 class="text-5xl">
                Update Investor
            </h1>
        </div>
        <div>
            <div class="flex justify-center pt-4">
                {{ Form::model($investors, [
                    'route' => ['investor.update', $investors->id],
                    'method' => 'PUT',
                    'enctype' => 'multipart/form-data',
                ]) }}
                <div class="block">
                    <div>
                        <label for="first_name" class="text-lg">First Name</label>
                        {!! Form::text('first_name', $investors->first_name, ['class' => 'form-control']) !!}
                        @if ($errors->has('first_name'))
                            <p class="text-center text-red-500">{{ $errors->first('first_name') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="last_name" class="text-lg">Last_name</label>
                        {!! Form::text('last_name', $investors->last_name, ['class' => 'form-control']) !!}
                        @if ($errors->has('last_name'))
                            <p class="text-center text-red-500">{{ $errors->first('last_name') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="phone_number" class="text-lg">Phone Number</label>
                        {!! Form::text('phone_number', $investors->phone_number, ['class' => 'form-control']) !!}
                        @if ($errors->has('phone_number'))
                            <p class="text-center text-red-500">{{ $errors->first('phone_number') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="images" class="text-lg">Investor Pic</label>
                        <input type="file" class="block shadow-5xl p-2 w-full" name="images">
                        <img src="{{ asset('uploads/investors/' . $investors->images) }}" alt="I am A Pic" width="100"
                            height="100" class="ml-24 pb-2">
                        @if ($errors->has('images'))
                            <p class="text-center text-red-500">{{ $errors->first('images') }}</p>
                        @endif
                    </div>

                    <div class="grid grid-cols-2 gap-2 w-full">
                        {{ Form::submit('Submit', ['class' => 'btn btn-success btn-lg btn-block']) }}
                        <a href="{{ url()->previous() }}" class="bg-gray-800 text-white font-bold p-2 mt-5 text-center"
                            role="button">Cancel</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        @endsection
