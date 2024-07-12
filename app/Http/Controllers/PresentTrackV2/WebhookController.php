<?php

namespace App\Http\Controllers\PresentTrackV2;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TelegramController;
use App\Models\Classes;
use App\Models\TelegramUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $tg = new TelegramController();
        $update = $request->all();

        // Log the incoming update for debugging
        Log::info($update);
        if (isset($update["message"])){
            $message = $update['message'];
            $chatId = $message['chat']['id'];

            $hasil = TelegramUser::where('telegram_id', $chatId)->get()->first();
            if ($hasil){
                $teacherId = $hasil->teacher->id;
                $kodeGuru = $hasil->teacher->kode_guru;
                $text = $message['text'] ?? '';
                $result = $this->processMessage($text);
                if ($result['class_id'] != false){
                    $atd = new AttendancesController();
                    $abs = $atd->attendanceOnTelegram($result, $kodeGuru);
                    $jsonString = json_encode($abs);
                    $jsonData = json_decode($jsonString, true);
                    if ($jsonData !== null) {
                        $pesan = $jsonData['original']['message'];
                        $tg->sendMessage($chatId, $pesan);
                    } else {
                        $tg->sendMessage($chatId, "Parsing JSON Gagal");
                    }
                } else {
                    $tg->sendMessage($chatId, "Periksa Kembali Kode Unik Anda");
                }
            }else {
                $tg->sendMessage($chatId, "ID Kamu Tidak Terdaftar, Silahkan Hubungi @andrey_ITNSA");
            }

        }
    }

    private function processMessage($text)
    {
        $pattern = '/(\w+)\s+(.*)/';
        preg_match($pattern, $text, $matches);

        if (count($matches)>0){
            $status = strtolower($matches[1]);
            switch ($status) {
                case 'hadir':
                    $data = [
                        'status' => 'present',
                        'class_id' => $this->prosesClassId($matches[2]),
                    ];
                    break;
                case 'izin':
                    $data = [
                        'status' => 'permission',
                        'class_id' => $this->prosesClassId($matches[2]),
                    ];
                    break;
                case 'sakit':
                    $data = [
                        'status' => 'sick',
                        'class_id' => $this->prosesClassId($matches[2]),
                    ];
                    break;
                default:
                    $data = [
                        'status' => false,
                        'class_id' => false,
                    ];
                    break;
            }
        } else {
            $data = [
                'status' => false,
                'class_id' => false,
            ];
        }

        return $data;
    }

    private function prosesClassId($text){
        $decode = base64_decode($text);
        $kelas = Classes::find($decode);
        if ($kelas){
            return $kelas->id;
        } else {
            return false;
        }
    }
}
