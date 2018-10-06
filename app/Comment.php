<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['commentaire','card_id','user_id'];
    protected $primaryKey ='id_comment';

    public function card()
    {
        return $this->belongsTo(\App\Card::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }


}
