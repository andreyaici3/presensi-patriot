<?php

namespace App\Http\Controllers\PresentTrackV2;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TelegramUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TelegramUserController extends Controller
{
    public function index(){
        return view('present-track-v2.superadmin.telegram-account.index', [
            'telegrams' => TelegramUser::get(),
        ]);
    }

    public function create(){
        return view("present-track-v2.superadmin.telegram-account.create", [
            'teachers' => Teacher::orderBy('kode_guru', 'ASC')->get()
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'telegram_id' => 'required'
        ], [
            'telegram_id.required' => "ID Telegram Tidak Boleh Kosong"
        ]);
        try {
            TelegramUser::create($request->all());
            return redirect()->to(route('manage.tg'))->with("sukses", "ID Telegram Berhasil Ditambahkan");
        } catch (\Illuminate\Database\QueryException $th) {
            return redirect()->to(route('manage.tg.create'))->withInput()->with('gagal', "Data Gagal Ditambahkan");
        }
    }

    public function edit($id){
        $data = TelegramUser::findOrFail($id);
        return view("present-track-v2.superadmin.telegram-account.edit", [
            'teachers' => Teacher::orderBy('kode_guru', 'ASC')->get(),
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'telegram_id' => 'required'
        ], [
            'telegram_id.required' => "ID Telegram Tidak Boleh Kosong"
        ]);
        try {
            TelegramUser::find($id)->update($request->all());
            return redirect()->to(route('manage.tg'))->with("sukses", "ID Telegram Berhasil Diubah");
        } catch (\Illuminate\Database\QueryException $th) {
            return redirect()->to(route('manage.tg.create'))->withInput()->with('gagal', "Data Gagal Diubah");
        }
    }

    public function destroy($id){
        try {
            TelegramUser::find($id)->delete();
            return redirect()->to(route('manage.tg'))->with("sukses", "ID Telegram Berhasil Diubah");
        } catch (\Illuminate\Database\QueryException $th) {
            return redirect()->to(route('manage.tg.create'))->withInput()->with('gagal', "Data Gagal Diubah");
        }
    }
}
