<?php

namespace App\Http\Controllers;

use App\Dataset;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;

class DatasetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Dataset::paginate(10);
        return view('dataset.dataset_index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'data.*' => 'required|string'
        ]);
        $atribut = \App\Atribut::all();
        foreach ($atribut as $key => $value) {
            $data[$key] = $request->data[$key];
        }
        // return dd($data);
        $data = Dataset::create(['data' => $data]);
        if ($request->expectsJson()) {
            return response()->json(['message' => ['success' => 'Berhasil menambah data.']], 200);
        }
        return redirect()->back()->with('alert-success', 'Berhasil menambah data.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dataset  $dataset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dataset $dataset, $id)
    {
        $validator = \Validator::make($request->all(),[
            'data.*' => 'required|string'
        ]);
        $atribut = \App\Atribut::all();
        foreach ($atribut as $key => $value) {
            $data[$key] = $request->data[$key];
        }
        // return dd($data);
        $dataset = Dataset::find($id);
        $dataset->update(['data' => $data]);
        if ($request->expectsJson()) {
            return response()->json(['message' => ['success' => 'Berhasil merubah data.']], 200);
        }
        return redirect()->back()->with('alert-success', 'Berhasil merubah data.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dataset  $dataset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dataset $dataset, $id)
    {
        Dataset::destroy($id);
        return redirect()->back()->with('alert-success', 'Berhasil hapus data.');
    }
}
