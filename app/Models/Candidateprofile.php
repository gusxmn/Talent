<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateProfile extends Model
{
    protected $fillable = [
        'user_id','gender','birth_date','city','province','address','about_me',
        'expected_salary_min','expected_salary_max','job_preferences',
        'work_type_preference','job_level','cv_file','portfolio_url',
        'linkedin_url','github_url','website_url'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}