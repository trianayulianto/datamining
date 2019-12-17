<?php

namespace App\Imports;

use App\Dataset;
use Maatwebsite\Excel\Concerns\ToModel;

class DatasetImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $count = \App\Atribut::count();
        for ($i=0; $i < $count; $i++) {
            $data[$i] = $row[$i];
        }

        return new Dataset([
            'data' => $data
        ]);
    }
}
