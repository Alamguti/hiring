<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;

use Illuminate\Http\Request;

class TareaController extends Controller
{
    //
    public function listarTareas(Request $request)
    {
        $idUsuario = $request->idUsuario;
        $tareasPendientes = Task::where('completada', false)
        ->where('usuario_id',$idUsuario)
        ->get();
        $tareasCompletadas = Task::where('completada', true)->get();
        return response()->json(['tareasPendientes' => $tareasPendientes, 'tareasCompletadas' => $tareasCompletadas]);
    }
    public  function agregarTarea(request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
        ]);

        $tarea = Task::create([
            'nombre' => $request->nombre,
            'usuario_id' => $request->usuario['id'],
            'completada' => false,
        ]);
        return response()->json(['message' => 'Tarea agregada', 'tarea' => $tarea]);
    }

    public  function eliminarTarea($tareaId)
    {
        $tarea = Task::find($tareaId);

        $tarea->delete();
        return response()->json(['message' => 'Tarea eliminada']);
    }

    public  function editarTarea(request $request, Task $tarea)
    {
        $request->validate([
            'nombre' => 'required|string',
        ]);

        $tarea->update($request->all());
        return response()->json(['message' => 'Tarea editada correctamente']);
    }
    public function cambiarEstadoTarea(Task $tarea)
    {
        $tarea->update(['completada' => true]);
        return response()->json(['message' => 'Tarea completada']);
    }
}
