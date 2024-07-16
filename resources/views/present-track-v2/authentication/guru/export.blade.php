<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Akun Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style type="text/css">
        @page {
            size: auto;
            /* auto is the initial value */

            /* this affects the margin in the printer settings */
            margin: 1cm 1cm 1cm 1cm;
        }

        header {
            position: fixed;
            top: -10px;
            left: 0px;
            right: 0px;
            height: 10px;

            /** Extra personal styles **/
            text-align: center;
            line-height: 35px;
            font-family: monospace;
            font-size: 10px;
        }

        footer {
            position: fixed;
            bottom: -25px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            text-align: center;
            line-height: 35px;
            font-family: monospace;
            font-size: 10px;
        }


        header>table {
            table-layout: fixed;
            width: 100%;
        }

        body {
            margin: 0 auto;
            font-family: Arial, Helvetica, sans-serif;
        }

        .h1 {
            font-size: 13pt;
            font-weight: bold;
        }

        .h2 {
            font-size: 18pt;
            font-weight: bold;
        }

        .h3 {
            font-size: 12pt;
            font-weight: bold;
        }

        .h4 {
            font-size: 10pt;
            font-weight: normal;
        }

        .h5 {
            font-size: 16pt;
            font-weight: bold;
            text-decoration: underline;
        }

        .line-satu {
            line-height: 1px;
        }

        .hr1 {
            margin-top: 5px;
            height: 3px;
            background-color: black !important;
            width: 100%;
            margin-bottom: 3px;
        }

        .hr2 {
            height: 1px;
            background-color: black !important;
            width: 100%;
        }


        .h6 {
            font-size: 12pt;
        }

        .body-report {
            font-family: 'Arial, sans-serif';
        }

        .footer {
            margin-top: 1cm;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }



        }
    </style>
</head>

<body>

    <header>
        <table width="100%" cellpadding="0">
            <tr>
                <td class="text-start">{{ date('d-m-Y') }}</td>

                <td class="text-end">https://presensi-patriot.andrey.id/</td>
            </tr>
        </table>
    </header>

    <br>
    <section class="text-center">
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td style="vertical-align: top;">
                    <img src="{{ asset('pt-v2/assets/images/logos/yayasan.png') }}" width="100px" height="100px">
                </td>
                <td width="100%">
                    <div class="line-satu">
                        <span class="h1">YAYASAN PATRIOT PENDIDIKAN ALI SURATMAN</span><br>
                        <span class="h2">SMK MODEL PATRIOT IV CIAWIGEBANG</span><br>
                        <span class="h3">STATUS TERAKREDITASI : "A" (UNGGUL)</span><br>
                        <span class="h4">Jalan Raya Sidaraja - Ciomas Kec. Ciawigebang Kab.Kuningan
                            45591</span><br>
                        <span class="h4">Telp / fax : 0232 878077</span><br>
                        <span class="h4">Website http//:www.smkpatriot-kng.sch.id</span>
                    </div>
                </td>
                <td style="vertical-align: top;">
                    <img src="{{ asset('pt-v2/assets/images/logos/sekolah.png') }}" alt="" width="100px" height="100px">
                </td>
            </tr>
        </table>

    </section>

    <div class="line-satu">
        <div class="hr1"></div>
        <div class="hr2"></div>
    </div>


    <section class="body-report">
        <div class="line-satu text-center">
            <div class="h5 mt-4 txt-center">Username Patriot Teacher Track</div><br>
            <div class="txt-center h6" style="margin-top: -10px;"></div>
        </div>

        <table class="mt-4 table table-responsive table-striped table-bordered">
            <thead>
                <tr>
                    <th width="10%" class="text-center">Kode Guru</th>
                    <th class="text-center">Nama Guru</th>
                    <th class="text-center" colspan="4">Username / Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guru as $value)
                    <tr>
                        <td class="text-center">{{ $value->kode_guru }}</td>
                        <td class="text-left">{{ $value->first_name . " " . $value->last_name }}</td>
                        <td class="text-left">{{ $value->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <section class="line-satu">
            <p>Keterangan:</p>
            <p>*). Harap Bpk/Ibu Menggunakan Versi Terbaru V2.0</p>
            <p>*). Login hanya bisa dilakukan 1x, jika terkunci hubungi admin</p>
        </section>

        <br><br><br>
        <section class="footer">
            <div class="line-satu float-end">
                <p>Ciawigebang, {{ Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</p>
                <p>Wakasek Kurikulum</p>

                <p style="margin-top: 2cm;">ANDI YULIA RIADI, M.I.Kom.</p>
            </div>
        </section>
    </section>

    <footer>
        <table width="100%" cellpadding="0">
            <tr>
                <td class="text-center">Author: Andrey Andriansyah, S.Kom</td>
            </tr>
        </table>
    </footer>

</body>

</html>