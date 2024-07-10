<x-app-layout-v2 menuActive="Data Waktu" title="Data Waktu">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Kelola Waktu Pelajaran</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('manage.days') }}">Waktu Pelajaran</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Detail
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
                 <h4 class="text-blue h4">Daftar Jam Pelajaran Pada Hari {{ $day->name }} </h4>
                 <a href="{{ route('manage.time.create', ['id_hari' => $day->id]) }}" class="btn btn-primary">Tambah</a>
             </div>
             <div class="pb-20">
                 <table class="data-table table stripe hover nowrap">
                     <thead>
                         <tr>
                             <th class="table-plus datatable-nosort">No</th>
                             <th width="60">Jam Ke</th>
                             <th>Waktu Mulai</th>
                             <th>Waktu Selesai</th>
                             <th class="datatable-nosort">Aksi</th>
                         </tr>
                     </thead>
                     <tbody>
                         @php
                             $nomor = 1;
                         @endphp
                         @foreach ($times as $key => $value)
                             <tr>
                                 <td class="table-plus">{{ $nomor++ }}</td>
                                 <td><input name="jam_ke[{{ $value->id }}]" type="number" class="form-control" value="{{ $value->jam_ke }}"></td>
                                 <td><input name="start_time[{{ $value->id }}]" type="time" class="form-control" value="{{ $value->start_time }}"></td>
                                 <td><input name="end_time[{{ $value->id }}]" type="time" class="form-control" value="{{ $value->end_time }}"></td>
                                 <td>
                                     <form id="formDelete-{{ $value->id }}"
                                         action="{{ route('manage.time.delete', ['id_time' => $value->id, 'id_hari' => $day->id]) }}"
                                         method="post" style="display: none;">
                                         @csrf
                                         @method('DELETE')
                                     </form>
                                     <div class="table-actions">
                                         <a onclick="confrmEdit('{{ $value->id }}')" data-color="#265ed7" style="color: rgb(38, 94, 215);"><i class="icon-copy dw dw-edit2"></i></a>
                                         <a onclick="confirmDelete({{ $value->id }})" data-color="#e95959" style="color: rgb(233, 89, 89);"><i class="icon-copy dw dw-delete-3"></i></a>
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
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    @endsection

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

            function confrmEdit(id){
                swal({
                    title: 'Edit Waktu',
                    text: "Apakah kamu yakin ingin Menyimpan perubahan.?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    confirmButtonText: 'Simpan'
                }).then(function (result) {
                    if (result['value']){
                        var url = "{{ route('manage.time.edit', ['id_hari' => ':hari']) }}";
                        url = url.replace(":hari", id);
                        var jam_ke = $('input[name="jam_ke['+ id +']"]').val();
                        var start_time = $('input[name="start_time['+ id +']"]').val();
                        var end_time = $('input[name="end_time['+ id +']"]').val();
                        axios.put(url, {
                            start_time: start_time,
                            end_time: end_time,
                            jam_ke: jam_ke
                        }) // Contoh endpoint API di Laravel
                            .then(function (response) {
                                if (response.data == true){
                                    swal(
                                        {
                                            position: 'top-end',
                                            type: 'success',
                                            title: 'Perubahan berhasil Disimpan',
                                            showConfirmButton: false,
                                            timer: 1500
                                        }
                                    )
                                } else {
                                    swal(
                                        {
                                            position: 'top-end',
                                            type: 'error',
                                            title: 'Perubahan Gagal Disimpan',
                                            showConfirmButton: false,
                                            timer: 1500
                                        }
                                    )
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
                                    )
                            });
                    }
                })
            }


         </script>
     @endsection
 </x-app-layout-v2>
