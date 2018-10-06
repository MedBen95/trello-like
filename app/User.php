<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','telephone','adresse','apropos'
    ];
    protected $primaryKey = 'id';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function boards()
    {
        return $this->belongsToMany(\App\Board::class, 'board_user', 'user_id', 'board_id')->withPivot('role');
    }

    public function cards()
    {
        return $this->belongsToMany(\App\Board::class, 'card_user', 'user_id', 'card_id')->withPivot('date_limite');
    }



}
