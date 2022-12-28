<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
class CategoryController extends Controller
{
    /**
     * @OA\Get(
     *     path="/category",
     *     tags={"category"},
     *     description="Return a list category",
     *     operationId="getListCategory",
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
    public function getListCategory(Request $request){
        try {
            $pageNumber= (int)$request->pagesize;
            $listCategory = Category::paginate($pageNumber);
            dd($listCategory);
            return response()->json(
                [
                    'errorCode' => 0,
                    'message' => '',
                    'datas' => $listCategory->toArray()['data'],
                    'total' => $listCategory->toArray()['total']
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
     * @OA\Post(
     *      path="/category",
     *      tags={"category"},
     *      description="Create a category",
     *      operationId="createCategory",
     *      @OA\Parameter (
     *          name="name",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
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
    public function createCategory(Request $request){
        try {
            $category = new Category();
            $category->name = $request->name;
            $category->save();
            return response()->json(
                [
                    'data' => $category,
                    'errorCode' => 0,
                    'message' => 'CREATE CATEGORY SUCCESS',
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
     * @OA\Put(
     *      path="/category/{id}",
     *      tags={"category"},
     *      description="Update a category",
     *      operationId="updateCategory",
     *      @OA\Parameter (
     *          name="name",
     *          in="query",
     *          description="name need update",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *      @OA\Parameter (
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of category to update",
     *          @OA\Schema(
     *              type="string"
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
    public function updateCategory(Request $request){
        try {
            $id = $request->route('id');
            $category= Category::find($id);
            if ($request->has('name')) $category->name = $request->name;
            $category->save();
            return response()->json(
                [
                    'data' => $category,
                    'errorCode'=> 0,
                    'message'=> 'UPDATE CATEGORY SUCCESS',
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
     * @OA\Delete(
     *      path="/category/{id}",
     *      tags={"category"},
     *      description="Delete a category",
     *      operationId="deleteCategory",
     *      @OA\Parameter (
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of category to delete",
     *          @OA\Schema(
     *              type="string"
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
    public function deleteCategory(Request $request){
        try {
            $id = $request->route('id');
            $category = Category::find($id);
            if ($category !=null)$category->delete();
            return response()->json(
                [
                    'errorCode'=> 0,
                    'message'=> 'DELETE CATEGORY SUCCESS',
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
}
