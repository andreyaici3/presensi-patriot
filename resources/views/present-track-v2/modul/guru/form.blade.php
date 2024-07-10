<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label>Nama Depan <sup class="text-danger">*</sup> </label>
            <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text"
                name="first_name" placeholder="Masukan Nama Depan"
                value="{{ old('first_name', isset($data) ? $data->first_name : '') }}">
            <span id="first_name-error" class="error invalid-feedback">
                {{ $errors->has('first_name') ? '*) ' . $errors->first('first_name') : '' }}</span>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label>Nama Belakang</label>
            <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text"
                name="last_name" placeholder="Masukan Kode Guru"
                value="{{ old('last_name', isset($data) ? $data->last_name : '') }}">
            <span id="last_name-error" class="error invalid-feedback">
                {{ $errors->has('last_name') ? '*) ' . $errors->first('last_name') : '' }}</span>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-3 col-sm-12">
        <div class="form-group">
            <label>Kode Guru<sup class="text-danger">*</sup></label>
            <input class="form-control {{ $errors->has('kode_guru') ? 'is-invalid' : '' }}" type="number"
                name="kode_guru" placeholder="Masukan Kode Guru"
                value="{{ old('kode_guru', isset($data) ? $data->kode_guru : '') }}">
            <span id="kode_guru-error" class="error invalid-feedback">
                {{ $errors->has('kode_guru') ? '*) ' . $errors->first('kode_guru') : '' }}</span>
        </div>
    </div>
    <div class="col-md-3 col-sm-12">
        <div class="form-group">
            <label>NIP <sup class="text-danger">*</sup></label>
            <input class="form-control {{ $errors->has('nip') ? 'is-invalid' : '' }}" type="number"
                name="nip" placeholder="Masukan Kode Guru"
                value="{{ old('nip', isset($data) ? $data->nip : '') }}">
            <span id="nip-error" class="error invalid-feedback">
                {{ $errors->has('nip') ? '*) ' . $errors->first('nip') : '' }}</span>
        </div>
    </div>
    <div class="col-md-3 col-sm-12">
        <div class="form-group">
            <label>NIK (Optional)</label>
            <input class="form-control {{ $errors->has('nik') ? 'is-invalid' : '' }}" type="number"
                name="nik" placeholder="Masukan Kode Guru"
                value="{{ old('nik', isset($data) ? $data->nik : '') }}">
            <span id="nik-error" class="error invalid-feedback">
                {{ $errors->has('nik') ? '*) ' . $errors->first('nik') : '' }}</span>
        </div>
    </div>
    <div class="col-md-3 col-sm-12">
        <div class="form-group">
            <label>Nomor Hp (Optional)</label>
            <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="number"
                name="phone_number" placeholder="Masukan Kode Guru"
                value="{{ old('phone_number', isset($data) ? $data->phone_number : '') }}">
            <span id="phone_number-error" class="error invalid-feedback">
                {{ $errors->has('phone_number') ? '*) ' . $errors->first('phone_number') : '' }}</span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3 col-sm-12">
        <div class="form-group">
            <label>Jenis Kelamin <sup class="text-danger">*</sup></label>
            <select name="gender" class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                <option value="L">Laki - Laki</option>
                <option value="P">Perempuan</option>
            </select>
            <span id="gender-error" class="error invalid-feedback">
                {{ $errors->has('gender') ? '*) ' . $errors->first('gender') : '' }}</span>
        </div>
    </div>

    <div class="col-md-3 col-sm-12">
        <div class="form-group">
            <label>Tanggal Lahir (Optional)</label>
            <input autocomplete="off" class="form-control date-picker" name="date_of_birth" placeholder="Tanggal Lahir" type="text" value="{{ old('date_of_birth', isset($data) ? $data->date_of_birth : '') }}" />
            <span id="date_of_birth-error" class="error invalid-feedback">
                {{ $errors->has('date_of_birth') ? '*) ' . $errors->first('date_of_birth') : '' }}</span>
        </div>
    </div>
    <div class="col-md-3 col-sm-12">
        <div class="form-group">
            <label>Tanggal Bergabung (Optional)</label>
            <input autocomplete="off" class="form-control date-picker" name="hire_date" placeholder="Tanggal Lahir" type="text" value="{{ old('hire_date', isset($data) ? $data->hire_date : '') }}" />
            <span id="hire_date-error" class="error invalid-feedback">
                {{ $errors->has('hire_date') ? '*) ' . $errors->first('hire_date') : '' }}</span>
        </div>
    </div>

    <div class="col-md-3 col-sm-12">
        <div class="form-group">
            <label>Email <sup class="text-danger">*</sup></label>
            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                name="email" placeholder="Masukan Email Guru"
                value="{{ old('email', isset($data) ? $data->email : '') }}">
            <span id="email-error" class="error invalid-feedback">
                {{ $errors->has('email') ? '*) ' . $errors->first('email') : '' }}</span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label>Alamat Rumah</label>
            <textarea name="address" class="form-control">{{ old('address', isset($data) ? $data->address : '') }}</textarea>
        </div>
    </div>
</div>



