<?php

namespace App\Imports;

use App\Models\Kata;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportKata implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Kata([
            'index' => $row[0],
            'indonesia' => $row[1],
            'daerah' => $row[2],
            'jenis' => $row[3],
        ]);
    }
}
