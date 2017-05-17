<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Sentinel;
use Validator;
use Illuminate\Http\Request;
use Session;
use Reminder;
use Mail;

use App\Models\User;

class UserController extends Controller {
	public function getIndex(){
		$users = User::get();

		return view('user.index', [
			'users' => $users
		]);
	}

	public function postEdit(Request $request, $id = 0){
		$rules = [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email',
            'password'   => 'required'
        ];
        $v = Validator::make($request->all(), $rules);

        if( $v->fails() ){
            return redirect('user'. ( $id ? "/edit/$id" : 'create' ))->withErrors($v)->withInput();
        }

        if( $id ){
            $user = User::find($id);
            if( !$user ) return redirect('user')->withMessage('Could not find user with the provided id');
        }else{
	       $credentials = [
		        'email'    => $request->input('email'),
			    'password' => $request->input('password')
			];

			$user = Sentinel::registerAndActivate($credentials);
        }

		$user->first_name = $request->input('first_name');
		$user->last_name  = $request->input('last_name');
        $user->save();

        $message = $id ? 'User has been updated' : 'User has been created';
        return redirect('user')->withMessage($message);
	}

	public function getEdit(Request $request, $id = 0){

	}

	public function postCreate(Request $request){
		return $this->postEdit($request, 0);
	}

	public function getCreate(Request $request){
		return $this->getEdit($request, 0);
	}
}