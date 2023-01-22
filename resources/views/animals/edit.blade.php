@extends('layouts')

@section('contents')
    <div class="pb-20 my-2">
        <div class="text-center">
            <h1 class="text-5xl">
                Update Animals
            </h1>
        </div>
        <div>
            <div class="flex justify-center pt-4">
                {{ Form::model($animals, [
                    'route' => ['animal.update', $animals->id],
                    'method' => 'PUT',
                    'enctype' => 'multipart/form-data',
                ]) }}
                <div class="block">
                    <div>
                        <label for="animal_name" class="text-lg">Animal Name</label>
                        {{ Form::text('animal_name', null, [
                            'class' => 'block shadow-5xl p-2 my-2 w-full',
                            'id' => 'animal_name',
                        ]) }}
                        @if ($errors->has('animal_name'))
                            <p class="text-center text-red-500">{{ $errors->first('animal_name') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="animal_type" class="text-lg">Animal Type</label>
                        {{ Form::text('animal_type', null, [
                            'class' => 'block shadow-5xl p-2 my-2
                                                                    w-full',
                            'id' => 'animal_type',
                        ]) }}
                        @if ($errors->has('animal_type'))
                            <p class="text-center text-red-500">{{ $errors->first('animal_type') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="age" class="text-lg">Age</label>
                        {{ Form::text('age', null, ['class' => 'block shadow-5xl p-2 my-2 w-full', 'id' => 'age']) }}
                        @if ($errors->has('age'))
                            <p class="text-center text-red-500">{{ $errors->first('age') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="gender" class="text-lg">Gender</label>
                        {{ Form::text('gender', null, ['class' => 'block shadow-5xl p-2 my-2 w-full', 'id' => 'gender']) }}
                        @if ($errors->has('gender'))
                            <p class="text-center text-red-500">{{ $errors->first('gender') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="images" class="block text-lg pb-3">Animal Pic</label>
                        {{ Form::file('images', null, ['class' => 'block shadow-5xl p-2 my-2 w-full', 'id' => 'images']) }}
                        <img src="{{ asset('uploads/animals/' . $animals->images) }}" alt="I am A Pic" width="100"
                            height="100" class="ml-24 py-2">
                        @if ($errors->has('images'))
                            <p class="text-center text-red-500">{{ $errors->first('images') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="customer_id" class="text-lg">Owner</label>
                        {!! Form::select('customer_id', $customers, $animals->customer_id, [
                            'class' => 'block shadow-5xl p-2
                                                                    my-2
                                                                    w-full',
                        ]) !!}
                        @if ($errors->has('customer_id'))
                            <p class="text-center text-red-500">{{ $errors->first('customer_id') }}</p>
                        @endif
                    </div>

                    <div class="grid grid-cols-2 gap-2 w-full">
                        {{ Form::submit('Submit', ['class' => 'btn bg-green-500 p-2 mt-5 btn-lg btn-block']) }}
                        <a href="{{ url()->previous() }}" class="bg-gray-800 text-white font-bold p-2 mt-5 text-center"
                            role="button">Cancel</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        @endsection
