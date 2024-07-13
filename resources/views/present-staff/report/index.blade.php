<x-app-layout-v2 menuOpen="Report Data Staff" title="Log Absensi Staff" menuActive="Laporan Absen Staff" >
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>LOG ABSENSI STAFF</h4>
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
             <div class="pb-20">
                 <table class="data-table table stripe hover nowrap">
                     <thead>
                         <tr>
                             <th rowspan="2" class="table-plus datatable-nosort">No</th>
                             <th rowspan="2">NIP</th>
                             <th rowspan="2">Nama Staff</th>
                             <th colspan="3">Waktu Absen</th>
                             <th rowspan="2">Status</th>
                             <th rowspan="2">Lama Kerja</th>
                             <th rowspan="2" class="datatable-nosort">Aksi</th>
                         </tr>
                         <tr>
                            <th>Tanggal</th>
                            <th>Waktu Masuk</th>
                            <th>Waktu Keluar</th>
                         </tr>
                     </thead>
                     <tbody>
                         @php
                             $nomor = 1;
                         @endphp
                         @foreach ($report as $key => $value)
                             <tr>
                                 <td class="table-plus">{{ $nomor++ }}</td>
                                 <td>{{ $value->staff->nip }}</td>
                                 <td>{{ $value->staff->name }}</td>
                                 <td>{{ Carbon\Carbon::parse($value->date)->format('d-m-Y') }}</td>
                                 <td>
                                    @if(Auth::user()->role == "superuser")
                                        <input type="time" name="clock_in[{{ $value->id }}]" id="clock_in" class="form-control" value="{{ $value->clock_in }}">
                                    @else
                                        {{ $value->clock_in }}
                                    @endif
                                 </td>
                                 <td>

                                    @if(Auth::user()->role == "superuser")
                                        <input type="time" name="clock_out[{{ $value->id }}]" id="clock_out" class="form-control" value="{{ $value->clock_out }}">
                                    @else
                                        {{ $value->clock_in }}
                                    @endif
                                 </td>
                                 <td>
                                    @if($value->present)
                                        Hadir
                                    @else
                                        Tidak Hadir
                                    @endif
                                 </td>
                                 <td>
                                    @if ($value->clock_out != null)
                                        @php
                                            $clockIn = Carbon\Carbon::parse($value->clock_in);
                                            $clockOut = Carbon\Carbon::parse($value->clock_out);
                                            $diff = $clockOut->diff($clockIn);
                                            $hours = $diff->h; // Jam
                                            $minutes = $diff->i; // Menit
                                        @endphp
                                        {{ "$hours Jam $minutes Menit $diff->s Detik" }}
                                    @else
                                        Absen Belum Lengkap
                                    @endif
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
         </script>
     @endsection
 </x-app-layout-v2>
