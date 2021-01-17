<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    private $role_model;
    protected $redirectTo;
    function __construct()
    {
        $this->role_model = new Role();
        $this->redirectTo = "admin/role";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->role_model->paginate();
        $data = [
            'title' => "Role Data",
            'roles' => $roles,
            'pagination' => $roles->links()->elements[0],
            'number' => $roles->firstItem()
        ];
        return view('admin.role.role_list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => "Role Form",
            'method' => "POST",
        ];
        return view('admin.role.role_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'filled', 'unique:roles,name']
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        try {
            $data = [
                'name' => $request->name
            ];
            $role = new Role($data);
            $role->save();

            // success
            $response = [
                'success' => 'Success add role'
            ];
            return redirect($this->redirectTo)->with($response);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $response = [
                'error' => 'Server error 500'
            ];
            return redirect($this->redirectTo)->with($response);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->role_model->findOrFail($id);
        $data = [
            'title' => "Role Data",
            'method' => "",
            'role' => $role
        ];
        return view('admin.role.role_form', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->role_model->findOrFail($id);
        $data = [
            'title' => "Role Form",
            'method' => "PUT",
            'role' => $role
        ];
        return view('admin.role.role_form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = $this->role_model->findOrFail($id);
        $rules = [
            'name' => ['required', 'filled', 'unique:roles,name,' . $role->id . ',id']
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        try {
            $data = [
                'name' => $request->name
            ];
            foreach ($data as $key => $value) {
                $role->$key = $value;
            }
            $role->save();

            // success
            $response = [
                'success' => 'Success update role'
            ];
            return redirect($this->redirectTo)->with($response);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $response = [
                'error' => 'Server error 500'
            ];
            return redirect($this->redirectTo)->with($response);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = $this->role_model->findOrFail($id);
        try {
            $role->delete();
            $response = [
                'success' => 'Success delete role'
            ];
            return redirect($this->redirectTo)->with($response);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $response = [
                'error' => 'Server error 500'
            ];
            return redirect($this->redirectTo)->with($response);
        }
    }
}
