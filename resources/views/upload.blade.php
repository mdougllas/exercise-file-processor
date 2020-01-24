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
                    <h2 class="text-2xl text-gray-500 text-center mb-8">Upload your SVG file.</h2>
                    <form class="flex flex-col items-center" action="#" method="POST" enctype="multipart/form-data">
                        <label class="w-64 mb-8 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-white hover:bg-green-500">
                            <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                            </svg>
                            <span class="mt-2 text-base leading-normal">Select a file</span>
                            <input type="file" name="file" accept="text/csv" class="hidden">
                        </label>
                        <button type="submit" class="bg-white text-gray-800 font-bold rounded border-b-2 border-green-500 hover:border-green-600 hover:bg-green-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                            <span class="mr-2">Send</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                              <path fill="currentcolor" d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"></path>
                            </svg>
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
