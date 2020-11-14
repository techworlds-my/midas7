<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPointLogRequest;
use App\Http\Requests\StorePointLogRequest;
use App\Http\Requests\UpdatePointLogRequest;
use App\Models\PointLog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PointLogController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('point_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PointLog::query()->select(sprintf('%s.*', (new PointLog)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'point_log_show';
                $editGate      = 'point_log_edit';
                $deleteGate    = 'point_log_delete';
                $crudRoutePart = 'point-logs';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('point_gain', function ($row) {
                return $row->point_gain ? $row->point_gain : "";
            });
            $table->editColumn('username', function ($row) {
                return $row->username ? $row->username : "";
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.pointLogs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('point_log_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pointLogs.create');
    }

    public function store(StorePointLogRequest $request)
    {
        $pointLog = PointLog::create($request->all());

        return redirect()->route('admin.point-logs.index');
    }

    public function edit(PointLog $pointLog)
    {
        abort_if(Gate::denies('point_log_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pointLogs.edit', compact('pointLog'));
    }

    public function update(UpdatePointLogRequest $request, PointLog $pointLog)
    {
        $pointLog->update($request->all());

        return redirect()->route('admin.point-logs.index');
    }

    public function show(PointLog $pointLog)
    {
        abort_if(Gate::denies('point_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pointLogs.show', compact('pointLog'));
    }

    public function destroy(PointLog $pointLog)
    {
        abort_if(Gate::denies('point_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointLog->delete();

        return back();
    }

    public function massDestroy(MassDestroyPointLogRequest $request)
    {
        PointLog::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
