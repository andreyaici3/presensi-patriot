<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TelegramController extends Controller
{
    protected $token;
    protected $apiUrl;
    protected $groupId;
    protected $channelID;
    protected $channelUname;

    public function __construct()
    {
        $this->token = env('TELEGRAM_BOT_INFO_TOKEN');
        $this->channelID = env('TELEGRAM_CHANNEL_ID');
        $this->channelUname = env('TELEGRAM_CHANNEL_UNAME');
        $this->apiUrl = 'https://api.telegram.org/bot' . $this->token . '/';
    }

    public function info_hari_llibur($data)
    {
        $caption = "🚨  <i>FITUR HARI LIBUR DIPAKAI</i>  🚨

Sepertinya ". $data['nama'] ." Telah menggunakan fitur hari libur

👨‍🎓 <b>JAM KBM: </b> ". $data['jam'] ." JAM, Status Absen sudah di <b>Bypass Hadir</b>
⏰️ <b>Waktu Aktivitas: </b> " . $data["waktu"] . "
";
        $this->sendMessage($this->channelID, $caption);
    }

    public function info_request_izin($data)
    {
        $caption = "🚨  <i>PERMINTAAN IZIN GURU</i>  🚨

". $data['nama'] ." Baru Saja Meminta izin dengan data sbb:

👨‍🎓 <b>Kelas: </b> ". $data['kelas'] ."
🚀 <b>JAM:</b> " . $data["jam_ke"] . "
🚀 <b>Alasan:</b> " . $data["alasan"] . "
⏰️ <b>Waktu Aktivitas: </b> " . $data["waktu"] . "
";
        $this->sendMessage($this->channelID, $caption);
    }

    public function info_acc_izin($data)
    {
        $caption = "🚨  <i>IZIN GURU BERHASIL DITERIMA</i>  🚨

". $data['nama'] ." Baru Saja memproses izin dengan data sbb:

👨‍🎓 <b>Nama Guru: </b> ". $data['nama_guru'] ."
🚀 <b>Kelas: </b> ". $data['kelas'] ."
⏰️ <b>JAM:</b> " . $data["jam_ke"] . "
🚀 <b>Alasan:</b> " . $data["alasan"] . "
⏰️ <b>Waktu Aktivitas: </b> " . $data["waktu"] . "
";
        $this->sendMessage($this->channelID, $caption);
    }

    public function info_reject_izin($data)
    {
        $caption = "🚨  <i>IZIN GURU DITOLAK</i>  🚨

". $data['nama'] ." Baru Saja menolak izin dengan data sbb:

👨‍🎓 <b>Nama Guru: </b> ". $data['nama_guru'] ."
🚀 <b>Kelas: </b> ". $data['kelas'] ."
⏰️ <b>JAM:</b> " . $data["jam_ke"] . "
🚀 <b>Alasan:</b> " . $data["alasan"] . "
⏰️ <b>Waktu Aktivitas: </b> " . $data["waktu"] . "
";
        $this->sendMessage($this->channelID, $caption);
    }

    public function sendMessage($username, $message)
    {

        $client = new Client();
        $response = $client->post($this->apiUrl . "sendMessage", [
            'json' => [
                'chat_id' => $username,
                'text' => $message,
                'parse_mode' => 'HTML', // Set parse mode to HTML
            ]
        ]);

        return $response->getBody();
    }
}
