<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model

{
    protected $fillable = ['titre','liste_id','card_position'];
    protected $primaryKey ='id_carte';


    public function liste()
    {
        return $this->belongsTo(\App\Liste::class,'liste_id');
    }

    public function comments()
    {
        return $this->hasMany(\App\Comment::class, 'card_id');

    }

    public function users()
    {
        return $this->belongsToMany(\App\User::class, 'card_user', 'card_id', 'user_id')->withPivot('date_limite');
    }

    public function labels()
    {
        return $this->belongsToMany(\App\Label::class, 'card_label', 'card_id', 'label_id');
    }




}
