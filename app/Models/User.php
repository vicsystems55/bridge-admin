<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'otp',
        'role',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function profile(){

      return $this->hasOne(ProfileUpdate::class, 'user_id', 'id');

  }

    public function work_experiences(){
      return $this->hasMany(WorkExperience::class, 'user_id', 'id');
    }

    public function education(){
      return $this->hasMany(Education::class, 'user_id', 'id');
    }

    public function latest_education(){
      return $this->hasOne(Education::class, 'user_id', 'id')->latest();
    }

    public function skills(){
      return $this->hasMany(Skill::class, 'user_id', 'id');
    }

    public function resume(){
      return $this->hasOne(Resume::class, 'user_id', 'id');
    }

    public function languages(){
      return $this->hasMany(LanguageSpoken::class, 'user_id', 'id');
    }


}
