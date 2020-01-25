<?php

namespace App\Http\Controllers;

use App\Table;
use Illuminate\Http\Request;
use App\Imports\TablesImport;
use Illuminate\Support\Facades\DB;
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

        // $path = $request->file->store('uploads');
        Excel::import(new TablesImport, $request->file);

        $data = $table->all();
        $table->truncate();

        return view('results', compact('data'));
    }


}
