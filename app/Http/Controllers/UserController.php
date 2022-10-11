<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class UserController extends Controller
{
    public function getListCustomer(Request $request){
        try {
            $pageNumber= (int)$request->pagesize;
            $listUser = User::where('role', '=','customer')->paginate($pageNumber);
            return response()->json(
                [
                    'EC' => 0,
                    'MESSAGE' => '',
                    'DATA' => $listUser->toArray()['data'],
                    'LAST PAGE' => $listUser->toArray()['last_page'],
                ]
            );
        }
        catch (Exception $e){
            return response()->json(
                [
                    'EC'=> 1,
                    'MESSAGE'=> $e,
                ]
            );
        }
    }

    public function getOneCustomer(Request $request){
        try {

            $user= User::find($request->route('id'));
            return response()->json(
                [
                    'EC'=>0,
                    'DATA' => $user,
                ]
            );
        }
        catch (Exception $e){
            return response()->json(
                [
                    'EC'=> 1,
                    'MESSAGE'=> $e,
                ]
            );
        }


    }

    public function createCustomer(Request $request){
        try {
            $user = new User();
            $request->validate([
                'email' => 'email:rfc,dns'
            ]);
            $user->role = "customer";
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(
                [
                    'EC' => 0,
                    'MESSAGE' => 'CREATE USER SUCCESS',
                ]
            );
        }
        catch (Exception $e){
            return response()->json(
                [
                    'EC'=> 1,
                    'MESSAGE'=> $e,
                ]
            );
        }
    }

    public function updateCustomer(Request $request){
        try {
            $id = $request->route('id');
            $user= User::find($id);
            $user->update($request->all());

            return response()->json(
                [
                    'EC'=> 0,
                    'MESSAGE'=> 'UPDATE USER SUCCESS',
                ]
            );
        }
        catch (Exception $e){
            return response()->json(
                [
                    'EC'=> 1,
                    'MESSAGE'=> $e,
                ]
            );
        }

    }

    public function deleteCustomer(Request $request){
        try {
            $id = $request->route('id');
            $user = User::find($id);
            if ($user !=null)$user->delete();
            return response()->json(
                [
                    'EC'=> 0,
                    'MESSAGE'=> 'DELETE USER SUCCESS',
                ]
            );
        }
        catch (Exception $e){
            return response()->json(
                [
                    'EC'=> 1,
                    'MESSAGE'=> $e,
                ]
            );
        }

    }

    public function getListStaff(Request $request){
        try {
            $pageNumber= (int)$request->pagesize;
            $listUser = User::where('role', '=','staff')->paginate($pageNumber);
            return response()->json(
                [
                    'EC' => 0,
                    'MESSAGE' => '',
                    'DATA' => $listUser->toArray()['data'],
                    'LAST PAGE' => $listUser->toArray()['last_page'],
                ]
            );
        }
        catch (Exception $e){
            return response()->json(
                [
                    'EC'=> 1,
                    'MESSAGE'=> $e,
                ]
            );
        }
    }

    public function getOneStaff(Request $request){
        try {

            $user= User::find($request->route('id'));
            return response()->json(
                [
                    'EC'=>0,
                    'DATA' => $user,
                ]
            );
        }
        catch (Exception $e){
            return response()->json(
                [
                    'EC'=> 1,
                    'MESSAGE'=> $e,
                ]
            );
        }


    }

    public function createStaff(Request $request){
        try {
            $user = new User();
            $user->role = "staff";
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(
                [
                    'EC' => 0,
                    'MESSAGE' => 'CREATE USER SUCCESS',
                ]
            );
        }
        catch (Exception $e){
            return response()->json(
                [
                    'EC'=> 1,
                    'MESSAGE'=> $e,
                ]
            );
        }
    }

    public function updateStaff(Request $request){
        try {
            $id = $request->route('id');
            $user= User::find($id);
            $user->update($request->all());

            return response()->json(
                [
                    'EC'=> 0,
                    'MESSAGE'=> 'UPDATE USER SUCCESS',
                ]
            );
        }
        catch (Exception $e){
            return response()->json(
                [
                    'EC'=> 1,
                    'MESSAGE'=> $e,
                ]
            );
        }

    }

    public function deleteStaff(Request $request){
        try {
            $id = $request->route('id');
            $user = User::find($id);
            if ($user !=null)$user->delete();
            return response()->json(
                [
                    'EC'=> 0,
                    'MESSAGE'=> 'DELETE USER SUCCESS',
                ]
            );
        }
        catch (Exception $e){
            return response()->json(
                [
                    'EC'=> 1,
                    'MESSAGE'=> $e,
                ]
            );
        }

    }

    public function login(Request $request){
        try{
            $username = $request->username;
            $user = User::where('username', $username)->get();
            $password = $user[0]->password;
            if (Hash::check($request->password, $password)){
                return response()->json([
                    'EC'=> 0,
                    'MESSAGE'=> 'LOGIN SUCCESS',
                ]);

            }
            else{
                return response()->json([
                    'EC'=> 0,
                    'MESSAGE'=> 'LOGIN FAIL',
                ]);
            }

        }
        catch (Exception $e){
            return response()->json(
                [
                    'EC'=> 1,
                    'MESSAGE'=> $e,
                ]
            );
        }
    }
}
