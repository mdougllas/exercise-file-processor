@extends('layout')

@section('title', 'Your Results')

@section('content')
    <div class="flex flex-col">
        <div class="min-h-screen flex items-center justify-center">
            <div class="flex flex-col justify-around h-full">
                <div>
                    <h1 class="text-gray-600 text-center font-light tracking-wider text-5xl mb-6">
                        {{ config('app.name', 'Change app name on .env file') }}
                    </h1>
                    <h2 class="text-2xl text-gray-500 text-center mb-8">These are the results for your file.</h2>
                    {{ $data->sku }}
                </div>
            </div>
        </div>
    </div>
@endsection
