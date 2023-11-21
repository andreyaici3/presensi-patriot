<x-app-layout menuActive="kelas" menuOpen="master">
    @section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">EDIT DATA KELAS</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/kelas">Data Kelas</a></li>
            <li class="breadcrumb-item active">Edit Data Kelas</li>
        </ol>
    </div><!-- /.col -->
    @endsection

    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Mohon Isikan Data dengan Benar</h3>
                    </div>


                    <form class="form-horizontal" action="/kelas/{{ $kelas->id }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                                <div class="col-sm-10">
                                    <select name="nama_kelas" class="form-control">
                                        <option {{ ($kelas->nama_kelas == "X") ? "selected" : "" }}  value="X">X - SEPULUH</option>
                                        <option {{ ($kelas->nama_kelas == "XI") ? "selected" : "" }} value="XI">XI - SEBELAS</option>
                                        <option {{ ($kelas->nama_kelas == "XII") ? "selected" : "" }} value="XII">XII - DUA BELAS</option>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                                <div class="col-sm-10">
                                    <select name="id_jurusan" class="form-control">
                                        <option value="-">-- Silahkan Pilih Jurusan --</option>
                                        @foreach($jurusans as $jurusan)
                                            <option {{ ($jurusan->id == $kelas->id_jurusan)  ? "selected" : ""}} value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="rombel" class="col-sm-2 col-form-label">Nomor Rombel</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="rombel" placeholder="1" name="rombel" value="{{ $kelas->rombel }}">
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Simpan Data</button>
                            <a href="/kelas" class="btn btn-default float-right">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>