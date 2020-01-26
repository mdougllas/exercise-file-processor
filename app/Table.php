<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $guarded = [];

    public function tables()
    {
        return $this->all();
    }

    /**
     * Split the data found in a given Collection.
     *
     * @param collection - any Eloquent Collection
     * @param string - Name of the specific data for fetching in the array
     * @return array
     */
    public function splitData($collection, string $arr)
    {
        $str = $arr;
        $arr = [];

        foreach ($collection as $item)
        {
            array_push($arr, $item->$str);
        }
        return $arr;
    }

    /**
     * Calculate the profit margin for all products in a given Collection
     *
     * @param collection - any Eloquent Collection
     * @param string - Name of the specific data for fetching in the array
     * @return array
     */
    public function avgProfitMargin($collection, $price, $cost)
    {
        $partial = [];

        foreach ($collection as $item)
        {
            array_push($partial, $item->$price - $item->$cost);
        }
        return $partial;
    }

    /**
     * Calculate the profit margin for all products in a given Collection
     *
     * @param collection - any Eloquent Collection
     * @param string - Name of the specific data for fetching in the array
     * @return array
     */
    public function totalProfit($collection, $price, $cost)
    {
        $partial = [];

        foreach ($collection as $item)
        {
            array_push($partial, $item->$price - $item->$cost);
        }
        return $partial;
    }
}
