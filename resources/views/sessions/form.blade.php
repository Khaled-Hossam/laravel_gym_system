<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($session->name) ? $session->name : ''}}" required>
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('starts_at') ? 'has-error' : ''}}">
    <label for="starts_at" class="control-label">{{ 'Starts At' }}</label>
    <input class="form-control" name="starts_at" type="datetime-local" id="starts_at" value="{{ isset($session->starts_at) ? $session->starts_at->format('Y-m-d\ H:i:s')  : ''}}" required>
    {!! $errors->first('starts_at', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('finishes_at') ? 'has-error' : ''}}">
    <label for="finishes_at" class="control-label">{{ 'Finishes At' }}</label>
    <input class="form-control" name="finishes_at" type="datetime-local" id="finishes_at" value="{{ isset($session->finishes_at) ? $session->finishes_at->format('Y-m-d\ H:i:s') : ''}}" required>
    {!! $errors->first('finishes_at', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('gym_id') ? 'has-error' : ''}}">
    <label for="gym_id" class="control-label">{{ 'Gym' }}</label>
    {{ $formMode === 'edit' ? 
     Form::select('gym_id', $gyms, $session->gym_id, ['select','class'=>'col-12 mb-3'] ) :
     Form::select('gym_id', $gyms, null, ['select','class'=>'col-12 mb-3'] ) 
    }}
    {!! $errors->first('gym_id', '<p class="help-block">:message</p>') !!}
</div>

{{ $formMode === 'edit' ? 
     Form::select('coaches[]', $coaches, $session->coaches->pluck('id'), ['multiple','class'=>'col-12 mb-3'] ) :
     Form::select('coaches[]', $coaches, null, ['multiple','class'=>'col-12 mb-3'] )
}}

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
