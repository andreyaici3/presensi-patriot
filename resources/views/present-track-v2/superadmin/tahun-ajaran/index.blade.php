<x-app-layout-v2 menuActive="Tahun Ajaran" title="Data Tahun Ajaran">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Kelola Tahun Ajaran</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                 Tahun Ajaran
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
                 <h4 class="text-blue h4">Daftar Tahun Ajaran</h4>
                 <a href="{{ route('manage.academic.year.create') }}" class="btn btn-primary">Tambah</a>
             </div>
             <div class="pb-20">
                 <table class="data-table table stripe hover nowrap">
                     <thead>
                         <tr>
                             <th class="table-plus datatable-nosort">No</th>
                             <th>Name</th>
                             <th>TA</th>
                             <th>Active</th>
                             <th class="datatable-nosort">Aksi</th>
                         </tr>
                     </thead>
                     <tbody>
                         @php
                             $nomor = 1;
                         @endphp
                         @foreach ($academic as $key => $value)
                             <tr>
                                 <td class="table-plus">{{ $nomor++ }}</td>
                                 <td>{{ $value->name }}</td>
                                 <td>
                                    {{ $value->start_year . " / " . $value->end_year }}
                                 </td>
                                 <td>
                                    <input
                                        id="switch-{{ $value->id }}"
                                            onchange="switchTa('{{ $value->id }}')"
											type="checkbox"
											{{ $value->active == 1 ? 'checked' : '' }}
											class="switch-btn"
											data-color="#0099ff"
										/>
                                 </td>
                                 <td>
                                     <form id="formDelete-{{ $value->id }}"
                                         action="{{ route('manage.academic.year.delete', ['id' => $value->id]) }}"
                                         method="post" style="display: none;">
                                         @csrf
                                         @method('DELETE')
                                     </form>
                                     <div class="table-actions">
                                         <a href="{{ route('manage.academic.year.edit', ['id' => $value->id]) }}" data-color="#265ed7" style="color: rgb(38, 94, 215);"><i class="icon-copy dw dw-edit2"></i></a>
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
    @section('head')
        <link rel="stylesheet" type="text/css" href="{{ asset('pt-v2/src/plugins/switchery/switchery.min.css') }}" />
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    @endsection
    @section('js')
		<script src="{{ asset('pt-v2/src/plugins/switchery/switchery.min.js') }}"></script>
         <script src="{{ asset('pt-v2/src/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
         <script>
            var elems = Array.prototype.slice.call(document.querySelectorAll('.switch-btn'));
            $('.switch-btn').each(function() {
                new Switchery($(this)[0], $(this).data());
            });
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

             function switchTa(id){

                swal({
                    title: 'Switch Tahun Ajaran',
                    text: "Apakah kamu yakin ingin Menyimpan perubahan.?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    confirmButtonText: 'Simpan'
                }).then(function (result) {
                    if (result['value']){
                        var url = "{{ route('manage.academic.year.switch', ['id' => ':id_ta']) }}";
                        url = url.replace(":id_ta", id);
                        axios.post(url) // Contoh endpoint API di Laravel
                            .then(function (response) {
                                console.log(response.data);
                                if (response.data == true){
                                    swal({
                                            position: 'top-end',
                                            type: 'success',
                                            title: 'Perubahan berhasil Disimpan',
                                            showConfirmButton: false,
                                            timer: 1500
                                        }).then(function(){
                                            window.location.href = '';
                                        });

                                } else {
                                    swal(
                                        {
                                            position: 'top-end',
                                            type: 'error',
                                            title: 'Perubahan Gagal Disimpan',
                                            showConfirmButton: false,
                                            timer: 1500
                                        }
                                    ).then(function(){
                                            window.location.href = '';
                                        });
                                }
                                // Lakukan sesuatu dengan data yang diterima
                            })
                            .catch(function (error) {
                                swal(
                                        {
                                            position: 'top-end',
                                            type: 'error',
                                            title: 'Perubahan Gagal Disimpan',
                                            showConfirmButton: false,
                                            timer: 1500
                                        }
                                    ).then(function(){
                                            window.location.href = '';
                                        })
                            });
                    } else {
                        swal(
                                        {
                                            position: 'top-end',
                                            type: 'error',
                                            title: 'Aksi Telah Di Gagalkan',
                                            showConfirmButton: false,
                                            timer: 1500
                                        }
                                    ).then(function(){
                                            window.location.href = '';
                                        })
                    }
                })
            }

         </script>
     @endsection
 </x-app-layout-v2>
