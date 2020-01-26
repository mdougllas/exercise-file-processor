<?php

namespace App\Http\Controllers;

use App\Table;
use Illuminate\Http\Request;
use App\Imports\TablesImport;
use Maatwebsite\Excel\Facades\Excel;

class TablesController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Table $table)
    {
        $request->validate([
            'file' => ['required', 'mimes:txt,csv', 'max:2048'],
        ]);

        //Handling bug on Laravel Excel library. See next functions below for more info.
        $hasContent = $this->checkCVS($request);
        $hasHeaders = $this->checkHeader($request);
        if(!$hasContent || !$hasHeaders) return view('fail');

        Excel::import(new TablesImport, $request->file);

        $data = $table->all();
        $table->truncate();

        /**
         * SplitData function splits the requested data from the Collection into an array
         * See app/Table.php for more information
        */
        $sku = collect($table->splitData($data, 'sku'));
        $qty = collect($table->splitData($data, 'qty'));
        $cost = collect($table->splitData($data, 'cost'));
        $price = collect($table->splitData($data, 'price'));
        $profitMargin = collect($table->avgProfitMargin($data, 'price', 'cost'));
        $totalProfit = collect($table->totalProfit($data, 'price', 'cost', 'qty'));

        return view('results', ['data' => compact('data'), 'sku' => $sku, 'qty' => $qty, 'cost' => $cost, 'price' => $price, 'profitMargin' => $profitMargin, 'totalProfit' => $totalProfit ]);
    }

    /**
     * Laravel Excel library has a bug handling a file that has
     * only the header and not the content this function
     * is here only for handling it and avoiding
     * calling Excel::import( ... ) if the file has only the header line
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    protected function checkCVS(Request $request)
    {
        $file = fopen($request->file, "r");
        $header = true;
        $arr = [];

        while ($csvLine = fgetcsv($file, 1000, ','))
        {
            if($header){
                $header = false;
            } else {
                array_push($arr, $csvLine);
            }
        }

        $collection = collect($arr);
        return $collection[0][0] !== "" ? true : false;
    }

    /**
     * Laravel Excel library has a bug handling a file without
     * any of the specified headers. This function
     * is here only for handling it and avoiding
     * calling Excel::import( ... ) if the file misses any header
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    protected function checkHeader(Request $request)
    {
        $file = fopen($request->file, "r");
        $csvLine = fgetcsv($file, 1000, ',');

        $collection = collect($csvLine)->filter(function($value){
            return $value == 'sku' || $value == 'price' || $value == 'qty' || $value == 'cost';
        });

        return $collection->count() === 4 ? true : false;
    }
}
