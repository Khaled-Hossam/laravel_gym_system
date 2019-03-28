<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ old('name', isset($member->name) ? $member->name : '') }}" required>
    {!! $errors->first('name', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Email' }}</label>
    <input class="form-control" name="email" type="email" id="email" value="{{ old('email', isset($member->email) ? $member->email : '') }}" required>
    {!! $errors->first('email', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('national_id') ? 'has-error' : ''}}">
    <label for="national_id" class="control-label">{{ 'National Id' }}</label>
    <input class="form-control" name="national_id" type="text" id="national_id" value="{{ old('national_id', isset($member->national_id) ? $member->national_id : '') }}" required>
    {!! $errors->first('national_id', '<p class="help-block text-danger">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    <label for="password" class="control-label">{{ 'Password' }}</label>
    <input class="form-control" name="password" type="password" id="password" {{ $formMode === 'edit' ? '' : 'required' }}>
    {!! $errors->first('password', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group">
    <label for="password_confirmation" class="control-label">{{ 'Password confirmation' }}</label>
    <input class="form-control" name="password_confirmation" type="password" id="password_confirmation" {{ $formMode === 'edit' ? '' : 'required' }}>
</div>

<div class="form-group {{ $errors->has('avatar') ? 'has-error' : ''}}">
    <label for="avatar" class="control-label">{{ 'Avatar' }}</label>
    <input class="form-control" name="avatar" type="file" id="avatar" value="{{ old('avatar', isset($member->avatar) ? $member->avatar : '') }}" >
    {!! $errors->first('avatar', '<p class="help-block text-danger">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
