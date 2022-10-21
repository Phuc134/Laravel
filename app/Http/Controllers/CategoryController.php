<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
class CategoryController extends Controller
{
    /**
     * @OA\Get(
     *     path="/projects",
     *     @OA\Response(response="200", description="Display a listing of projects.")
     * )
     */
    public function getListCategory(Request $request){

        try {
            $pageNumber= (int)$request->pagesize;
            $listCategory = Category::paginate($pageNumber);
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
