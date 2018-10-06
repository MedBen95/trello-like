<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{

    protected $fillable = ['name','color','board_id'];
    protected $primaryKey ='id_label';

    public function cards()
    {
        return $this->belongsToMany(\App\Card::class, 'card_label', 'label_id', 'card_id');
    }

}
