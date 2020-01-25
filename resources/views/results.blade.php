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
                    <table class="table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">SKU</th>
                                <th class="px-4 py-2">Quantity</th>
                                <th class="px-4 py-2">Price</th>
                                <th class="px-4 py-2">Cost</th>
                            </tr>
                        </thead>

                        @foreach ($data as $item)
                            <tbody>
                                <tr>
                                    <td class="border px-4 py-2">{{ $item->sku }}</td>
                                    <td class="border px-4 py-2  text-center">{{ $item->qty }}</td>
                                    <td class="border px-4 py-2  text-center">@money($item->price)</td>
                                    <td class="border px-4 py-2  text-center">@money($item->cost)</td>
                                </tr>
                            </tbody>
                            @endforeach

                          </table>
                </div>
            </div>
        </div>
    </div>
@endsection
