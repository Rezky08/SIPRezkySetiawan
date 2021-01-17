<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Job;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    private $job_model;
    private $company_model;
    private $redirectTo;
    function __construct()
    {
        $this->job_model = new Job();
        $this->company_model = new Company();
        $this->redirectTo = url('admin/company');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companies = $this->company_model->paginate();
        $data = [
            'title' => "Company Data",
            'companies' => $companies,
            'pagination' => $companies->links()->elements[0],
            'number' => $companies->firstItem()
        ];
        return view('company.company_list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => "Company Form",
            'method' => "POST",
        ];
        return view('company.company_form', $data);
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
            'company_name' => ['required', 'filled', 'unique:companies,name'],
            'image' => ['required', 'filled', 'mimes:png,jpg,svg']
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        try {
            $user = Auth::user();
            // filepath
            $filepath = '/img/company/' . $request->company_name;
            $fileext = $request->file('image')->getClientOriginalExtension();
            $filename =  'companyImage.' . $fileext;
            $filepathdb = 'storage' . $filepath . '/' . $filename;
            // store to filepath
            $res = $request->file('image')->storeAs('public' . $filepath, $filename);
            $where = [
                'name' => $request->company_name
            ];
            $data = [
                'user_id' => $user->id,
                'image' => $filepathdb
            ];
            $company = $this->company_model->firstOrCreate($where, $data);
            // success
            $response = [
                'success' => 'Success Add Company'
            ];
            return redirect($this->redirectTo)->with($response);
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
        $company = $this->company_model->findOrFail($id);
        $data = [
            'title' => "Company Detail",
            'company' => $company
        ];
        return view('company.company_detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = $this->company_model->findOrFail($id);
        $data = [
            'title' => "Company Form",
            'company' => $company,
            'method' => "PUT",
        ];
        return view('company.company_form', $data);
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
        $company = $this->company_model->findOrFail($id);

        $rules = [
            'company_name' => ['required', 'filled', 'unique:companies,name,' . $id . ',id'],
            'image' => ['required', 'filled', 'mimes:png,jpg,svg']
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        try {
            $user = Auth::user();
            // filepath
            $filepath = '/img/company/' . $request->company_name;
            $fileext = $request->file('image')->getClientOriginalExtension();
            $filename =  'companyImage.' . $fileext;
            $filepathdb = 'storage' . $filepath . '/' . $filename;
            // store to filepath
            $res = $request->file('image')->storeAs('public' . $filepath, $filename);
            $data = [
                'name' => $request->company_name,
                'user_id' => $user->id,
                'image' => $filepathdb
            ];
            foreach ($data as $key => $value) {
                $company->$key = $value;
            }
            $company->save();
            // success
            $response = [
                'success' => 'Success update Company'
            ];
            return redirect($this->redirectTo)->with($response);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function multi_destroy(Request $request)
    {
        try {
            $this->company_model->whereIn('id', $request->ids)->delete();
            $response = [
                'ok' => true,
                'message' => 'Success Delete Jobs'
            ];
            return $response;
        } catch (Exception $e) {
            Log::error($e->getMessage());

            $response = [
                'ok' => false,
                'message' => 'Server Error'
            ];
            return $response;
        }
    }
}
