<x-app-layout-v2 menuActive="Data Waktu" title="Tambah Waktu Pelajaran">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Tambah Waktu Pelajaran</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                             <a href="{{ route('manage.days') }}">Data Waktu</a>
                         </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                 Tambah Waktu Pelajaran
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

     <div class="pd-20 card-box mb-30">
        <div class="mb-4">
            <h4 class="text-blue h4">Tambah Jam di Hari {{ $hari->name }}</h4>
        </div>
         <form method="POST" action="{{ route('manage.time.create', ['id_hari' => $hari->id]) }}">
             @csrf
            <div id="blok">
                <div class="row">
                    <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                            <label>Waktu Mulai</label>
                            <input
                                class="form-control"
                                type="time"
                                name="start_time[]"
                            />
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                            <label>Waktu Selesai</label>
                            <input
                                class="form-control"
                                placeholder="time"
                                type="time"
                                name="end_time[]"
                            />
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                            <label>Jam Ke</label>
                            <input
                                class="form-control"
                                placeholder="Jam Keberapa"
                                type="number"
                                name="jam_ke[]"
                                required
                            />
                        </div>
                    </div>
                </div>

            </div>

            <button type="button" id="minus" class="btn btn-danger" onclick="minusElement()">-</button>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
            <button type="button" id="plus" class="btn btn-success" onclick="plusElement()">+</button>
         </form>
     </div>

    </div>

    @section('js')
        <script>
            counter = 0;

            function minusElement(){
                if(counter > 0){
                    counter--;
                    var e = $('#blok .row:last').remove();
                }
            }

            function plusElement(){
                counter++;
                console.log(counter);
                var e = $('#blok .row:first').clone();
                $('#blok').append(e);
            }
        </script>
    @endsection
 </x-app-layout-v2>
