<?php

namespace App\Http\Controllers;

//use App\Models\Activity_log;
use App\Models\User;
use Spatie\Activitylog\Models\Activity as Activity_log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class Activity_logController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:activity_log-list|activity_log-create|activity_log-edit|activity_log-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:activity_log-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:activity_log-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:activity_log-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data = Activity_log::latest()
            ->leftJoin('users', 'users.id', '=', 'activity_log.causer_id')
            ->addSelect('users.name as name', 'activity_log.*')
            ->groupBy('users.name', 'activity_log.id', 'activity_log.log_name', 'activity_log.description', 'activity_log.subject_type', 'activity_log.event', 'activity_log.subject_id', 'activity_log.causer_type', 'activity_log.causer_id', 'activity_log.properties', 'activity_log.batch_uuid', 'activity_log.created_at', 'activity_log.updated_at')
            ->paginate(10);
        return view('activity_log.index', compact('data'));
    }

    public function create()
    {

        return view('activity_log.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'log_name' => 'required',
            'description' => 'required',
            'subject_type' => 'required',
            'event' => 'required',
            'subject_id' => 'required',
            'causer_type' => 'required',
            'causer_id' => 'required',
            'properties' => 'required',
            'batch_uuid' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('activity_log.create')
                ->withErrors($validator)
                ->withInput();
        }

        Activity_log::create($validator->validated());
        return redirect()->route('activity_log.index');
    }

    public function show($id)
    {
        $data = Activity_log::findOrFail($id);
        $user = [];
        if ($data) {
            $user = User::where('id', $data->causer_id)->first();
        }
        return view('activity_log.show', compact('data', 'user'));
    }

    public function edit($id)
    {
        $data = Activity_log::findOrFail($id);

        return view('activity_log.edit', compact('data', ));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'log_name' => 'required',
            'description' => 'required',
            'subject_type' => 'required',
            'event' => 'required',
            'subject_id' => 'required',
            'causer_type' => 'required',
            'causer_id' => 'required',
            'properties' => 'required',
            'batch_uuid' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('activity_log.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        $data = Activity_log::findOrFail($id);
        $data->update($validator->validated());
        return redirect()->route('activity_log.index');
    }

    public function destroy($id)
    {
        $data = Activity_log::findOrFail($id);
        $data->delete();
        return redirect()->route('activity_log.index');
    }
}
