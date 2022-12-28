<?php

namespace App\Http\Controllers;

use App\Models\cargoType;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    //
    public function createSchedule(Request $request){
        try{
            $schedule = new Schedule();
            $schedule->idVessel = $request->idVessel;
            $schedule->ETA = $request->ETA;
            $schedule->ETD = $request->ETD;
            $schedule->PortOfLoading = $schedule->PortOfLoading;
            $schedule->PortOfDischarge = $schedule->PortOfDischarge;
            $schedule->save();
            return response()->json(
                [
                    'data' => $schedule,
                    'errorCode' => 0,
                    'message' => 'CREATE SCHEDULE SUCCESS',
                ]);

        }

        catch(\Throwable $e){
            return response()->json(
                [
                    'errorCode'=> 1,
                    'message'=> $e->getMessage(),
                ]
            );
        }
    }

    public function updateSchedule(Request $request){
        try {
            $id = $request->route('id');
            $schedule= Schedule::find($id);
            if ($request->has('idVessel')) $schedule->idVessel = $request->idVessel;
            if ($request->has('ETA')) $schedule->ETA = $request->ETA;
            if ($request->has('ETD')) $schedule->ETD = $request->ETD;
            if ($request->has('PortOfLoading')) $schedule->PortOfLoading = $request->PortOfLoading;
            if ($request->has('PortOfDischarge')) $schedule->PortOfDischarge = $request->PortOfDischarge;
            $schedule->save();
            return response()->json(
                [
                    'data' => $schedule,
                    'errorCode'=> 0,
                    'message'=> 'UPDATE SCHEDULE SUCCESS',
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

    public function getScheduleByVessel(Request $request){
        try{
            $idVessel = $request->route('idVessel');
            $listSchedule = Schedule::where('idVessel', $idVessel)
                            ->get();
            return response()->json(
                [
                    'data' => $listSchedule,
                    'errorCode'=> 0,
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

    public function deleteSchedule(Request $request){
        try {
            $id = $request->route('id');
            $Schedule = Schedule::find($id);
            if ($Schedule != null) $Schedule->delete();
            return response()->json(
                [
                    'errorCode' => 0,
                    'message' => 'DELETE SCHEDULE SUCCESS',
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
