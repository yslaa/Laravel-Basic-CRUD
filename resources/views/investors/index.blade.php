@extends('layouts')

@section('contents')

<div class="pt-8 pb-4 px-8">
    <a href="investor/create" class="p-3 border-none italic text-white bg-black text-lg">
        Add a new Investor &rarr;
    </a>
</div>

<div class="py-3">
    <table class="table-auto">
        <tr class="text-white">
            <th class="w-screen text-3xl">Id</th>
            <th class="w-screen text-3xl">First Name</th>
            <th class="w-screen text-3xl">Last Name</th>
            <th class="w-screen text-3xl">Phone Number</th>
            <th class="w-screen text-3xl">Investor Pic</th>
            <th class="w-screen text-3xl">Update</th>
            <th class="w-screen text-3xl">Delete</th>
        </tr>

        @forelse ($investors as $investor)
        <tr>
            <td class=" text-center text-3xl">
                {{ $investor->id }}
            </td>
            <td class=" text-center text-3xl">
                {{ $investor->first_name }}
            </td>
            <td class=" text-center text-3xl">
                {{ $investor->last_name }}
            </td>
            <td class=" text-center text-3xl">
                {{ $investor->phone_number }}
            </td>
            <td class="pl-24">
                <img src="{{ asset('uploads/investors/'.$investor->images)}}" alt="I am A Pic" width="75" height="75">
            </td>
            <td class=" text-center">
                <a href="investor/{{ $investor->id }}/edit" class="text-center text-3xl bg-green-600 p-2">
                    Update &rarr;
                </a>
            </td>
            <td class=" text-center">
                {!! Form::open(array('route' => array('investor.destroy', $investor->id),'method'=>'DELETE')) !!}
                <button type="submit" class="text-center text-2xl bg-red-600 p-2 my-2">
                    Delete &rarr;
                </button>
                {!! Form::close() !!}
            </td>
        </tr>
        @empty
        <p>No investor Data in the Database</p>
        @endforelse
    </table>
</div>
</div>
@endsection