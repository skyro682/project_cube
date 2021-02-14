<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function profile(){

        $data['user'] = User::find(Auth::user()->id);

        return view('profile', $data);

    }

    public function editProfile(Request $request, $section){

        $user = User::find(Auth::user()->id);

        switch ($section) {
            case 'email':

                if ($request->email != $request->confEmail) {
                    $error = 'email does not match';
                    break;
                }

                $user->email = $request->email;
                $user->save();
                break;

            case 'address':

                $user->address = $request->address;
                $user->city = $request->city;
                $user->cp_code = $request->cpCode;
                $user->save();
                break;

            case 'password':
                
                if ($request->newPassword != $request->confPassword) {
                    $error = 'password does not match';
                    break;
                }

                if (!Hash::check($request->password, $user->password)) {
                    $error = 'Invalide password';
                    break;
                }

                $password = Hash::make($request->newPassword);
                $user->password = $password;
                $user->save();
                break;
            
            default:

                return redirect(Route('profile'));
                break;
        }

        if(isset($error)){
            return redirect(Route('profile'))->with('error', $error);
        }
        else{
            return redirect(Route('profile'))->with('success', 'Modification Effectuer');
        }

        return redirect(Route('profile'));

    }

    public function deleteProfile(){

        $user = User::find(Auth::user()->id);
        $user->delete();

        return redirect(Route('home'));

    }

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

    public function messagerie()
    {
        return view('messagerie');
    }

}
