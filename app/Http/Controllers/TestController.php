<?php

namespace App\Http\Controllers;

use C45;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $data  = [
            ["sunny", "hot", "high", "false", "no"],
            ["sunny", "hot", "high", "true", "no"],
            ["cloudy", "hot", "high", "false", "yes"],
            ["rainy", "mild", "high", "false", "yes"],
            ["rainy", "cool", "normal", "false", "yes"],
            ["rainy", "cool", "normal", "true", "yes"],
            ["cloudy", "cool", "normal", "true", "yes"],
            ["sunny", "mild", "high", "false", "no"],
            ["sunny", "cool", "normal", "false", "yes"],
            ["rainy", "mild", "normal", "false", "yes"],
            ["sunny", "mild", "normal", "true", "yes"],
            ["cloudy", "mild", "high", "true", "yes"],
            ["cloudy", "hot", "normal", "false", "yes"],
            ["rainy", "mild", "high", "true", "no"],

        ];
        // Nama Atribut data
        $attributes = [1 => "outlook", 2 => "temperature", 3 => "humadity", 4 => 'windy'];
        //Buat instance

        $c45 = new C45;

        // Set data dan atribut
        $c45->setData($data)->setAttributes($attributes);
        // Hitung menggunakan data training
        $c45->hitung();

        // Uji Coba dengan menggunakan 1 data testing sebagai berikut:

        $data_testing = ["rainy", "cool", "high", "true"];
        echo 'Dari hasil perhitungan maka didapatkan hasil : '.$c45->predictDataTesting($data_testing);
        // Luaran diatas akan menghasilkan jawaban Yes

        // Sedangkan untuk melihat rule yang dihasilkan dari data set yang telah diberikan ialah dengan menggunakan perintah sebagai berikut:
        $c45->printRules();
    }
}
