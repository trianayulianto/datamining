<?php

namespace App\Http\Controllers;

use Libraries\C45\C45;
use Illuminate\Http\Request;

class HitungController extends Controller
{
    public function index()
    {
        return view('hitung.hitung_index');
    }

    public function hasil(Request $request)
    {
        // dd($request->all());
        // Dataset Atribut
        // $data  = array(["sunny", "hot", "high", "false", "no"]);
        $dataset  = \App\Dataset::all();
        foreach ($dataset as $key => $value) {
            $data[$key] = $value->data;
        }

        // Nama Atribut data
        // $attributes = [1 => "outlook", 2 => "temperature", 3 => "humadity", 4 => 'windy'];
        $atribut = \App\Atribut::all();
        $jmlAtr = $atribut->count();
        for ($i=0; $i < ($jmlAtr - 1); $i++) {
            $attributes[$i+1] = $atribut[$i]->name;
        }

        //Buat instance
        $c45 = new C45;

        // Set data dan atribut
        $c45->setData($data)->setAttributes($attributes);

        // Hitung menggunakan data training
        $c45->hitung();

        // Uji Coba dengan menggunakan 1 data testing sebagai berikut:
        for ($i=0; $i < ($jmlAtr - 1); $i++) {
            $dataUji[$i] = $request->data[$i];
        }
        $data_testing = $dataUji;

        // Hasil uji
        $hasilUjicoba = 'Dari hasil perhitungan maka didapatkan hasil : '.$c45->predictDataTesting($data_testing);

        // Sedangkan untuk melihat rule yang dihasilkan dari data set yang telah diberikan ialah dengan menggunakan perintah sebagai berikut:
        $ruleUjicoba = $c45->printRules();
        // dd($hasilUjicoba);

        return view('hitung.hasil_index', compact('hasilUjicoba','ruleUjicoba'));
    }
}
