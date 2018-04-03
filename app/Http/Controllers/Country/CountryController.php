<?php

namespace App\Http\Controllers\Country;

use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CountryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();

        return $this->showAll($countries);
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
        ];

        $this->validate($request, $reglas);  // validamos con las reglas. si no valida arrojamos excepcion

        $campos = $request->all(); // extraemos todos los valores del request
        
        $country = Country::create($campos);

        return $this->showOne($country, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = Country::findOrFail($id);
        return $this->showOne($country);
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
        $country = Country::findOrFail($id);

        if ($request->has('name')){
            $country->name = $request->name;
        }

        if (!$country->isDirty())  // Si el usuario no ha sido modificado en alguno de sus valores  // 422 Malformed Request
            return response()->json(['error'=>'Se debe especificar al menos un valor diferente para modificar ', 'code' => 422],422);  

        $country->save();

        return $this->showOne($country);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::findOrFail($id);

        $country->delete();

        return $this->showOne($country);
    }
}
