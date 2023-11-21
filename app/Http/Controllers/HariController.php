<?php

namespace App\Http\Controllers;

use App\Models\Hari;
use Illuminate\Http\Request;

class HariController extends Controller
{
    public function index()
    {
        return view('hari.index', [
            'haris' => Hari::get(),
            'nomor_urut' => 1,
        ]);
    }

    public function create()
    {
        return view('hari.create');
    }

    public function store(Request $request){
       Hari::create([
        'nama' => $request->hari
       ]); 

       return redirect('/master-jadwal');
    }

    public function edit($id)
    {
        
        $hari = Hari::whereId($id)->first();
        return view('hari.edit', [
            'hari' => $hari
        ]);
    }

    public function update(Request $request, $id){
        Hari::find($id)->update([
            'nama' => $request->hari
        ]);
        return redirect('/master-jadwal');
    }

    public function destroy($id)
    {
        Hari::find($id)->delete();
        return redirect('/master-jadwal');
    }
}
