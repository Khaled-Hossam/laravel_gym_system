<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ old('name', isset($gym->name) ? $gym->name : '') }}" required>
    {!! $errors->first('name', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('cover_image') ? 'has-error' : ''}}">
    <label for="cover_image" class="control-label">{{ 'Cover Image' }}</label>
    <input class="form-control" name="cover_image" type="file" id="cover_image" value="{{ old('cover_image', isset($gym->cover_image) ? $gym->cover_image : '') }}" >
    {!! $errors->first('cover_image', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('city_id') ? 'has-error' : ''}}">
    <label for="city_id" class="control-label">{{ 'City' }}</label>
    {{ $formMode === 'edit' ? 
    Form::select('city_id', $cities, $gym->city_id, ['select','class'=>'col-12 mb-3'] ) :
    Form::select('city_id', $cities, null, ['select','class'=>'col-12 mb-3'] ) 
}}
    {!! $errors->first('city_id', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('creator_id') ? 'has-error' : ''}}">
    <label for="creator_id" class="control-label">{{ 'Creator' }}</label>
    {{ $formMode === 'edit' ? 
    Form::select('creator_id', $users, $gym->creator_id, ['select','class'=>'col-12 mb-3'] ) :
    Form::select('creator_id', $users, null, ['select','class'=>'col-12 mb-3'] ) 
}}
    {!! $errors->first('creator_id', '<p class="help-block text-danger">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
