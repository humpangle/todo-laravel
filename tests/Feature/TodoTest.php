<?php

namespace Tests\Feature;

use App\Helpers\TodoHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Todo;
use Illuminate\Support\Carbon;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Uncompleted todo can be completed
     *
     * @return void
     */
    public function test_complete_uncompleted()
    {
        $todo = Todo::factory()->create();
        $this->assertNull($todo->completed_at);

        $now = TodoHelper::formatDbTimestamp(Carbon::now());

        $todo->updateWith([
            'completed_at' => $now,
        ]);

        $updatedTodo = Todo::find($todo->id);

        $this->assertEquals(
            $now,
            TodoHelper::formatDbTimestamp(
                $updatedTodo->completed_at
            )
        );
    }

    /**
     * Completed todo can be un-completed
     */
    public function test_un_complete_completed()
    {
        $now = Carbon::now();

        $todo = Todo::factory()->create([
            'completed_at' => $now,
        ]);

        $this->assertEquals($now, $todo->completed_at);

        $todo->updateWith([
            'completed_at' => null,
        ]);

        $updatedTodo = Todo::find($todo->id);

        $this->assertNull($updatedTodo->completed_at);
    }


    /**
     * Todo should not be completed if completion time not specified in update attributes
     */
    public function test_no_accidental_un_complete_completed()
    {
        $now = TodoHelper::formatDbTimestamp(Carbon::now());

        $todo = Todo::factory()->create([
            'completed_at' => $now,
            'title' => 'title1',
        ]);

        $completedAtStr = TodoHelper::formatDbTimestamp($todo->completed_at);

        $this->assertEquals($now, $completedAtStr);
        $this->assertEquals('title1', $todo->title);

        $todo->updateWith([
            'title' => 'title2',
        ]);

        $updatedTodo = Todo::find($todo->id);
        $updatedCompletedAtStr = TodoHelper::formatDbTimestamp($updatedTodo->completed_at);

        $this->assertEquals($now, $updatedCompletedAtStr);
        $this->assertEquals('title2', $updatedTodo->title);
    }
}
