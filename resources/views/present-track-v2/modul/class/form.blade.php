<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label>Kelas <sup class="text-danger">*</sup> </label>
            <select name="grade" class="form-control {{ $errors->has('grade') ? 'is-invalid' : '' }}">
                <option value="X">X</option>
                <option value="XI">XI</option>
                <option value="XII">XII</option>
            </select>
            <span id="grade-error" class="error invalid-feedback">
                {{ $errors->has('grade') ? '*) ' . $errors->first('grade') : '' }}</span>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label>Jurusan <sup class="text-danger">*</sup> </label>
            <select name="major_id" class="form-control {{ $errors->has('major_id') ? 'is-invalid' : '' }}">
                @foreach ($major as $value)
                    <option {{ old('major_id', isset($data) ? $data->major_id : '') == $value->id ? 'selected' : ''}}  value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
            <span id="name-error" class="error invalid-feedback">
                {{ $errors->has('name') ? '*) ' . $errors->first('name') : '' }}</span>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label>Nomor Rombel <sup class="text-danger">*</sup> </label>
            <input class="form-control {{ $errors->has('rombel_number') ? 'is-invalid' : '' }}" type="number"
                name="rombel_number" placeholder="Masukan Nomor Rombel"
                value="{{ old('rombel_number', isset($data) ? $data->rombel_number : '') }}">
            <span id="rombel_number-error" class="error invalid-feedback">
                {{ $errors->has('rombel_number') ? '*) ' . $errors->first('rombel_number') : '' }}</span>
        </div>
    </div>
</div>
