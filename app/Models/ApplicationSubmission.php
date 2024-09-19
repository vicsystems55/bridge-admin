<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationSubmission extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function job_seeker(){
      return $this->belongsTo(User::class, 'job_seeker_id', 'id');
    }

    public function job_postings(){
      return $this->belongsTo(JobPosting::class, 'job_posting_id', 'id');
    }
}
