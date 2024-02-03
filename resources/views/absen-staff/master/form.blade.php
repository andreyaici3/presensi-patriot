<div class="card-body">
    <div class="form-group row">
        <label for="kdStaff" class="col-sm-2 col-form-label">Kode Staff</label>
        <div class="col-sm-10">
            <input type="number" class="form-control {{ $errors->has('kdStaff') ? 'is-invalid' : '' }}" id="kdStaff"
                placeholder="Masukan Kode Staff" name="kdStaff" value="{{ old('kdStaff') ?? @$staff->kode_guru }}">
            <span id="kdStaff-error"
                class="error invalid-feedback">{{ $errors->has('kdStaff') ? '*) ' . $errors->first('kdStaff') : '' }}</span>
        </div>
    </div>
    <div class="form-group row">
        <label for="nik" class="col-sm-2 col-form-label">NIPP / NUPTK</label>
        <div class="col-sm-10">
            <input type="number" class="form-control {{ $errors->has('nik') ? 'is-invalid' : '' }}" id="nik"
                placeholder="Masukan NIK / NUPTK" name="nik" value="{{ old('nik') ?? @$staff->nik }}">
            <span id="nik-error"
                class="error invalid-feedback">{{ $errors->has('nik') ? '*) ' . $errors->first('nik') : '' }}</span>
        </div>

    </div>
    <div class="form-group row">
        <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
        <div class="col-sm-10">
            <input type="text" class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" id="nama"
                placeholder="Masukan Nama Lengkap" name="nama" value="{{ old('nama') ?? @$staff->nama_guru }}">
            <span id="nama-error"
                class="error invalid-feedback">{{ $errors->has('nama') ? '*) ' . $errors->first('nama') : '' }}</span>
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email"
                placeholder="Email" name="email" value="{{ old('email') ?? @$staff->email }}"
                @if (isset($staff)) readonly @endif>
            <span id="email-error"
                class="error invalid-feedback">{{ $errors->has('email') ? '*) ' . $errors->first('email') : '' }}</span>
        </div>
    </div>

</div>

<div class="card-footer">
    <button type="submit" class="btn btn-info">
        @if (isset($staff))
            Simpan Data
        @else
            Tambah Data
        @endif
    </button>
    <a href="{{ route('wakasek.staff') }}" class="btn btn-danger float-right">Kembali</a>
</div>
