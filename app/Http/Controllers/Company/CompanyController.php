<?php

namespace App\Http\Controllers\Company;

use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CompanyController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();

        return $this->showAll($companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reglas = [
            'name' => 'required', // Requerido
            'rif' => 'required', // Requerido
            'address' => 'required', // Requerido
            'phone' => 'required', // Requerido
            'country_id' => 'required', // Requerido
        ];

        $this->validate($request, $reglas);  // validamos con las reglas. si no valida arrojamos excepcion

        $campos = $request->all(); // extraemos todos los valores del request
        
        $company = Company::create($campos);

        return $this->showOne($company, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::findOrFail($id);
        return $this->showOne($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        if ($request->has('name')){
            $company->name = $request->name;
        }
        if ($request->has('rif')){
            $company->rif = $request->rif;
        }
        if ($request->has('address')){
            $company->address = $request->address;
        }
        if ($request->has('phone')){
            $company->phone = $request->phone;
        }
        if ($request->has('country_id')){
            $company->country_id = $request->country_id;
        }
        if ($request->has('status')){
            $company->status = $request->status;
        }
        if (!$company->isDirty())  // Si la compania no ha sido modificado en alguno de sus valores  // 422 Malformed Request
            return response()->json(['error'=>'Se debe especificar al menos un valor diferente para modificar ', 'code' => 422],422);  

        $company->save();

        return $this->showOne($company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);

        $company->delete();

        return $this->showOne($company);
    }
}
