<x-app-layout menuActive="masterStaff" menuOpen="masterStaff">
    @section('breadcrumb')
        <div class="col-sm-6">
            <h1 class="m-0">TAMBAH STAFF</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('wakasek.staff') }}">Data Master Staff</a></li>
                <li class="breadcrumb-item active">Tambah Staff</li>
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

                    <form class="form-horizontal" action="{{ route('wakasek.staff') }}" method="POST">
                        @csrf
                        @include('absen-staff.master.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
