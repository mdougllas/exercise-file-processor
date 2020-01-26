<?php

namespace App\Imports;

use App\Table;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TablesImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            Table::create([
                'sku'   => $row['sku'],
                'qty'   => $row['qty'],
                'price' => $row['price'],
                'cost'  => $row['cost']
            ]);
        }
    }
}
