<div class="card-body">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Nama Operator</label>
        <div class="col-sm-10">
            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name"
                placeholder="Masukan Nama Operator" name="name" value="{{ old('name') ?? @$user->name }}">
            <span id="name-error"
                class="error invalid-feedback">{{ $errors->has('name') ? '*) ' . $errors->first('name') : '' }}</span>
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email"
                placeholder="Masukan Email" name="email" value="{{ old('email') ?? @$user->email }}">
            <span id="email-error"
                class="error invalid-feedback">{{ $errors->has('email') ? '*) ' . $errors->first('email') : '' }}</span>
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                id="password" placeholder="Masukan password" name="password"
                value="{{ old('password') ?? @$staff->kode_guru }}">
            <span id="password-error"
                class="error invalid-feedback">{{ $errors->has('password') ? '*) ' . $errors->first('password') : '' }}</span>
        </div>
    </div>

    <div class="form-group row">
        <label for="role" class="col-sm-2 col-form-label">Role</label>
        <div class="col-sm-10">
            <select name="role" id="role" class="form-control">
                <option {{ (@$user->role == "kepsek") ? "selected" : "" }} value="kepsek">Kepala Sekolah</option>
                <option {{ (@$user->role == "ict") ? "selected" : "" }} value="ict">Information Center</option>
                <option {{ (@$user->role == "user") ? "selected" : "" }} value="user">Bid. Kurikulum</option>
                <option {{ (@$user->role == "bidSiswa") ? "selected" : "" }} value="bidSiswa">Bid. Kesiswaan</option>
                <option {{ (@$user->role == "wakasek") ? "selected" : "" }} value="wakasek">Wakasek</option>
            </select>
        </div>
    </div>
</div>

<div class="card-footer">
    <button type="submit" class="btn btn-info">
        @if (isset($user))
            Simpan Data
        @else
            Tambah Data
        @endif
    </button>
    <a href="{{ route('superuser.operator.index') }}" class="btn btn-danger float-right">Kembali</a>
</div>
