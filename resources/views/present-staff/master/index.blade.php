<x-app-layout-v2 menuActive="Data Staff" menuOpen="Master Data" title="Data Staff">
   <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Data Staff</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                    Data Staff
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @if (Session::has('sukses'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <b>Berhasil!!</b> {{ session('sukses') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif


                @if (Session::has('gagal'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <b>Gagal!!</b> {{ session('gagal') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <div class="card-box mb-30 pd-20">
            <div class="pd-20">
                <h4 class="text-blue h4">Daftar Nama Staff</h4>
                <a href="{{ route('manage.staff.create') }}" class="btn btn-primary">Tambah</a>
                <a href="{{ route('manage.staff.generate', ['id' => 0]) }}" class="btn btn-success">Barcode Masuk</a>
                <a href="{{ route('manage.staff.generate', ['id' => -1]) }}" class="btn btn-success">Barcode Keluar</a>
            </div>
            <div class="pb-20">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">No</th>
                            <th>Nama Lengkap</th>
                            <th>NIP</th>
                            <th>Email</th>
                            <th class="datatable-nosort">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $nomor = 1;
                        @endphp
                        @foreach ($staffs as $key => $value)
                            <tr>
                                <td class="table-plus">{{ $nomor++ }}</td>
                                <td>
                                    {{ $value->name }}
                                </td>
                                <td>{{ $value->nip }}</td>
                                <td> {{ $value->email }} </td>

                                <td>
                                    <form id="formDelete-{{ $value->id }}"
                                        action="{{ route('manage.staff.edit', ['id' => $value->id]) }}"
                                        method="post" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <div class="table-actions">
                                        <a href="{{ route('manage.staff.edit', ['id' => $value->id]) }}" data-color="#265ed7" style="color: rgb(38, 94, 215);"><i class="icon-copy dw dw-edit2"></i></a>
                                        <a href="#" onclick="return confirmDelete({{ $value->id }})" data-color="#e95959" style="color: rgb(233, 89, 89);"><i class="icon-copy dw dw-delete-3"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

   </div>

   @section('js')
		<script src="{{ asset('pt-v2/src/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
        <script>
            $('document').ready(function() {
                $('.data-table').DataTable().destroy();
                $('.data-table').DataTable({
                    scrollCollapse: true,
                    autoWidth: false,
                    responsive: true,
                    columnDefs: [{
                        targets: "datatable-nosort",
                        orderable: false,
                    }],
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    "language": {
                        "info": "_START_-_END_ of _TOTAL_ entries",
                        searchPlaceholder: "Search",
                        paginate: {
                            next: '<i class="ion-chevron-right"></i>',
                            previous: '<i class="ion-chevron-left"></i>'
                        }
                    },
                });
            })

            function confirmDelete(id){

                swal({
                    title: 'Konfirmasi Hapus',
                    text: "Apakah kamu yakin akan mengahpus data.?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function (result) {
                    if (result['value']){
                        $("#formDelete-" + id).submit();
                    }
                })
            }

        </script>
    @endsection
</x-app-layout-v2>
