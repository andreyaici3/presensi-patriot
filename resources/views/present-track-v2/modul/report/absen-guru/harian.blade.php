<x-app-layout-v2 menuOpen="Report Data" title="Laporan Harian" menuActive="Laporan Harian" >
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
                                Laporan Harian
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
                             <th rowspan="2">Nama Guru</th>
                             <th colspan="4">Keterangan</th>
                             <th rowspan="2">Total Jam</th>
                             <th rowspan="2">Jumlah Kehadiran (H+S)</th>
                         </tr>
                         <tr>
                            <th>H</th>
                            <th>S</th>
                            <th>I</th>
                            <th>A</th>
                         </tr>
                     </thead>
                     <tbody>
                         @php
                             $nomor = 1;
                         @endphp
                         @foreach ($absen as $key => $value)
                             <tr>
                                 <td class="table-plus">{{ $nomor++ }}</td>
                                 <td><span class="badge badge-success">{{ $value->kode_guru }}</span> - {{ $value->first_name . " " . $value->last_name }} </td>
                                 <td>{{ $value["summary"]["present"] }}</td>
                                 <td>
                                    {{ $value["summary"]["sick"] }}
                                </td>
                                <td>
                                    {{ $value["summary"]["permission"] }}
                                </td>
                                <td>
                                    {{ $value["summary"]["late"] }}
                                </td>
                                <td>
                                    {{ $value->schedules->count() }} Jam
                                 </td>
                                 <td>
                                    @php
                                        $jumlah = $value["summary"]["present"] + $value["summary"]["sick"];
                                        $percent = 0;
                                        if ($value->schedules->count() > 0)
                                            $percent = $jumlah / $value->schedules->count() * 100;
                                    @endphp
                                    @if ($percent == 0)
                                        <span class="badge badge-primary">TIdak Ada Jam</span>
                                    @elseif($percent > 0&& $percent < 70)
                                        <span class="badge badge-danger">{{ number_format($percent, '2') }} %</span>
                                    @else
                                        <span class="badge badge-success">{{ number_format($percent, '2') }} %</span>
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
                     scrollCollape: true,
                     pageLength: 100,
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