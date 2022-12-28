<?php

namespace App\Http\Controllers;

use App\Models\Vessel;
use Illuminate\Http\Request;

class VesselController extends Controller
{
    public  function getListVessel(Request $request){
        try {
            $listVessel = Vessel::with('company')->get();
            return response()->json([
                'data' => $listVessel
            ]);
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
    public function createVessel(Request $request){
        try {

            $vessel = new Vessel();
        $vessel->name = $request->name;
        $vessel->callSign = $request->callSign;
        $vessel->IMO = $request->IMO;
        $vessel->company_id = $request->company_id;
        $vessel->speed = $request->speed;
        $vessel->lengthOverall = $request->lengthOverall;
        $vessel->breadthModuled = $request->breadthModuled;
        $vessel->depthModuled = $request->depthModuled;
        $vessel->airDraft = $request->airDraft;
        $vessel->portOfRegister = $request->portOfRegister;
        $vessel->nationality = $request->nationality;
        $vessel->buildIn = $request->buildIn;
        $vessel->deadWeight = $request->deadWeight;
        $vessel->grossTonnage = $request->grossTonnage;
        $vessel->netTonnage = $request->netTonnage;
        $vessel->lightShip = $request->lightShip;
        $vessel->save();
        return response()->json(
            [
                'data' => $vessel,
                'errorCode' => 0,
                'message' => 'CREATE VESSEL SUCCESS',
            ]);
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
    public function updateVessel(Request $request){
        try{
            $id = $request->route('id');
            $vessel = Vessel::find($id);
            if ($request->has('name'))  $vessel->name = $request->name;
            if ($request->has('callSign')) $vessel->callSign = $request->callSign;
            if ($request->has('IMO'))$vessel->IMO = $request->IMO;
            if ($request->has('company_id'))$vessel->company_id = $request->company_id;
            if ($request->has('speed'))$vessel->speed = $request->speed;
            if ($request->has('lengthOverall'))$vessel->lengthOverall = $request->lengthOverall;
            if ($request->has('breadthModuled'))$vessel->breadthModuled = $request->breadthModuled;
            if ($request->has('depthModuled'))$vessel->depthModuled = $request->depthModuled;
            if ($request->has('airDraft'))$vessel->airDraft = $request->airDraft;
            if ($request->has('portOfRegister'))$vessel->portOfRegister = $request->portOfRegister;
            if ($request->has('nationality'))$vessel->nationality = $request->nationality;
            if ($request->has('buildIn'))$vessel->buildIn = $request->buildIn;
            if ($request->has('deadWeight'))$vessel->deadWeight = $request->deadWeight;
            if ($request->has('grossTonnage'))$vessel->grossTonnage = $request->grossTonnage;
            if ($request->has('netTonnage'))$vessel->netTonnage = $request->netTonnage;
            if ($request->has('lightShip'))$vessel->lightShip = $request->lightShip;
            $vessel->save();
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
    public function deleteVessel(Request $request){
        try {
            $id = $request->route('id');
            $vessel = Vessel::find($id);
            if ($vessel !=null) $vessel->delete();
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
}
