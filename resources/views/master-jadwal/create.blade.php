<x-app-layout menuActive="jurusan" menuOpen="master">
    @section('breadcrumb')
        <div class="col-sm-6">
            <h1 class="m-0">TAMBAH DATA JAM PELAJARAN</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/master-jadwal">Data Jadwal</a></li>
                <li class="breadcrumb-item active">Tambah Data Jam Pelajaran</li>
            </ol>
        </div><!-- /.col -->
    @endsection

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Mohon Isikan Data Dengan Benar</h3>
                    </div>

                    <div class="col-12 p-2">
                        <form class="form-horizontal" action="/master-jadwal/{{ $id }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="jam_ke" class="col-sm-2 col-form-label">Jam Ke</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="jam_ke" name="jam_ke">
                                            <option>- Jam ke -</option>
                                            @for ($i = 1; $i < 13; $i++)
                                                <option value="{{ $i }}">Jam Ke - {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="rentang_waktu" class="col-sm-2 col-form-label">Rentang Waktu</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="rentang_waktu" name="rentang_waktu">
                                            <option>- Silahkan Pilih Rentang Waktu -</option>
                                            @foreach ($jams as $jam)
                                                <option value="{{ $jam->id }}">{{ $jam->mulai }} -
                                                    {{ $jam->selesai }}</option>
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
