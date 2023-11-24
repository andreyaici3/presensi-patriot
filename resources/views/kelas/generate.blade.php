<x-app-layout menuActive="kelas" menuOpen="master">
    @section('breadcrumb')
        <div class="col-sm-6">
            <h1 class="m-0">QR CODE KELAS {{ $kelas->nama_kelas }} - {{ $kelas->jurusan->kode_jurusan }} -
                {{ $kelas->rombel }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Data Kelas</li>
            </ol>
        </div><!-- /.col -->
    @endsection

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                {!! QrCode::size(600)->generate('assign-present/' . $kelas->id) !!}
            </div>
        </div>
    </div>

</x-app-layout>
