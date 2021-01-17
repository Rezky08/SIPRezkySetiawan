<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $user_model;
    private $role_model;
    function __construct()
    {
        $this->user_model = new User();
        $this->role_model = new Role();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user_model->paginate();
        $data = [
            'title' => "User Data",
            'users' => $users,
            'pagination' => $users->links()->elements[0],
            'number' => $users->firstItem()
        ];
        return view('admin.user.user_list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->role_model->all();
        $data = [
            'title' => "User Form",
            'roles' => $roles,
            'method' => "POST",
        ];
        return view('admin.user.user_form', $data);
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
            'name' => ['required', 'filled'],
            'username' => ['required', 'filled', 'unique:users,username,NULL,id', 'min:6', 'regex:/^(?=[^\d])(?!.*[\s])(?=.*[\w]).{6,}/'],
            'email' => ['required', 'filled', 'email', 'unique:users,email,NULL,id'],
            'role_id' => ['required', 'filled', 'exists:roles,id']
        ];
        $messages = [
            'username.regex' => 'username must without blank space'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        // insert process to database
        try {
            $data = [
                'role_id' => $request->role_id,
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make('password'), //set to default password "password"
            ];
            $user = new User($data);
            $user->save();

            // success
            $response = [
                'success' => 'Success add user'
            ];
            return redirect('admin/user')->with($response);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $response = [
                'error' => 'Server Error'
            ];
            return redirect()->back()->with($response)->withInput();
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
        $user = $this->user_model->findOrFail($id);
        $roles = $this->role_model->all();
        $data = [
            'title' => "User Data",
            'roles' => $roles,
            'method' => "",
            'user' => $user
        ];
        return view('admin.user.user_form', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user_model->findOrFail($id);
        $roles = $this->role_model->all();
        $data = [
            'title' => "User Form",
            'roles' => $roles,
            'method' => "PUT",
            'user' => $user
        ];
        return view('admin.user.user_form', $data);
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
        $user = $this->user_model->findOrFail($id);
        $rules = [
            'name' => ['required', 'filled'],
            'username' => ['required', 'filled', 'unique:users,username,' . $user->id . ',id', 'min:6', 'regex:/^(?=[^\d])(?!.*[\s])(?=.*[\w]).{6,}/'],
            'email' => ['required', 'filled', 'email', 'unique:users,email,' . $user->id . ',id'],
            'role_id' => ['required', 'filled', 'exists:roles,id']
        ];
        $messages = [
            'username.regex' => 'username must without blank space'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        // insert process to database
        try {
            $data = [
                'role_id' => $request->role_id,
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                //in update, admin cannot change password
            ];
            foreach ($data as $key => $value) {
                $user->$key = $value;
            }
            $user->save();

            // success
            $response = [
                'success' => 'Success update user'
            ];
            return redirect('admin/user')->with($response);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $response = [
                'error' => 'Server Error'
            ];
            return redirect()->back()->with($response)->withInput();
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
        $user = $this->user_model->findOrFail($id);
        try {
            $user->delete();
            $response = [
                'success' => 'Success delete user'
            ];
            return redirect('admin/user')->with($response);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $response = [
                'error' => 'Server error 500'
            ];
            return redirect('admin/user')->with($response);
        }
    }
}
