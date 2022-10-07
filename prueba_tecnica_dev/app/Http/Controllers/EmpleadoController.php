<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use App\Models\Empleado;
use App\Models\EmpleadoRol;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados['empleados'] = Empleado::select("empleados.id","empleados.nombre", "empleados.email", "empleados.sexo", "areas.nombre as area", "empleados.boletin")
        ->join("areas", "areas.id", "=", "empleados.area_id")
        ->orderBy("empleados.nombre", "DESC")
        ->paginate(5);
        return view('employee.index', $empleados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areasAll['areas'] = Areas::all();
        $rolesAll['roles'] = Roles::all();
        return view("employee.create", $areasAll, $rolesAll);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);
        $empleado = request()->except('_token', 'role_id');
        Empleado::create($empleado);

        $empleadoId = Empleado::select('id')->orderBy('id', 'desc')->first();
        $this->addRoles($request, $empleadoId->id);
        //EmpleadoRol::create(['empleado_id'=>$empleadoId->id, 'rol_id'=>request('role_id')]);
        return redirect('employee')->with('message', 'Empleado registado con exito!');
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $areasAll['areas'] = Areas::all();
        $rolesAll['roles'] = Roles::all();
        $rolesEmpleado =[];

        $empleado = Empleado::with('roles','areas')->findOrFail($id);
        foreach ($empleado->roles as $roles) {
            array_push($rolesEmpleado, $roles['id']);
        }
        $empleado['role'] = $rolesEmpleado;
        //return response()->json($empleado,200);
        return view('employee.edit', compact('empleado'))->with($areasAll)->with($rolesAll);
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
        $this->validateRequest($request);
        $empleado = request()->except(['_token', '_method', 'role_id']);

        $boletin=request('boletin');
        if($boletin != "1")
        $empleado['boletin'] = 0;

        Empleado::findOrFail($id)->update($empleado);
        $this->addRoles($request, $id);
        return redirect("employee")->with('message', 'El empleado fue actualizado con exito');
    }

    public function addRoles($request, $id){
        EmpleadoRol::where('empleado_id', '=', $id)->delete();
        foreach ($request->role_id as $key => $name) {
            $insert = [
                'empleado_id' => $id,
                'rol_id' => $request->role_id[$key],
            ];
            EmpleadoRol::create($insert);
        }
    }

    public function validateRequest($request){

        $field = [
            'nombre' => 'required|string|max:200',
            'email' => 'required|email|max:500',
            'sexo' => 'required|string',
            'area_id' => 'required|integer',
            'descripcion' => 'required|string',
            'role_id' => 'required',
        ];

        $message = [
            'required' => 'El :attribute es requerido',
            'descripcion.required' => 'La descripción es requerida',
            'area_id.required' => 'Debes seleccionar el area',
            'role_id.required' => 'Debes seleccionar al menos un rol',
            'sexo' => 'Debes seleccionar el sexo',
        ];

        $this->validate($request, $field, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Empleado::destroy($id);//elimino el registro que contenga el id enviado
        return redirect('employee')->with('message', 'El empleado fue eliminado con exito!');
    }
}
