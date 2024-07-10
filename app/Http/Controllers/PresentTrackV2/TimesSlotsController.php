<?php

namespace App\Http\Controllers\PresentTrackV2;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\TimesSlot;
use DateTime;
use Illuminate\Http\Request;

class TimesSlotsController extends Controller
{
    public function create($id){
        return view('present-track-v2.akademik.jam.create', [
            'hari' => Day::findOrFail($id)
        ]);
    }

    public function store(Request $request, $id){

        if (count($request->start_time) > 0){
            $init = 0;
            for ($i=0; $i < count($request->start_time); $i++) {
                if ($request->start_time[$i] != null && $request->end_time[$i] != null){
                    $data = [
                        "day_id" => $id,
                        "start_time" => $request->start_time[$i],
                        "end_time" => $request->end_time[$i],
                        "jam_ke" => $request->jam_ke[$i]
                    ];
                    TimesSlot::create($data);
                    $init++;
                }
            }

            return redirect()->to(route('manage.days.detail', ['id' => $id]))->with("sukses", "$init Berhasil Dtambahkan");
        }

        return redirect()->to(route('manage.days.detail', ['id' => $id]))->with("sukses", "Tidak Ada Data Yang Ditambahkan");

    }

    public function update(Request $request, $id){
        try {
            TimesSlot::find($id)->update([
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'jam_ke' => $request->jam_ke
            ]);
            return true;
        } catch (\Illuminate\Database\QueryException $th) {
            return false;
        }
    }

    public function destroy($id_hari, $id_time){
        try {
            TimesSlot::findOrFail($id_time)->delete();
            return redirect()->to(route('manage.days.detail', ['id' => $id_hari]))->with("sukses", "Data Berhasil Dihapus");
        } catch (\Throwable $th) {
            return redirect()->to(route('manage.days.detail', ['id' => $id_hari]))->with("gagal", "Data Gagal Dihapus");
        }
    }

    private function convertTo24Hour($time) {
        $date = DateTime::createFromFormat('g:i a', $time);
        return $date->format('H:i');
    }
}
