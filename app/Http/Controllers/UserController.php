<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Requests\ProfileRequest;
use App\Http\Repositories\UserRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{

  protected $userRepository;


  public function __construct(UserRepository $userRepository)
  {
      $this->middleware('auth');
      $this->userRepository=$userRepository;
  }

   public function getNotifications(Request $request){

       return $request->user()->unreadNotifications()->limit(5)->get()->toArray();

   }

   public function authEndpoint(Request $request){

       if (Auth::check()) {

          $options = array('cluster' => 'ap1','useTLS' => true);
          $pusher = new Pusher('0ae9aa0311b9c4a9c3df','e3ee9e6d93fb2595135a','592401',$options);

          echo $pusher->socket_auth($request['channel_name'], $request['socket_id']);
      }
      else {
        header('', true, 403);
        echo "Forbidden";
      }

   }

   public function showProfile(Request $request,User $user)
   {
      return view('profile',["user"=>$user]);
   }

   public function editProfile(ProfileRequest $request,User $user)
   {
     $inputs = array_merge($request->all());
     $userupdate=$this->userRepository->updateProfile($inputs,$user);

     return redirect()->route('profil.show',['user'=>$user->id]);

   }

   public function uploadImage(Request $request,User $user)
   {
     $validator = Validator::make($request->all(),['file' => 'image'],['file.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)']);

     if ($validator->fails())
     {

       $errors=$validator->errors();
       return \Response::json($errors);

     }

     else {

       $path = Storage::putFile('avatars', $request->file('file'));
       return $path;

     }


   }


}
