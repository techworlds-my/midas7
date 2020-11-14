<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMembershipManagementRequest;
use App\Http\Requests\StoreMembershipManagementRequest;
use App\Http\Requests\UpdateMembershipManagementRequest;
use App\Models\MembershipManagement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MembershipManagementController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('membership_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MembershipManagement::query()->select(sprintf('%s.*', (new MembershipManagement)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'membership_management_show';
                $editGate      = 'membership_management_edit';
                $deleteGate    = 'membership_management_delete';
                $crudRoutePart = 'membership-managements';

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
            $table->editColumn('username', function ($row) {
                return $row->username ? $row->username : "";
            });
            $table->editColumn('merchant', function ($row) {
                return $row->merchant ? $row->merchant : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.membershipManagements.index');
    }

    public function create()
    {
        abort_if(Gate::denies('membership_management_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.membershipManagements.create');
    }

    public function store(StoreMembershipManagementRequest $request)
    {
        $membershipManagement = MembershipManagement::create($request->all());

        return redirect()->route('admin.membership-managements.index');
    }

    public function edit(MembershipManagement $membershipManagement)
    {
        abort_if(Gate::denies('membership_management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.membershipManagements.edit', compact('membershipManagement'));
    }

    public function update(UpdateMembershipManagementRequest $request, MembershipManagement $membershipManagement)
    {
        $membershipManagement->update($request->all());

        return redirect()->route('admin.membership-managements.index');
    }

    public function show(MembershipManagement $membershipManagement)
    {
        abort_if(Gate::denies('membership_management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.membershipManagements.show', compact('membershipManagement'));
    }

    public function destroy(MembershipManagement $membershipManagement)
    {
        abort_if(Gate::denies('membership_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $membershipManagement->delete();

        return back();
    }

    public function massDestroy(MassDestroyMembershipManagementRequest $request)
    {
        MembershipManagement::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
