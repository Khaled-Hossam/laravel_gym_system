<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ old('name', isset($user->name) ? $user->name : '') }}" required>
    {!! $errors->first('name', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Email' }}</label>
    <input class="form-control" name="email" type="email" id="email" value="{{ old('email', isset($user->email) ? $user->email : '') }}" required>
    {!! $errors->first('email', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('national_id') ? 'has-error' : ''}}">
    <label for="national_id" class="control-label">{{ 'National Id' }}</label>
    <input class="form-control" name="national_id" type="text" id="national_id" value="{{ old('national_id', isset($user->national_id) ? $user->national_id : '') }}" required>
    {!! $errors->first('national_id', '<p class="help-block text-danger">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    <label for="password" class="control-label">{{ 'Password' }}</label>
    <input class="form-control" name="password" type="password" id="password" {{ $formMode === 'edit' ? '' : 'required' }}>
    {!! $errors->first('password', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : ''}}">
    <label for="password_confirmation" class="control-label">{{ 'Password confirmation' }}</label>
    <input class="form-control" name="password_confirmation" type="password" id="password_confirmation" {{ $formMode === 'edit' ? '' : 'required' }}>
    {!! $errors->first('password_confirmation', '<p class="help-block text-danger">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('avatar') ? 'has-error' : ''}}">
    <label for="avatar" class="control-label">{{ 'Avatar' }}</label>
    <input class="form-control" name="avatar" type="file" id="avatar" value="{{ old('avatar', isset($user->avatar) ? $user->avatar : '') }}" >
    {!! $errors->first('avatar', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('gym_id') ? 'has-error' : ''}}">
    <label for="gym_id" class="control-label">{{ 'Gym Id' }}</label>
    {{ $formMode === 'edit' ? 
     Form::select('gym_id', $gyms, $user->gym_id, ['select','class'=>'col-12 mb-3'] ) :
     Form::select('gym_id', $gyms, null, ['select','class'=>'col-12 mb-3'] ) 
    }}
    {!! $errors->first('gym_id', '<p class="help-block text-danger">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
