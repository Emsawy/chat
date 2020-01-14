<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Block;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function blockers()
    {
      return $this->belongsToMany(User::class, 'block', 'blocking_id', 'blocker_id');
    }

    public function blocking()
    {
      return $this->belongsToMany(User::class, 'block', 'blocker_id', 'blocking_id');
    }

    public function messages()
    {
      return $this->hasMany(Message::class);
    }

    public function scopeOrder($query)
    {
        return $query->orderBy('id','asc');
    }
}
