<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 18/07/2018
 * Time: 09:37
 */

namespace App\Http\Repositories;


use App\User;
use App;

class UserRepository
{
    protected $user;

    /**
     * BoardRepository constructor.
     * @param $board
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function updateProfile($inputs,$user)
    {
       $this->user=$user;
       $this->user->name=$inputs['name'];
       $this->user->email=$inputs['email'];

       $this->user->telephone=$inputs['telephone'];
       $this->user->adresse=$inputs['adresse'];
       $this->user->apropos=$inputs['apropos'];

       $this->user->save();


    }





}
