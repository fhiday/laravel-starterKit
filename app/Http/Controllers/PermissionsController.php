<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PermissionsController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:permissions-list|permissions-create|permissions-edit|permissions-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:permissions-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:permissions-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:permissions-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $data = Permission::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('guard_name', 'like', "%{$search}%");
        })->latest()->paginate(10);

        return view('permissions.index', compact('data', 'search'));
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'guard_name' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('permissions.create')
                ->withErrors($validator)
                ->withInput();
        }

        Permission::create($validator->validated());
        return redirect()->route('permissions.index');
    }

    public function show($id)
    {
        $data = Permission::findOrFail($id);
        return view('permissions.show', compact('data'));
    }

    public function edit($id)
    {
        $data = Permission::findOrFail($id);

        return view('permissions.edit', compact('data', ));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'guard_name' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('permissions.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        $data = Permission::findOrFail($id);
        $data->update($validator->validated());
        return redirect()->route('permissions.index');
    }

    public function destroy($id)
    {
        $data = Permission::findOrFail($id);
        $data->delete();
        return redirect()->route('permissions.index');
    }
}
