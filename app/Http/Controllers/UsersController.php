<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function list(){

        $data['users'] = User::with('grade')->get();
        $data['grades'] = Grade::all();
        return view('admin.userslist', $data);

    }

    public function editGrade(Request $request){

        $user = User::find($request->userId);
        $user->grade_id = $request->userGrade;
        $user->save();

        return redirect(Route('users.home'));

    }

    public function deleteUser($id){

        $user = User::find($id);
        $user->delete();

        return redirect(Route('users.home'));

    }
}
