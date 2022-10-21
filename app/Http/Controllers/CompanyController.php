<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * @OA\Get(
     *     path="/company",
     *     tags={"company"},
     *     description="Return a list company",
     *     operationId="getListCompany",
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
    /**
     * @OA\Post (
     *      path="/company",
     *      tags={"company"},
     *      description="Create a company",
     *      operationId="createCompany",
     *      @OA\Parameter (
     *          name="name",
     *          in="query",
     *          description="name of company",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *     @OA\Parameter (
     *          name="address",
     *          in="query",
     *          description="address of company",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *     @OA\Parameter (
     *          name="phone",
     *          in="query",
     *          description="phone of company",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *     @OA\Parameter (
     *          name="fax",
     *          in="query",
     *          description="fax of company",
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
    /**
     * @OA\Put(
     *      path="/company/{id}",
     *      tags={"company"},
     *      description="Update a company",
     *      operationId="updateCompany",
     *      @OA\Parameter (
     *          name="name",
     *          in="query",
     *          description="name need update",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *     @OA\Parameter (
     *          name="address",
     *          in="query",
     *          description="address need update",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *     @OA\Parameter (
     *          name="phone",
     *          in="query",
     *          description="phone need update",
     *          @OA\Schema (
     *              type="string",
     *          )
     *      ),
     *     @OA\Parameter (
     *          name="fax",
     *          in="query",
     *          description="fax need update",
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

    public function updateCompany(Request $request){
        try {
            $id = $request->route('id');
            $company= Company::find($id);
            if ($request->has('name')) $company->name = $request->name;
            if ($request->has('address')) $company->address = $request->address;
            if ($request->has('phone')) $company->phone = $request->phone;
            if ($request->has('fax')) $company->fax = $request->fax;
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
    /**
     * @OA\Delete (
     *      path="/company/{id}",
     *      tags={"company"},
     *      description="Delete a company",
     *      operationId="deleteCompany",
     *      @OA\Parameter (
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of company to delete",
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
