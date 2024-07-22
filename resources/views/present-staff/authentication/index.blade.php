<x-app-layout-v2 menuActive="Data Akun Staff" title="Data Akun Staff">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Kelola Akun Staff</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
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
                 <h4 class="text-blue h4">Export Data</h4>
                 <a href="{{ route('manage.auth.staff') }}?export=true" class="btn btn-primary">Export</a>
             </div>
             <div class="pb-20">
                 <table class="data-table table stripe hover nowrap">
                     <thead>
                         <tr>
                             <th class="table-plus datatable-nosort">No</th>
                             <th>Nama Lengkap</th>
                             <th>Email</th>
                             <th>Status Akun</th>
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
                                 <td>{{ $value->email }}</td>

                                    @if ($value->login != null)
                                    <td>
                                        @if($value->login->device_token == null)
                                            <span class="badge badge-success"><i class="icon-copy bi bi-unlock-fill"></i> Siap Login</span>
                                        @else

                                            <span class="badge badge-danger"><i class="icon-copy bi bi-lock-fill"></i>Akun Locked</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form id="formDelete-{{ $value->id }}"
                                            action=""
                                            method="post" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="staff_id" value="{{ $value->id }}">
                                        </form>
                                        <div class="table-actions">
                                            @if($value->login->device_token != null)
                                                <form id="formUnlock-{{ $value->id }}"
                                                    action=""
                                                    method="post" style="display: none;">
                                                    @csrf
                                                    @method("PUT")
                                                    <input type="hidden" name="staff_id" value="{{ $value->id }}">
                                                </form>
                                                <a onclick="confirmUnlock({{ $value->id }})" data-color="#265ed7" style="color: rgb(38, 94, 215);"><i class="icon-copy bi bi-unlock-fill"></i></a>

                                            @endif
                                            <a href="#" onclick="return confirmDelete({{ $value->id }})" data-color="#e95959" style="color: rgb(233, 89, 89);"><i class="icon-copy dw dw-delete-3"></i></a>
                                        </div>
                                    </td>

                                    @else
                                    <form id="formAdd-{{ $value->id }}"
                                        action=""
                                        method="post" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="staff_id" value="{{ $value->id }}">
                                    </form>
                                    <td>
                                        Belum Ada Akun
                                    </td>
                                    <td>
                                        <div class="table-actions">
                                            <a onclick="confirmAdd({{ $value->id }})" data-color="#265ed7" style="color: rgb(38, 94, 215);"><i class="icon-copy dw dw-add"></i></a>
                                        </div>
                                    </td>
                                    @endif
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
                     pageLength: 100,
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
                    text: "Apakah kamu yakin akan mengahapus Akun ini.? Staff tidak akan bisa menggunakan aplikasi jika tidak punya akun",
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

            function confirmAdd(id){
                swal({
                    title: 'Konfirmasi Pembuatan Akun',
                    text: "Apakah kamu yakin akan membuat data login baru.?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    confirmButtonText: 'Ya, Lanjutkan'
                }).then(function (result) {
                    if (result['value']){
                        $("#formAdd-" + id).submit();
                    }
                })
            }

            function confirmUnlock(id){
                swal({
                    title: 'Konfirmasi Unlock Akun',
                    text: "Apakah Kamu ingin unlock akun.? Device akan diminta untuk login ulang",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    confirmButtonText: 'Ya, Lanjutkan'
                }).then(function (result) {
                    if (result['value']){
                        $("#formUnlock-" + id).submit();
                    }
                })
            }
         </script>
     @endsection
 </x-app-layout-v2>
