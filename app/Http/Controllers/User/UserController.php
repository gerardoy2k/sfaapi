<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class UserController extends ApiController
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();

        return $this->showAll($usuarios);
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
            'password' => 'required|min:6|confirmed', // Requerido, minimo 6 caract., confirmado con password_confirmation
            'email' => 'required|email|unique:users' ,   // Requerido, formato email, unico en la tabla users
        ];

        $this->validate($request, $reglas);  // validamos con las reglas. si no valida arrojamos excepcion

        $campos = $request->all(); // extraemos todos los valores del request
        $campos['admin'] = User::USER_NOT_ADMIN;
        $campos['verified'] = User::USER_NOT_VERIFIED;
        $campos['password'] = bcrypt($request->password);
        $campos['verification_token'] = User::generarVerificationToken();

        $usuario = User::create($campos);

        return $this->showOne($usuario, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return $this->showOne($usuario);
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
        $usuario = User::findOrFail($id);
        $reglas = [
            'password' => 'min:6|confirmed', // Requerido, minimo 6 caract., confirmado con password_confirmation
            'email' => 'email|unique:users,email,' . $usuario->id ,   // Requerido, formato email, unico en la tabla users exceptuando el id
        ];

        $this->validate($request, $reglas);

        if ($request->has('name')){
            $usuario->name = $request->name;
        }

        if ($request->has('password')){
            $usuario->password = bcrypt($request->password);
        }

        if ($request->has('email') && $usuario->email != $request->email){
            $usuario->verified = User::USUARIO_NO_VERIFICADO;
            $usuario->verification_token = User::generarVerificationToken();
            $usuario->email = $request->email;
        }

        if ($request->has('admin')){
            if (!$usuario->esVerificado())   // 409 conflicto con la peticion
                return $this->errorResponse('No se puede cambiar el valor de administrador para un usuario no verificado', 409);

            $usuario->admin = $request->admin;
        }

        if (!$usuario->isDirty())  // Si el usuario no ha sido modificado en alguno de sus valores  // 422 Malformed Request
            return $this->errorResponse('Se debe especificar al menos un valor diferente para modificar', 422);  

        $usuario->save();

        return $this->showOne($usuario);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);

        $usuario->delete();

        return $this->showOne($usuario);
    }
}
