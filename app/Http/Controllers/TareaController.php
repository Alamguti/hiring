<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\User;

use Illuminate\Http\Request;

class TareaController extends Controller
{
    //
    public function listarTareas(){
        $tareas = Task::all();
        return response()->json($tareas);
    }
    public  function agregarTarea(request $request){
        $request->validate([
            'nombre' => 'required|string',
        ]);
        
        $tarea = Task::create([
            'nombre' => $request->nombre,
            'usuario_id' =>$request->usuario['id'],
        ]);
        return response()->json($tarea, 201);
    }

    public  function eliminarTarea($tareaId){
        $tarea = Task::find($tareaId);
        
        $tarea->delete();
        return response()->json(['message' => 'Tarea eliminada']);
    }

    public  function editarTarea(request $request,Task $tarea){
        $request->validate([
            'nombre' => 'required|string',
        ]);

        $tarea->update($request->all());
        return response()->json($tarea, 200);
    }
}
