<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Job;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    private $job_model;
    private $company_model;
    private $redirectTo;
    function __construct()
    {
        $this->job_model = new Job();
        $this->company_model = new Company();
        $this->redirectTo = url('admin/job');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = $this->job_model->paginate();
        $data = [
            'title' => "Job Data",
            'jobs' => $jobs,
            'pagination' => $jobs->links()->elements[0],
            'number' => $jobs->firstItem()
        ];
        return view('job.job_list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = $this->company_model->all();
        $data = [
            'title' => "Job Form",
            'companies' => $companies,
            'method' => "POST",
        ];
        return view('job.job_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $rules = [
            'job_name' => ['required', 'filled'],
            'job_salary' => ['required', 'filled', 'numeric'],
            'company_id' => ['required', 'filled', 'exists:companies,id'],
            'job_location' => ['required', 'filled'],
            'job_description' => ['required']
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        try {
            $data = [
                'user_id' => $user->id,
                'name' => $request->job_name,
                'salary' => $request->salary,
                'company_id' => $request->company_id,
                'location' => $request->job_location,
                'description' => $request->job_description
            ];
            $job = new Job($data);
            $job->save();


            // success
            $response = [
                'success' => 'Success add job'
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
        $job = $this->job_model->findOrFail($id);
        $data = [
            'title' => "Job Detail",
            'job' => $job
        ];
        return view('job.job_detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = $this->job_model->findOrFail($id);
        $companies = $this->company_model->all();
        $data = [
            'title' => "Job Form",
            'job' => $job,
            'companies' => $companies,
            'method' => "PUT",
        ];
        return view('job.job_form', $data);
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
        $job = $this->job_model->findOrFail($id);
        $rules = [
            'job_name' => ['required', 'filled'],
            'job_salary' => ['required', 'filled', 'numeric'],
            'company_id' => ['required', 'filled', 'exists:companies,id'],
            'job_location' => ['required', 'filled'],
            'job_description' => ['required']
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        try {
            $data = [
                'name' => $request->job_name,
                'salary' => $request->job_salary,
                'company_id' => $request->company_id,
                'location' => $request->job_location,
                'description' => $request->job_description
            ];

            foreach ($data as $key => $value) {
                $job->$key = $value;
            }
            $job->save();


            // success
            $response = [
                'success' => 'Success update job'
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
            $this->job_model->whereIn('id', $request->ids)->delete();
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
