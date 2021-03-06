@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.history.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.histories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.history.fields.id') }}
                        </th>
                        <td>
                            {{ $history->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.history.fields.username') }}
                        </th>
                        <td>
                            {{ $history->username->username ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.history.fields.gate') }}
                        </th>
                        <td>
                            {{ $history->gate->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.history.fields.qr') }}
                        </th>
                        <td>
                            {{ $history->qr }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.history.fields.type') }}
                        </th>
                        <td>
                            {{ $history->type }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.histories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection