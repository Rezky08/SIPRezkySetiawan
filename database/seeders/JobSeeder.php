<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('username', 'admin')->first();
        $data = [
            'user_id' => $user->id
        ];
        Job::factory()->count(10)->make($data)->each(function ($job) use ($data) {
            $company = Company::factory()->create($data);

            $job->company_id = $company->id;
            $job->save();
        });
    }
}
