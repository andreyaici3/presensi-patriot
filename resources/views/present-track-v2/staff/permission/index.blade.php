<x-app-layout-v2 menuActive="Data Izin" title="Management Izin">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Permintaan Izin Guru</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                    Permintaan Izin Guru
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
                <h4 class="text-blue h4">Daftar Permintaan Izin</h4>
            </div>
            <div class="pb-20">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">No</th>
                            <th>Nama Guru</th>
                            <th>Kelas</th>
                            <th>Jadwal</th>
                            <th>Alasan</th>
                            <th class="datatable-nosort">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $nomor = 1;
                        @endphp
                        @foreach ($permissions as $key => $value)
                            <tr>
                                <td class="table-plus">{{ $nomor++ }}</td>
                                <td>
                                    {{ $value->attendance->teacher->first_name . " " . $value->attendance->teacher->last_name }}
                                </td>
                                <td>{{ $value->attendance->classes->grade . "-" . $value->attendance->classes->major->code . "-" . $value->attendance->classes->rombel_number }}</td>
                                <td>
                                    {{ "Jam Ke: " . $value->attendance->schedule->timeSlot->jam_ke . " " . $value->attendance->schedule->timeSlot->start_time . " S/D " . $value->attendance->schedule->timeSlot->end_time  }}
                                </td>
                                <td>
                                    @if ($value->status == "sick")
                                        SAKIT
                                    @else
                                        IZIN KEPERLUAN LAIN
                                    @endif
                                </td>
                                <td>
                                    <form id="formAccept-{{ $value->id }}"
                                        action="{{ route('manage.permission.accept', ['id' => $value->id]) }}"
                                        method="post" style="display: none;">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                    <form id="formReject-{{ $value->id }}"
                                        action="{{ route('manage.permission.reject', ['id' => $value->id]) }}"
                                        method="post" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <div class="table-actions">
                                        <a href="#" onclick="return confirmAccept({{ $value->id }})" data-color="#265ed7" style="color: rgb(38, 94, 215);"><i class="icon-copy fa fa-check" aria-hidden="true"></i></a>
                                        <a href="#" onclick="return confirmReject({{ $value->id }})" data-color="#e95959" style="color: rgb(233, 89, 89);"><i class="icon-copy fa fa-close" aria-hidden="true"></i></a>
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

            function confirmAccept(id){
                swal({
                    title: 'Setujui Izin',
                    text: "Jika disetujui semua jam yang bersangkutan dengan kelas ini akan ikut tersetujui.?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    confirmButtonText: 'Ya, Lanjutkan!!'
                }).then(function (result) {
                    if (result['value']){
                        $("#formAccept-" + id).submit();
                    }
                })
            }

            function confirmReject(id){
                swal({
                    title: 'Tolak Izin',
                    text: "Jika ditolak semua jam yang bersangkutan dengan kelas ini akan ikut tertolak.?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    confirmButtonText: 'Ya, Lanjutkan!!'
                }).then(function (result) {
                    if (result['value']){
                        $("#formReject-" + id).submit();
                    }
                })
            }

         </script>
     @endsection
</x-app-layout-v2>
