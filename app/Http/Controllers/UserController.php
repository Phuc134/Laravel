<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/user/customer",
     *     tags={"customer"},
     *     description="Return a list customer",
     *     operationId="getListCustomer",
     *     @OA\Parameter(
     *          name="page",
     *          in="query",
     *          description="page number",
     *     ),
     *     @OA\Parameter(
     *          name="pagesize",
     *          in="query",
     *          description="number of records in page",
     *     ),
     *      @OA\Response(
     *          response="201",
     *          description="successful operation",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="not found"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *
     *
     * )
     */

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
    /**
     * @OA\Get(
     *     path="/user/customer/{id}",
     *     tags={"customer"},
     *     description="Return one customer",
     *     operationId="getOneCustomer",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of customer need get",
     *     ),
     *      @OA\Response(
     *          response="201",
     *          description="successful operation",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="not found"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *
     *
     * )
     */

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
    /**
     * @OA\Post (
     *      path="/user/customer",
     *      tags={"customer"},
     *      description="Create a customer",
     *      operationId="createCustomer",
     *      @OA\Parameter (
     *          name="name",
     *          in="query",
     *          description="name of customer",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *     @OA\Parameter (
     *          name="email",
     *          in="query",
     *          description="email of customer",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *     @OA\Parameter (
     *          name="phone",
     *          in="query",
     *          description="phone of customer",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *      @OA\Parameter (
     *          name="username",
     *          in="query",
     *          description="username of customer",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *      @OA\Parameter (
     *          name="password",
     *          in="query",
     *          description="password of customer",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *      @OA\Response(
     *          response="201",
     *          description="successful operation",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="not found"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *
     *
     * )
     */

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
    /**
     * @OA\Put (
     *      path="/user/customer/{id}",
     *      tags={"customer"},
     *      description="Update a customer",
     *      operationId="updateCustomer",
     *      @OA\Parameter (
     *          name="id",
     *          in="path",
     *          description="id of customer",
     *          required=true,
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *      @OA\Parameter (
     *          name="name",
     *          in="query",
     *          description="name of customer",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *     @OA\Parameter (
     *          name="email",
     *          in="query",
     *          description="email of customer",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *     @OA\Parameter (
     *          name="phone",
     *          in="query",
     *          description="phone of customer",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *      @OA\Parameter (
     *          name="username",
     *          in="query",
     *          description="username of customer",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *      @OA\Response(
     *          response="201",
     *          description="successful operation",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="not found"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *
     *
     * )
     */

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
    /**
     * @OA\Delete  (
     *      path="/user/customer/{id}",
     *      tags={"customer"},
     *      description="Delete a customer",
     *      operationId="DeleteCustomer",
     *      @OA\Parameter (
     *          name="id",
     *          in="path",
     *          description="id of customer",
     *          required=true,
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *      @OA\Response(
     *          response="201",
     *          description="successful operation",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="not found"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *
     *
     * )
     */

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
    /**
     * @OA\Get(
     *     path="/user/staff",
     *     tags={"staff"},
     *     description="Return a list staff",
     *     operationId="getListStaff",
     *     @OA\Parameter(
     *          name="page",
     *          in="query",
     *          description="page number",
     *     ),
     *     @OA\Parameter(
     *          name="pagesize",
     *          in="query",
     *          description="number of records in page",
     *     ),
     *      @OA\Response(
     *          response="201",
     *          description="successful operation",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="not found"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *
     *
     * )
     */

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
    /**
     * @OA\Get(
     *     path="/user/staff/{id}",
     *     tags={"staff"},
     *     description="Return one staff",
     *     operationId="getOneStaff",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of staff need get",
     *     ),
     *      @OA\Response(
     *          response="201",
     *          description="successful operation",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="not found"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *
     *
     * )
     */

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
    /**
     * @OA\Post (
     *      path="/user/staff",
     *      tags={"staff"},
     *      description="Create a staff",
     *      operationId="createStaff",
     *      @OA\Parameter (
     *          name="name",
     *          in="query",
     *          description="name of staff",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *     @OA\Parameter (
     *          name="email",
     *          in="query",
     *          description="email of staff",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *     @OA\Parameter (
     *          name="phone",
     *          in="query",
     *          description="phone of staff",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *      @OA\Parameter (
     *          name="username",
     *          in="query",
     *          description="username of staff",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *      @OA\Parameter (
     *          name="password",
     *          in="query",
     *          description="password of staff",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *      @OA\Response(
     *          response="201",
     *          description="successful operation",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="not found"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *
     *
     * )
     */

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
    /**
     * @OA\Put (
     *      path="/user/staff/{id}",
     *      tags={"staff"},
     *      description="Update a staff",
     *      operationId="updateStaff",
     *      @OA\Parameter (
     *          name="id",
     *          in="path",
     *          description="id of staff",
     *          required=true,
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *      @OA\Parameter (
     *          name="name",
     *          in="query",
     *          description="name of staff",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *     @OA\Parameter (
     *          name="email",
     *          in="query",
     *          description="email of staff",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *     @OA\Parameter (
     *          name="phone",
     *          in="query",
     *          description="phone of staff",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *      @OA\Parameter (
     *          name="username",
     *          in="query",
     *          description="username of staff",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *      @OA\Response(
     *          response="201",
     *          description="successful operation",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="not found"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *
     *
     * )
     */

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
    /**
     * @OA\Delete  (
     *      path="/user/staff/{id}",
     *      tags={"staff"},
     *      description="Delete a staff",
     *      operationId="DeleteStaff",
     *      @OA\Parameter (
     *          name="id",
     *          in="path",
     *          description="id of staff",
     *          required=true,
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *      @OA\Response(
     *          response="201",
     *          description="successful operation",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="not found"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *
     *
     * )
     */

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
