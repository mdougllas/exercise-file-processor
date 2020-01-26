@extends('layout')

@section('title', 'Your Results')

@section('content')
    <div class="flex flex-col">
        <div class="min-h-screen flex items-center justify-center">
            <div class="flex flex-col justify-around h-full">
                <h1 class="text-gray-600 text-center font-light tracking-wider text-5xl mb-6">File Processor</h1>
                <h2 class="text-2xl text-gray-500 text-center mb-8">Sorry, we couldn't find any content in your file. Please press "Close" and try again.</h2>

                <div class="text-center">
                    <a href="/">
                        <button class="mt-8 bg-white text-gray-800 font-bold rounded border-b-2 border-red-500 hover:border-red-600 hover:bg-red-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                            <span class="mr-2">Close</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentcolor" d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                            </svg>
                        </button>
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection
