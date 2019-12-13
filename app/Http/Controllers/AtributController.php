<?php

namespace App\Http\Controllers;

use App\Atribut;
use Illuminate\Http\Request;

class AtributController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Atribut::all();
        return view('atribut.atribut_index', compact('data'))->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string'
        ]);

        if ($validator->fails()) {
            $message = $validator->errors();
            return redirect()->back()->withErrors($message);
        }

        Atribut::create(['name' => strtolower($request->name)]);

        return redirect()->back()->with('alert-success', 'Berhasil menambah atribut.');
    }

    public function nilaistore(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string'
        ]);

        if ($validator->fails()) {
            $message = $validator->errors();
            return redirect()->back()->withErrors($message);
        }

        $atribut = Atribut::find($request->atribut_id);
        $atribut->nilai()->create(['name' => strtolower($request->name)]);

        return redirect()->back()->with('alert-success', 'berhasil menambah data.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Atribut  $atribut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Atribut $atribut, $id)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string'
        ]);

        if ($validator->fails()) {
            $message = $validator->errors();
            return redirect()->back()->withErrors($message);
        }

        $data = Atribut::find($id);
        $data->update($request->all());

        return redirect()->back()->with('alert-success', 'Berhasil mengubah atribut');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Atribut  $atribut
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atribut $atribut, $id)
    {
        Atribut::destroy($id);
        return redirect()->back()->with('alert-success', 'Berhasil menghapus nilai atribut.');
    }

    public function nilaidestroy(Atribut $atribut, $id)
    {
        \App\NilaiAtribut::destroy($id);
        return redirect()->back()->with('alert-success', 'Berhasil menghapus nilai atribut.');
    }
}
