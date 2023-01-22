@extends('layouts')

@section('contents')
    <div class="pb-20 my-2">
        <div class="text-center">
            <h1 class="text-5xl">
                Show Animals
            </h1>
        </div>
        @forelse ($animals as $animal)
            <section class="flex flex-wrap justify-center gap-3 p-12 w-full">
                <div
                    class="max-w-sm bg-white rounded-lg border border-white-200 shadow-md dark:bg-white-800 dark:border-white-700">
                    <img src="{{ asset('uploads/animals/' . $animal->images) }}" alt="I am A Pic" width="400"
                        style="max-height: 12rem;">
                    <div class="p-3">
                        <h5 class="mb-2 text-2xl font-bold text-center tracking-tight">{{ $animal->animal_name }}
                        </h5>
                        ID<p class="mb-2 text-lg font-bold">{{ $animal->id }}</p>
                        Age<p class="mb-2 text-lg font-bold">{{ $animal->age }}</p>
                        Gender<p class="mb-2 text-lg font-bold">{{ $animal->gender }}</p>
                        Type<p class="mb-2 text-lg font-bold">{{ $animal->animal_type }}</p>
                        Owner<p class="mb-2 text-lg font-bold">{{ $animal->first_name }}</p>
                    </div>
                </div>
            </section>
            <a href="{{ url()->previous() }}" class="bg-gray-800 text-white font-bold p-2 mt-5 text-center"
                            role="button">Back</a>
        @empty
            <p>No Animal Data in the Database</p>
        @endforelse
        </table>
    @endsection
