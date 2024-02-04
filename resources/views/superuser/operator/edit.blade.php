<x-app-layout menuActive="operator">
    @section('breadcrumb')
        <div class="col-sm-6">
            <h1 class="m-0">EDIT OPERATOR</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('superuser.operator.index') }}">Data Operator</a></li>
                <li class="breadcrumb-item active">Edit Data</li>
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


                    <form class="form-horizontal" action="{{ route('superuser.operator.update', ['id' => $user->id]) }}"
                        method="POST">
                        @csrf
                        @method('put')
                        @include('superuser.operator.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
