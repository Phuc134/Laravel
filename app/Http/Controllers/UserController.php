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
                    'errorCode' => 0,
                    'message' => '',
                    'datas' => $listUser->toArray()['data'],
                    'total' => $listUser->toArray()['total']
                ]
            );
        }
        catch (\Throwable $e){
            return response()->json(
                [
                    'errorCode'=> 1,
                    'message'=> $e->getMessage(),
                ]
            );
        }
    }

    public function getOneCustomer(Request $request){
        try {

            $user= User::find($request->route('id'));
            return response()->json(
                [
                    'errorCode'=>0,
                    'data' => $user,
                ]
            );
        }
        catch (\Throwable $e){
            return response()->json(
                [
                    'errorCode'=> 1,
                    'message'=> $e->getMessage(),
                ]
            );
        }


    }

    public function createCustomer(Request $request){
        try {
            $user = new User();
            $user->role = "customer";
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(
                [
                    'data' => $user,
                    'errorCode' => 0,
                    'message' => 'CREATE USER SUCCESS',
                ]
            );
        }
        catch (\Throwable $e){
            return response()->json(
                [
                    'errorCode'=> 1,
                    'message'=> $e->getMessage(),
                ]
            );
        }
    }

    public function updateCustomer(Request $request){
        try {
            $id = $request->route('id');
            $user= User::find($id);
            if ($request->has('name')) $user->name = $request->name;
            if ($request->has('email')) $user->email = $request->email;
            if ($request->has('phone')) $user->phone = $request->phone;
            if ($request->has('username')) $user->username = $request->username;
            $user->save();
            return response()->json(
                [
                    'data' => $user,
                    'errorCode'=> 0,
                    'message'=> 'UPDATE USER SUCCESS',
                ]
            );
        }
        catch (\Throwable $e){
            return response()->json(
                [
                    'errorCode'=> 1,
                    'message'=> $e->getMessage(),
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
                    'errorCode'=> 0,
                    'message'=> 'DELETE USER SUCCESS',
                ]
            );
        }
        catch (\Throwable $e){
            return response()->json(
                [
                    'errorCode'=> 1,
                    'message'=> $e->getMessage(),
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
                    'errorCode' => 0,
                    'message' => '',
                    'datas' => $listUser->toArray()['data'],
                    'total' => $listUser->toArray()['total']
                ]
            );
        }
        catch (\Throwable $e){
            return response()->json(
                [
                    'errorCode'=> 1,
                    'message'=> $e->getMessage(),
                ]
            );
        }
    }

    public function getOneStaff(Request $request){
        try {

            $user= User::find($request->route('id'));
            return response()->json(
                [
                    'errorCode'=>0,
                    'data' => $user,
                ]
            );
        }
        catch (\Throwable $e){
            return response()->json(
                [
                    'errorCode'=> 1,
                    'message'=> $e->getMessage(),
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
                    'data' => $user,
                    'errorCode' => 0,
                    'message' => 'CREATE USER SUCCESS',
                ]
            );
        }
        catch (\Throwable $e){
            return response()->json(
                [
                    'errorCode'=> 1,
                    'message'=> $e->getMessage(),
                ]
            );
        }
    }

    public function updateStaff(Request $request){
        try {
            $id = $request->route('id');
            $user= User::find($id);
            $id = $request->route('id');
            $user= User::find($id);
            if ($request->has('name')) $user->name = $request->name;
            if ($request->has('email')) $user->email = $request->email;
            if ($request->has('phone')) $user->phone = $request->phone;
            if ($request->has('username')) $user->username = $request->username;
            $user->save();
            return response()->json(
                [
                    'data' => $user,
                    'errorCode'=> 0,
                    'message'=> 'UPDATE USER SUCCESS',
                ]
            );
        }
        catch (\Throwable $e){
            return response()->json(
                [
                    'errorCode'=> 1,
                    'message'=> $e->getMessage(),
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
                    'errorCode'=> 0,
                    'message'=> 'DELETE USER SUCCESS',
                ]
            );
        }
        catch (\Throwable $e){
            return response()->json(
                [
                    'errorCode'=> 1,
                    'message'=> $e->getMessage(),
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
                    'data'=> $user,
                    'errorCode'=> 0,
                    'message'=> 'LOGIN SUCCESS',
                ]);

            }
            else{
                return response()->json([
                    'errorCode'=> 0,
                    'message'=> 'LOGIN FAIL',
                ]);
            }

        }
        catch (\Throwable $e){
            return response()->json(
                [
                    'errorCode'=> 1,
                    'message'=> 'USERNAME DOES NOT EXIST',
                ]
            );
        }
    }
}
