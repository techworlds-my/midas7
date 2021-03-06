<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMembeCardManagementRequest;
use App\Http\Requests\StoreMembeCardManagementRequest;
use App\Http\Requests\UpdateMembeCardManagementRequest;
use App\Models\MembeCardManagement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MembeCardManagementController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('membe_card_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MembeCardManagement::query()->select(sprintf('%s.*', (new MembeCardManagement)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'membe_card_management_show';
                $editGate      = 'membe_card_management_edit';
                $deleteGate    = 'membe_card_management_delete';
                $crudRoutePart = 'membe-card-managements';

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
            $table->editColumn('card_no', function ($row) {
                return $row->card_no ? $row->card_no : "";
            });
            $table->editColumn('username', function ($row) {
                return $row->username ? $row->username : "";
            });
            $table->editColumn('merchant', function ($row) {
                return $row->merchant ? $row->merchant : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.membeCardManagements.index');
    }

    public function create()
    {
        abort_if(Gate::denies('membe_card_management_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.membeCardManagements.create');
    }

    public function store(StoreMembeCardManagementRequest $request)
    {
        $membeCardManagement = MembeCardManagement::create($request->all());

        return redirect()->route('admin.membe-card-managements.index');
    }

    public function edit(MembeCardManagement $membeCardManagement)
    {
        abort_if(Gate::denies('membe_card_management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.membeCardManagements.edit', compact('membeCardManagement'));
    }

    public function update(UpdateMembeCardManagementRequest $request, MembeCardManagement $membeCardManagement)
    {
        $membeCardManagement->update($request->all());

        return redirect()->route('admin.membe-card-managements.index');
    }

    public function show(MembeCardManagement $membeCardManagement)
    {
        abort_if(Gate::denies('membe_card_management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.membeCardManagements.show', compact('membeCardManagement'));
    }

    public function destroy(MembeCardManagement $membeCardManagement)
    {
        abort_if(Gate::denies('membe_card_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $membeCardManagement->delete();

        return back();
    }

    public function massDestroy(MassDestroyMembeCardManagementRequest $request)
    {
        MembeCardManagement::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
