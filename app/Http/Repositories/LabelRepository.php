<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 02/09/2018
 * Time: 22:46
 */

namespace App\Http\Repositories;


use App\Label;

class LabelRepository
{

    protected $label;

    /**
     * LabelRepository constructor.
     * @param $label
     */
    public function __construct(Label $label)
    {
        $this->label = $label;
    }

    public function addLabel($inputs)
    {
        $label=$this->label->create($inputs);
        return $label;
    }



}