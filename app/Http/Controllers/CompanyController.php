<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function getListCompany(Request $request){
        try {
            $pageNumber= (int)$request->pagesize;
            $listCompany = Company::paginate($pageNumber);
            return response()->json(
                [
                    'errorCode' => 0,
                    'message' => '',
                    'datas' => $listCompany->toArray()['data'],
                    'total' => $listCompany->toArray()['total']
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
    public function createCompany(Request $request){
        try {
            $listCompany = new Company();
            $listCompany->name = $request->name;
            $listCompany->address = $request->address;
            $listCompany->phone = $request->phone;
            $listCompany->fax = $request->fax;
            $listCompany->save();
            return response()->json(
                [
                    'data' => $listCompany,
                    'errorCode' => 0,
                    'message' => 'CREATE COMPANY SUCCESS',
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
    public function updateCompany(Request $request){
        try {
            $id = $request->route('id');
            $company= Company::find($id);
            if ($request->has('name')) $company->name = $request->name;
            if ($request->has('address')) $company->name = $request->address;
            if ($request->has('phone')) $company->name = $request->phone;
            if ($request->has('fax')) $company->name = $request->fax;
            $company->save();
            return response()->json(
                [
                    'data' => $company,
                    'errorCode'=> 0,
                    'message'=> 'UPDATE COMPANY SUCCESS',
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
    public function deleteCompany(Request $request){
        try {
            $id = $request->route('id');
            $company = Company::find($id);
            if ($company !=null)$company->delete();
            return response()->json(
                [
                    'errorCode'=> 0,
                    'message'=> 'DELETE COMPANY SUCCESS',
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
