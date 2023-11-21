<x-app-layout menuActive="jurusan" menuOpen="master">
    @section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">TAMBAH DATA JURUSAN</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/jutrusan">Data Jurusan</a></li>
            <li class="breadcrumb-item active">Tambah Data Jurusan</li>
        </ol>
    </div><!-- /.col -->
    @endsection

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Mohon Isikan Data dengan Benar</h3>
                    </div>
                </div>
                <h4>KODE GURU: {{$guru->kode_guru}}</h4>
                <h4>NIK: {{$guru->nik}}</h4>
                <h4>Nama: {{$guru->nama_guru}}</h4>
            </div>
            <div class="col-12 p-2">
                <form action="/process-store" method="post">
                    @csrf
                    <input type="hidden" name="kode_guru" value="{{$guru->kode_guru}}">
                    <div id="section"></div>
                    <div class="d-flex">
                        <button type="button" class="btn btn-sm btn-primary" onclick="createField()">Add</button>
                        <div class="p-1"></div>
                        <button class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        var fields = [];
        var no = 0;
        function createField() {
            var kelas = createElementKelas();
            var jadwal = createElementJadwal();
            var jam = createElementJam();
            var hari = createElementHari();
            var seciton = document.getElementById("section");
            section.insertAdjacentHTML('beforeend',`
                <div class="section-${no++}">
                    <h6><b>Jadwal ${no}</b></h6>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Kelas</label>
                                <select name="id_kelas[]" class="form-control">
                                    <option>Masukan kelas</option>
                                    ${kelas} 
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Jadwal</label>
                                <select name="id_jadwal[]" class="form-control">
                                    <option>Masukan Jadwal</option>
                                    ${jadwal}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Hari</label>
                                <select name="id_hari[]" class="form-control">
                                    <option>Masukan Hari</option>
                                    ${hari}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Jam</label>
                                <select name="id_jam[]" class="form-control">
                                    <option>Masukan Jam</option>
                                    ${jam}
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            `);
        }

        function createElementKelas() {
            var kelas = <?= $kelas?>;
            // var jurusan = <?= $jurusan ?>
        
            var html = [];
            for (var i = 0;i < kelas.length;i++) {
                var row = kelas[i];
                // var rows = jurusan[i];
                html.push(`<option value="${row?.id}">${row?.nama_kelas} - ${row?.jurusan.kode_jurusan} - ${row?.rombel}</option>`);
            }
            return html.join();
        }

        function createElementJadwal() {
            var jadwal = <?= $jadwal?>;
            // console.log();
            var html = [];
            for (var i = 0;i < jadwal.length;i++) {
                var row = jadwal[i];
                html.push(`<option value="${row?.id}">Jam ke ${row?.jam_ke}</option>`);
            }
            return html.join();   
        }

        function createElementJam() {
            var jam = <?= $jam?>;
            // console.log();
            var html = [];
            for (var i = 0;i < jam.length;i++) {
                var row = jam[i];
                html.push(`<option value="${row?.id}">${row?.mulai} - ${row?.selesai}</option>`);
            }
            return html.join();   
        }

        function createElementHari() {
            var hari = <?= $hari?>;
            // console.log();
            var html = [];
            for (var i = 0;i < hari.length;i++) {
                var row = hari[i];
                html.push(`<option value="${row?.id}">${row?.nama}</option>`);
            }
            return html.join();   
        }
    </script>
</x-app-layout>