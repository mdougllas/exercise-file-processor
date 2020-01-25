@extends('layout')

@section('title', 'Upload your file')

@section('content')
    <div class="flex flex-col">
        <div class="min-h-screen flex items-center justify-center">
            <div class="flex flex-col justify-around h-full">
                <div>
                    <h1 class="text-gray-600 text-center font-light tracking-wider text-5xl mb-6">
                        {{ config('app.name', 'Change app name on .env file') }}
                    </h1>
                    <h2 class="text-2xl text-gray-500 text-center mb-8">Upload your CSV file.</h2>
                <form class="flex flex-col items-center" action="{{ route('results') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="file" name="file" accept="text/csv" class="w-64 mb-8 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-white hover:bg-green-500">
                        <button type="submit" class="bg-white text-gray-800 font-bold rounded border-b-2 border-green-500 hover:border-green-600 hover:bg-green-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                            <span class="mr-2">Send</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                              <path fill="currentcolor" d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"></path>
                            </svg>
                        </button>
                        @if ($errors->any())
                            <div class="mt-8 text-red-500 font-bold">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection
