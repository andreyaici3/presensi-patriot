<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label>Guru <sup class="text-danger">*</sup> </label>
            <select name="teacher_id" class="form-control {{ $errors->has('teacher_id') ? 'is-invalid' : '' }}">
                @foreach ($teachers as $value)
                    <option {{ old('teacher_id', isset($data) ? $data->teacher_id : '') == $value->id ? 'selected' : ''}}  value="{{ $value->id }}">{{ $value->kode_guru . " - ". $value->first_name . " " . $value->last_name }}</option>
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
            <label>ID Telegram <sup class="text-danger">*</sup> </label>
            <input class="form-control {{ $errors->has('telegram_id') ? 'is-invalid' : '' }}" type="text"
                name="telegram_id" placeholder="Masukan ID Telegram"
                value="{{ old('telegram_id', isset($data) ? $data->telegram_id : '') }}">
            <span id="telegram_id-error" class="error invalid-feedback">
                {{ $errors->has('telegram_id') ? '*) ' . $errors->first('telegram_id') : '' }}</span>
        </div>
    </div>
</div>

