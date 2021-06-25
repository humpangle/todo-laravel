<?php

namespace Tests\Feature;

use App\Helpers\TodoHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Todo;
use Illuminate\Support\Carbon;

class TodoControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * :Get all todos succeeds:
     */
    public function test_get_all_todos_succeed()
    {
        $todo = Todo::factory()->create();

        $response = $this->getJson('/api/todos');

        $response->assertStatus(200)->assertJson([[
            'id' => $todo->id,
            'title' => $todo->title,
            'completed_at' => null,
        ]]);
    }

    /**
     * :Create todo succeeds:
     */
    public function test_create_todo_succeeds()
    {
        $now = TodoHelper::formatDbTimestamp(Carbon::now());
        $todo = Todo::factory()->make([
            'completed_at' => $now,
        ]);

        $response = $this->postJson(
            '/api/todos',
            $todo->toArray()
        );

        $response->assertStatus(201)->assertJson([
            'title' => $todo->title,
            'completed_at' => $now,
        ]);
    }

    /**
     * :Get todo succeeds:
     */
    public function test_get_todo_succeeds()
    {
        $todo = Todo::factory()->create();

        $response = $this->getJson(
            '/api/todos/' . $todo->id,
        );

        $response->assertStatus(200)->assertJson([
            'title' => $todo->title,
            'completed_at' => null,
        ]);
    }

    /**
     * :Get todo fails:
     */
    public function test_get_todo_fails()
    {

        $response = $this->getJson(
            '/api/todos/1'
        );

        $response->assertStatus(404);
    }

    /**
     * :Update todo succeeds:
     */
    public function test_update_todo_succeeds()
    {
        $todo = Todo::factory()->create([
            'title' => 'title1',
        ]);

        $id = $todo->id;
        $completionTimestamp = TodoHelper::formatDbTimestamp(Carbon::now());

        $response = $this->patchJson(
            '/api/todos/' . $id,
            [
                'title' => 'title2',
                'completed_at' => $completionTimestamp,
            ]
        );

        $response->assertStatus(200)->assertJson([
            'id' => $id,
            'title' => 'title2',
            'completed_at' => $completionTimestamp,
        ]);

        $updatedTodo = Todo::find($id);
        $this->assertEquals(
            $completionTimestamp,
            $updatedTodo->stringAttr('completed_at')
        );
        $this->assertEquals(
            'title2',
            $updatedTodo->title,
        );
    }

    /**
     * :Delete todo succeeds:
     */
    public function test_delete_todo_succeeds()
    {
        $todo = Todo::factory()->create();
        $id = $todo->id;

        $response = $this->deleteJson(
            '/api/todos/' . $id,
        );

        $response->assertStatus(200)->assertJson([
            'id' => $id,
            'title' => $todo->title,
        ]);

        $deletedTodo = Todo::find($id);
        $this->assertNull($deletedTodo);
    }

    /**
     * :Delete todo fails:
     */
    public function test_delete_todo_fails()
    {
        $id = 'bogus-id';
        $response = $this->deleteJson(
            '/api/todos/' . $id,
        );

        $response->assertStatus(404);
    }
}
