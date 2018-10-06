<?php

namespace App\Http\Controllers;

use App\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Notifications\MemberAddedToboard;
use App;
class AutocompleteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }

    public function fetch(Request $request){

            $query = $request->get('query');
            $mails=$request->get('members');
            $data = DB::table('users')
                ->where('email', 'LIKE', "%{$query}%")
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative;background-color:white;;max-height:200px;overflow-y: auto;overflow-x:hidden">';
            foreach($data as $row)
            {
                $output .= '<li class="item-mail"><a href="#">' . $row->email . '</a><input type="hidden" class="member-id" value='.$row->id.'></li>';

            }
            $output .= '</ul>';


        echo $output;
    }

    public function post(Request $request,Board $board){

        $mail=$request->get('user_mail');
        $user = App\User::where('email', $mail)->get()->first();
        $name=$user->name;

        $board->users()->attach($user->id,['role'=>'member']);

        //$when = now()->addSeconds(10);
        $user->notify(new MemberAddedToboard($request->user(),$board));

        return \Response::json($user);

    }
}
