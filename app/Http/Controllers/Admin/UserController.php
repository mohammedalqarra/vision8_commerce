<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
        public function index()
        {
          //  $users = User::where('type' , 'user')->orderBy('id' , 'desc')->paginate(5);

            if(request()->has('user')){

                $users = User::where('name', 'like', '%' . request()->user . '%')->orderBy('id' , 'desc')->paginate(5);

            }else{
                $users = User::where('name', 'like', '%' . request()->user . '%')->where('type' , 'user')->orderBy('id' , 'desc')->paginate(5);

            }

            return view('admin.users.index' , compact('users'));
        }


        public function destroy($id)
        {
            User::destroy($id);

            return redirect()->route('admin.users.index')->with('msg', 'User deleted successfully')->with('type', 'danger');
        }


}
