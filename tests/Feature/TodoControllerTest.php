<?php

namespace Tests\Feature;

use App\Helpers\TodoHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Todo;

class TodoControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * :Get all todos succeeds:
     *
     * @return void
     */
    public function test_get_all_todos_succeed()
    {

        $todo = Todo::factory()->create();

        $response = $this->getJson('/api/todos');

        $response->assertStatus(200)->assertJson([[
            'id' => $todo->id,
            'title' => $todo->title,
            'completed_at' => null,
            'created_at' => TodoHelper::formatDbTimestamp($todo->created_at),
            'updated_at' => TodoHelper::formatDbTimestamp($todo->updated_at),
        ]]);
    }
}
