<x-app-layout-v2 menuOpen="Report Data" title="Log Absensi" menuActive="Laporan Absen" >
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>LOG ABSENSI</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Log Absen
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
                <div class="row">
                    <div class="col-md-12">

                        <a href="{{ route('attendance.free') }}" class="btn btn-primary" onclick="return confirm('Jika Dilanjutkan maka semua guru akan dianggap hadir pada hari ini')">Hari Libur</a>
                    </div>
                </div>
            </div>
             <div class="pb-20">
                 <table class="data-table table stripe hover nowrap">
                     <thead>
                         <tr>
                             <th class="table-plus datatable-nosort">No</th>
                             <th>Kode Guru</th>
                             <th>Nama Guru</th>
                             <th>Waktu Absen</th>
                             <th>Status</th>
                             <th>Kelas</th>
                             <th class="datatable-nosort">Aksi</th>
                         </tr>
                     </thead>
                     <tbody>
                         @php
                             $nomor = 1;
                         @endphp
                         @foreach ($report as $key => $value)
                             <tr>
                                 <td class="table-plus">{{ $nomor++ }}</td>
                                 <td>{{ $value->teacher->kode_guru }}</td>
                                 <td>{{ $value->teacher->first_name . " " . $value->teacher->last_name}} </td>
                                 <td>{{ Carbon\Carbon::parse($value->attendance_time)->format('d-m-Y H:i:s') }} </td>
                                 <td>
                                    {{ $value->status }}
                                </td>
                                 <td>
                                    {{ $value->classes->grade . "-". $value->classes->major->code ."-" . $value->classes->rombel_number }}
                                 </td>
                                 <td>
                                    @if (Auth::user()->role == "superuser")
                                        <a href="" data-color="#265ed7" style="color: rgb(38, 94, 215);"><i class="icon-copy dw dw-edit2"></i></a>
                                        <a href="#" data-color="#e95959" style="color: rgb(233, 89, 89);"><i class="icon-copy dw dw-delete-3"></i></a>
                                    @else
                                        <a href="" class="text-danger"><i>Don't Have Access</i></a>
                                    @endif
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
                     scrollX:true,
                     autoWidth: false,
                     responsive: false,
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
