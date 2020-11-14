@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.pointLog.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.point-logs.update", [$pointLog->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="point_gain">{{ trans('cruds.pointLog.fields.point_gain') }}</label>
                <input class="form-control {{ $errors->has('point_gain') ? 'is-invalid' : '' }}" type="number" name="point_gain" id="point_gain" value="{{ old('point_gain', $pointLog->point_gain) }}" step="1" required>
                @if($errors->has('point_gain'))
                    <div class="invalid-feedback">
                        {{ $errors->first('point_gain') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointLog.fields.point_gain_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="username">{{ trans('cruds.pointLog.fields.username') }}</label>
                <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" type="text" name="username" id="username" value="{{ old('username', $pointLog->username) }}" required>
                @if($errors->has('username'))
                    <div class="invalid-feedback">
                        {{ $errors->first('username') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointLog.fields.username_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.pointLog.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $pointLog->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointLog.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection