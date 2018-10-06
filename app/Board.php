<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{

    protected $fillable = ['titre', 'description'];
    protected $primaryKey = 'id_board';

    public function users()
    {
        return $this->belongsToMany(\App\User::class, 'board_user', 'board_id', 'user_id')->withPivot('role');
    }

    public function listes()
    {
        return $this->hasMany(\App\Liste::class,'board_id');
    }

    public function labels()
    {
        return $this->hasMany(\App\Label::class,'board_id');
    }
}
