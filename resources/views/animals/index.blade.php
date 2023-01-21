@extends('layouts')

@section('contents')
    <div class="container">
        <br />
        @if (Session::has('success'))
            <div class="alert alert-success">
                <p>{{ Session::get('success') }}</p>
            </div><br />
        @endif
    </div>
    <div class="pt-8 pb-4 px-8">
        <a href="animal/create" class="p-3 border-none italic text-white bg-black text-lg">
            Add a new animal &rarr;
        </a>
    </div>

    <div class="py-3 text-white">
        <table class="table-auto">
            <tr class="text-center">
                <th class="w-screen text-3xl">Animal Id</th>
                <th class="w-screen text-3xl">Animal Name</th>
                <th class="w-screen text-3xl">Animal Type</th>
                <th class="w-screen text-3xl">Age</th>
                <th class="w-screen text-3xl">Gender</th>
                <th class="w-screen text-3xl">Owner</th>
                <th class="w-screen text-3xl">Animal Pic</th>
                <th class="w-screen text-3xl">Update</th>
                <th class="w-screen text-3xl">Delete</th>
                <th class="w-screen text-3xl">Restore</th>
                <th class="w-screen text-3xl">Destroy</th>
            </tr>

            @forelse ($animals as $animal)
                <tr>
                    @if ($animal->deleted_at)
                        <td class="text-center text-3xl">
                            <a href="#">{{ $animal->id }}</a>
                        </td>
                    @else
                        <td class="text-center text-3xl">
                            <a href="{{ route('animal.show', $animal->id) }}">{{ $animal->id }}</a>
                        </td>
                    @endif

                    <td class="text-center text-3xl">
                        {{ $animal->animal_name }}
                    </td>
                    <td class="text-center text-3xl">
                        {{ $animal->animal_type }}
                    </td>
                    <td class="text-center text-3xl">
                        {{ $animal->age }}
                    </td>
                    <td class="text-center text-3xl">
                        {{ $animal->gender }}
                    </td>
                    <td class="text-center text-3xl">
                        {{ $animal->first_name }}
                    </td>
                    <td class="pl-6">
                        <img src="{{ asset('uploads/animals/' . $animal->images) }}" alt="I am A Pic" width="75"
                            height="75">
                    </td>

                    @if ($animal->deleted_at)
                        <td class="text-center">
                            <a href="#">
                                <p class="text-center text-2xl bg-green-600 p-2">
                                    Update
                                </p>
                            </a>
                        </td>
                    @else
                        <td>
                            <a href="animal/{{ $animal->id }}/edit" class="text-center text-2xl bg-green-600 p-2">
                                Update &rarr;
                            </a>
                        </td>
                    @endif

                    <td class=" text-center">
                        {!! Form::open(['route' => ['animal.destroy', $animal->id], 'method' => 'DELETE']) !!}
                        <button type="submit" class="text-center text-lg bg-red-600 p-2">
                            Delete &rarr;
                        </button>
                        {!! Form::close() !!}
                    </td>

                    @if ($animal->deleted_at)
                        <td>
                            <a href="{{ route('animal.restore', $animal->id) }}">
                                <p class="text-center text-red-700 text-lg bg-purple-500 p-2 mx-3">
                                    Restore
                                </p>
                            </a>
                        </td>
                    @else
                        <td>
                            <a href="#">
                                <p class="text-center text-lg bg-purple-500 p-2 mx-3">
                                    Restore &rarr;
                                </p>
                            </a>
                        </td>
                    @endif

                    <td>
                        <a href="{{ route('animal.forceDelete', $animal->id) }}">
                            <p class="text-center text-lg bg-sky-500 p-2 mx-3"
                                onclick="return confirm('Do you want to delete this data permanently?')">
                                Destroy &rarr;
                            </p>
                        </a>
                    </td>
                </tr>
            @empty
                <p>No Animals Data in the Database</p>
            @endforelse
        </table>
    </div>
@endsection
