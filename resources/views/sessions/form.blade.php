<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($session->name) ? $session->name : ''}}" required>
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('starts_at') ? 'has-error' : ''}}">
    <label for="starts_at" class="control-label">{{ 'Starts At' }}</label>
    <input class="form-control" name="starts_at" type="datetime-local" id="starts_at" value="{{ isset($session->starts_at) ? $session->starts_at : ''}}" required>
    {!! $errors->first('starts_at', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('finishes_at') ? 'has-error' : ''}}">
    <label for="finishes_at" class="control-label">{{ 'Finishes At' }}</label>
    <input class="form-control" name="finishes_at" type="datetime-local" id="finishes_at" value="{{ isset($session->finishes_at) ? $session->finishes_at : ''}}" required>
    {!! $errors->first('finishes_at', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('gym_id') ? 'has-error' : ''}}">
    <label for="gym_id" class="control-label">{{ 'Gym Id' }}</label>
    <input class="form-control" name="gym_id" type="number" id="gym_id" value="{{ isset($session->gym_id) ? $session->gym_id : ''}}" >
    {!! $errors->first('gym_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
