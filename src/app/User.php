<?php

namespace App;

use Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes;

    use Notifiable;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
    'name',
    'email',
    'password',
    'phone',
    'country_code',
    'api_token',
    'email_verified_at',
  ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
    'password', 'remember_token',
  ];

    /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
    protected $casts = [
    'email_verified_at' => 'datetime',
  ];

    /**
    * The collections that belong to the user.
    */
    public function collections()
    {
        return $this->belongsToMany('\App\Models\Collection')
    ->withPivot('role')
    ->withTimestamps();
    }

    public function getIsAuthAttribute()
    {
        if (Auth::user()->id == $this->id) {
            return true;
        } else {
            return false;
        }
    }

    public function getDatetimesAttribute()
    {
        return [
      'updated_at'       => (string)$this->updated_at,
      'updated_at_diff'  => (string)$this->updated_at->diffForHumans(['parts' => 2]),
      'created_at'       => (string)$this->created_at,
      'created_at_diff'  => (string)$this->created_at->diffForHumans([
        'parts' => 2,
      ]),
    ];
    }
}
