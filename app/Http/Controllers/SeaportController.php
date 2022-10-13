<?php

namespace App\Http\Controllers;

use App\Models\Seaport;
use Illuminate\Http\Request;

class SeaportController extends Controller
{
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
