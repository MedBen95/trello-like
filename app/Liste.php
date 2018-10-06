<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liste extends Model
{
    protected $fillable = ['titre','board_id','list_position'];
    protected $primaryKey ='id_liste';

    public function board()
    {
        return $this->belongsTo(\App\Board::class);
    }

    public function cards()
    {
        return $this->hasMany(\App\Card::class, 'liste_id');

    }
}
