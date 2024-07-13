<div class="card-box pd-20 height-100-p mb-30">
    <div class="row align-items-center">
        <div class="col-md-4">
            <img src="{{ asset('pt-v2/vendors/images/banner-img.png') }}" alt="" />
        </div>
        <div class="col-md-8">
            <h4 class="font-20 weight-500 mb-10 text-capitalize">
                Welcome back
                <div class="weight-600 font-30 text-blue">{{ Auth::user()->name }}</div>
            </h4>
            <p class="font-18 max-width-600">
                Halaman Depan pada aplikasi present track, anda memiliki jabatan sebagai <b>Wakasek Kurikulum</b> dan memiliki batasan pada pengelolaan. Saat ini yang bisa anda kelola adalah sesuai pada menu
            </p>
        </div>
    </div>
</div>

<div class="card-box pd-20 heigh-100-p mb-30">
    <div class="row mt-4">
        <div class="col-md-12">
            <a href="{{ route('attendance.free') }}" class="btn btn-primary" onclick="return confirm('Jika Dilanjutkan maka semua guru akan dianggap hadir pada hari ini')">Hari Libur</a>
            <br><br>
            <p class="text-danger">
                *) Hanya untuk Hari libur yang terjadi pada jam kerja <br>
                *) Gunakan Sebagai Mana Fungsinya <br>
                *) Aktivitas Terecord dan Masuk ke Telegram
            </p>
        </div>
    </div>
</div>

