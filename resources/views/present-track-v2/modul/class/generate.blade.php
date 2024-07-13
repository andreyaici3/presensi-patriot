<x-app-layout-v2 menuActive="Data Kelas" menuOpen="Master Data" title="Data Kelas">
   <div class="min-height-200px">
       <div class="page-header">
           <div class="row">
               <div class="col-md-6 col-sm-12">
                   <div class="title">
                       <h4>Generate QR Code</h4>
                   </div>
                   <nav aria-label="breadcrumb" role="navigation">
                       <ol class="breadcrumb">
                           <li class="breadcrumb-item">
                               <a href="{{ route('dashboard') }}">Home</a>
                           </li>
                           <li class="breadcrumb-item active" aria-current="page">
                                Generate QR
                           </li>
                       </ol>
                   </nav>
               </div>
           </div>
       </div>

       <div class="card-box mb-30 pd-20">
            <a id="download-btn" href="#" class="btn btn-primary">Download Gambar</a>

            <br>
            <br>
            <div class="container-wm" id="container-wm">
                <img src="{{ asset('pt-v2/assets/images/backgrounds/qr_template.png') }}" alt="Main Image">
                <img class="watermark" src="{{ asset('storage/qrcodes/qrcode.png') }}" alt="Watermark">
                <h1 class="title-wm">
                    @php
                        if ($data->grade == 'X'){
                            $ks = $data->grade . "-" . $data->major->program_keahlian_acronym . "-" . $data->rombel_number;
                        } else {
                            $ks = $data->grade . "-" . $data->major->konsentrasi_keahlian_acronym . "-" . $data->rombel_number;
                        }
                    @endphp
                    ({{ $ks }})
                </h1>
                <h2 class="code-wm">For Iphone User Please Input: {{ base64_encode($data->id) }}</h2>
            </div>


       </div>
   </div>

   @section('head')
       <style type="text/css">
                .container-wm {
                position: relative;
                width: 50%;
            }

            .watermark {
                width: 53%;
                position: absolute;
                top: 38%;
                left: 23%;
            }

            .title-wm {
                color: #C43430;
                position: absolute;
                top: 19.5%;
                left: 34%;
                font-size: 2.5vw;
            }

            .code-wm {
                color: #C43430;
                position: absolute;
                top: 25.5%;
                font-style: italic;
                left: 30%;
                font-size: 1vw;
            }
    </style>
   @endsection

   @section('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.js" integrity="sha512-sn/GHTj+FCxK5wam7k9w4gPPm6zss4Zwl/X9wgrvGMFbnedR8lTUSLdsolDRBRzsX6N+YgG6OWyvn9qaFVXH9w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
       <script>
            const container = document.getElementById('container-wm');

            // Ambil tombol download
            const downloadBtn = document.getElementById('download-btn');

            // Tambahkan event listener untuk tombol download
            downloadBtn.addEventListener('click', function() {
                // Buat elemen canvas
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');

                // Atur ukuran canvas sesuai dengan ukuran elemen container
                canvas.width = container.offsetWidth;
                canvas.height = container.offsetHeight;
                var nama = '{{ $data->grade . "-" . $data->major->code . "-" .$data->rombel_number }}';
                // // Gambar ulang elemen container ke dalam canvas
                html2canvas(container).then(function(canvas) {
                    // Ubah canvas menjadi URL data gambar
                    const dataURL = canvas.toDataURL('image/png');

                    // Buat link untuk download
                    const downloadLink = document.createElement('a');
                    downloadLink.href = dataURL;
                    downloadLink.download = 'qr_code_'+ nama + '.png'; // Nama file yang akan didownload
                    downloadLink.click(); // Klik otomatis link download
                });
            });

       </script>
   @endsection
</x-app-layout-v2>
