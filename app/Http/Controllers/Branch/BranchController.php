<?php

namespace App\Http\Controllers\Branch;

use App\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BranchController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::all();

        return $this->showAll($branches);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   $reglas = [
            'name' => 'required', // Requerido
            'rif' => 'required', // Requerido
            'address' => 'required', // Requerido
            'phone' => 'required', // Requerido
            'company_id' => 'required', // Requerido
        ];

        $this->validate($request, $reglas);  // validamos con las reglas. si no valida arrojamos excepcion

        $campos = $request->all(); // extraemos todos los valores del request
        
        $branch = Branch::create($campos);

        return $this->showOne($branch, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $branch = Branch::findOrFail($id);
        return $this->showOne($branch);
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
        $branch = Branch::findOrFail($id);
        if ($request->has('name')){
            $branch->name = $request->name;
        }
        if ($request->has('rif')){
            $branch->rif = $request->rif;
        }
        if ($request->has('address')){    
            $branch->address = $request->address;
        }
        if ($request->has('phone')){
            $branch->phone = $request->phone;
        }
        if ($request->has('company_id')){
            $branch->company_id = $request->company_id;
        }
        if ($request->has('status')){
            $branch->status;        
        }
        if (!$branch->isDirty())  // Si la sucursal no ha sido modificado en alguno de sus valores  // 422 Malformed Request
            return response()->json(['error'=>'Se debe especificar al menos un valor diferente para modificar ', 'code' => 422],422);  

        $branch->save();

        return $this->showOne($branch);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);

        $branch->delete();

        return $this->showOne($branch);
    }
}
