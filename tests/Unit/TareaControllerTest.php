<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\TareaController;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Mockery;

class TareaControllerTest extends TestCase
{
    public function testListarTareas()
    {
        
        $user = new User(['id' => 1]); // Crear un usuario 

        
        $taskMock = Mockery::mock(Task::class);
        $taskMock->shouldReceive('where')->with('completada', false)->andReturnSelf();
        $taskMock->shouldReceive('where')->with('usuario_id', $user->id)->andReturnSelf();
        $taskMock->shouldReceive('get')->andReturn(collect([]));  // Simula una colección vacía

        // Crear una instancia de TareaController con el mock inyectado
        $controller = new TareaController($taskMock);

        // Llamada al método listarTareas
        $request = new Request(['idUsuario' => $user->id]);
        $response = $controller->listarTareas($request);

        // Asertos para verificar el resultado
        $this->assertEquals(200, $response->status());
        $this->assertArrayHasKey('tareasPendientes', $response->original);
        $this->assertArrayHasKey('tareasCompletadas', $response->original);

        // Limpiar el mock después de la prueba
        Mockery::close();
    }
}
