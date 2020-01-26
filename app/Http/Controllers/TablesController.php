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

        $hasContent = $this->checkCVS($request);

        if(!$hasContent) return view('fail');

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

        return view('results', ['data' => compact('data'), 'sku' => $sku, 'qty' => $qty, 'cost' => $cost, 'price' => $price, 'profitMargin' => $profitMargin ]);
    }

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

        return $arr[0][0] !== "" ? true : false;
    }

}
