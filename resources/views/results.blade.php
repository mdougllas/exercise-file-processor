@extends('layout')

@section('title', 'Your Results')

@section('content')
    <div class="flex flex-col">
        <div class="min-h-screen flex items-center justify-center">
            <div class="flex flex-col justify-around h-full">
                <h1 class="text-gray-600 text-center font-light tracking-wider text-5xl mb-6">File Processor</h1>
                <h2 class="text-2xl text-gray-500 text-center mb-8">These are the results for your file.</h2>

                <table class="table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">SKU</th>
                            <th class="px-4 py-2">Quantity</th>
                            <th class="px-4 py-2">Price</th>
                            <th class="px-4 py-2">Cost</th>
                            <th class="px-4 py-2">Profit Margin</th>
                            <th class="px-4 py-2">Total Profit (USD)</th>
                            <th class="px-4 py-2">Total Profit (CAD)</th>
                        </tr>
                    </thead>

                    {{-- The @money helper was inserted on Blade Template for outputing monetary values. See app/Providers/AppServiceProvider.php for more info --}}
                    {{-- The @convert helper was inserted on Blade Template for converting USD to CAD. See app/Providers/AppServiceProvider.php for more info --}}
                    @foreach ($data['data'] as $item)
                        <tbody>
                            <tr>
                                <td class="border px-4 py-2">{{ $item->sku }}</td>
                                <td class="border px-4 py-2  text-center">{{ $item->qty }}</td>
                                <td class="border px-4 py-2  text-center">@money( $item->price )</td>
                                <td class="border px-4 py-2  text-center">@money( $item->cost )</td>
                                <td class="border px-4 py-2  text-center {{ $item->price - $item->cost < 0 ? 'text-red-500' : 'text-green-500' }}">@money( $item->price - $item->cost )</td>
                                <td class="border px-4 py-2  text-center {{ ($item->price - $item->cost) * $item->qty < 0 ? 'text-red-500' : 'text-green-500' }}">@money( ($item->price - $item->cost) * $item->qty )</td>
                                <td class="border px-4 py-2  text-center {{ ($item->price - $item->cost) * $item->qty < 0 ? 'text-red-500' : 'text-green-500' }}">@convert( ($item->price - $item->cost) * $item->qty )</td>
                            </tr>
                        </tbody>
                    @endforeach

                    <tfoot class="text-sm">
                        <tr>
                            <th class="px-4 py-2 text-gray-500">Total Products: <span class="text-black">{{ count( $sku ) }} products</span></th>
                            <th class="px-4 py-2 text-gray-500">Total Quantity: <span  class="text-black">{{ $qty->sum() }} units</span></th>
                            <th class="px-4 py-2 text-gray-500">Average Price: <span  class="text-black">@money( $price->avg() )</span></th>
                            <th class="px-4 py-2 text-gray-500">Average Cost: <span  class="text-black">@money( $cost->avg() )</span></th>
                            <th class="px-4 py-2 text-gray-500">Average Profit Margin: <span class=" {{ $profitMargin->avg() < 0 ? 'text-red-500' : 'text-green-500' }}">@money( $profitMargin->avg() )</span></th>
                            <th class="px-4 py-2 text-gray-500">Total Profit (USD): <span class=" {{ $profitMargin->avg() < 0 ? 'text-red-500' : 'text-green-500' }}">@money( $totalProfit->sum() )</span></th>
                        <th class="px-4 py-2 text-gray-500">Total Profit (CAD): <span class=" {{ $profitMargin->avg() < 0 ? 'text-red-500' : 'text-green-500' }}">@convert( $totalProfit->sum() )</span></th>
                        </tr>
                    </tfoot>
                </table>

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
