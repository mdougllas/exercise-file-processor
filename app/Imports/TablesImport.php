<?php

namespace App\Imports;

use App\Table;
use Maatwebsite\Excel\Concerns\ToModel;

class TablesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Table([
            'sku'   => $row['sku'],
            'price' => $row['price'],
            'qty'   => $row['qty'],
            'cost'  => $row['cost'],
        ]);
    }
}
