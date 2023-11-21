<x-app-layout menuActive="jurusan" menuOpen="master">
    @section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">TAMBAH DATA JADWAL</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/jadwal">Data Jadwal</a></li>
            <li class="breadcrumb-item active">Tambah Data Jadwal</li>
        </ol>
    </div><!-- /.col -->
    @endsection

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Silahkan Pilih Guru</h3>
                    </div>

                    <div class="col-12 p-2">
                        <form class="form-horizontal" action="/jadwal/store-jadwal" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="kode_guru" class="col-sm-2 col-form-label">Kode - Nama Guru</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="kode_guru" name="kode_guru">
                                            <option>- Silahkan Pilih-</option>
                                            @foreach($gurus as $guru)
                                                <option value="{{ $guru->kode_guru }}">{{ $guru->kode_guru }} - {{ $guru->nama_guru }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Tambah Data</button>
                                <a href="/jurusan" class="btn btn-default float-right">Cancel</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>