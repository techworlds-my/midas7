@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.membeCardManagement.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.membe-card-managements.update", [$membeCardManagement->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="card_no">{{ trans('cruds.membeCardManagement.fields.card_no') }}</label>
                <input class="form-control {{ $errors->has('card_no') ? 'is-invalid' : '' }}" type="text" name="card_no" id="card_no" value="{{ old('card_no', $membeCardManagement->card_no) }}" required>
                @if($errors->has('card_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('card_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.membeCardManagement.fields.card_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="username">{{ trans('cruds.membeCardManagement.fields.username') }}</label>
                <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" type="text" name="username" id="username" value="{{ old('username', $membeCardManagement->username) }}" required>
                @if($errors->has('username'))
                    <div class="invalid-feedback">
                        {{ $errors->first('username') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.membeCardManagement.fields.username_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="merchant">{{ trans('cruds.membeCardManagement.fields.merchant') }}</label>
                <input class="form-control {{ $errors->has('merchant') ? 'is-invalid' : '' }}" type="text" name="merchant" id="merchant" value="{{ old('merchant', $membeCardManagement->merchant) }}" required>
                @if($errors->has('merchant'))
                    <div class="invalid-feedback">
                        {{ $errors->first('merchant') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.membeCardManagement.fields.merchant_helper') }}</span>
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