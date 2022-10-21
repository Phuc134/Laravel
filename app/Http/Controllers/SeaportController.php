<?php

namespace App\Http\Controllers;

use App\Models\Seaport;
use Illuminate\Http\Request;

class SeaportController extends Controller
{
    /**
     * @OA\Get(
     *     path="/seaport",
     *     tags={"seaport"},
     *     description="Return a list seaport",
     *     operationId="getListSeaport",
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

    public function getListSeaport(Request $request){
        try {
            $pageNumber= (int)$request->pagesize;
            $listSeaport = Seaport::paginate($pageNumber);
            return response()->json(
                [
                    'errorCode' => 0,
                    'message' => '',
                    'datas' => $listSeaport->toArray()['data'],
                    'total' => $listSeaport->toArray()['total']
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
     *      path="/seaport",
     *      tags={"seaport"},
     *      description="Create a seaport",
     *      operationId="createSeaport",
     *      @OA\Parameter (
     *          name="name",
     *          in="query",
     *          description="name of seaport",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *     @OA\Parameter (
     *          name="code",
     *          in="query",
     *          description="code of seaport",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *     @OA\Parameter (
     *          name="max_draft",
     *          in="query",
     *          description="max_draft of seaport",
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

    public function createSeaport(Request $request){
        try {
            $Seaport = new Seaport();
            $Seaport->name = $request->name;
            $Seaport->code = $request->code;
            $Seaport->max_draft = $request->max_draft;
            $Seaport->save();
            return response()->json(
                [
                    'data' => $Seaport,
                    'errorCode' => 0,
                    'message' => 'CREATE SEAPORT SUCCESS',
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
     *      path="/seaport/{id}",
     *      tags={"seaport"},
     *      description="Update a seaport",
     *      operationId="updateSeaport",
     *      @OA\Parameter (
     *          name="name",
     *          in="query",
     *          description="name need update",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *     @OA\Parameter (
     *          name="code",
     *          in="query",
     *          description="code need update",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *     @OA\Parameter (
     *          name="max_draft",
     *          in="query",
     *          description="max_draft need update",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *      @OA\Parameter (
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of seaport to update",
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

    public function updateSeaport(Request $request){
        try {
            $id = $request->route('id');
            $Seaport= Seaport::find($id);
            if ($request->has('name')) $Seaport->name = $request->name;
            if ($request->has('code')) $Seaport->code = $request->code;
            if ($request->has('max_draft')) $Seaport->max_draft = (int)$request->max_draft;
            $Seaport->save();
            return response()->json(
                [
                    'data' => $Seaport,
                    'errorCode'=> 0,
                    'message'=> 'UPDATE SEAPORT SUCCESS',
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
     * @OA\Delete (
     *      path="/seaport/{id}",
     *      tags={"seaport"},
     *      description="Delete a seaport",
     *      operationId="deleteSeaport",
     *      @OA\Parameter (
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of seaport to delete",
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

    public function deleteSeaport(Request $request){
        try {
            $id = $request->route('id');
            $Seaport = Seaport::find($id);
            if ($Seaport !=null)$Seaport->delete();
            return response()->json(
                [
                    'errorCode'=> 0,
                    'message'=> 'DELETE SEAPORT SUCCESS',
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
