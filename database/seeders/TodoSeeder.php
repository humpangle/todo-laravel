<?php

namespace Database\Seeders;

use App\Helpers\TodoHelper;
use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 20) as $key) {
            $num = rand(0, 1);

            Todo::factory()->create([
                'completed_at' => $num == 1
                    ?  TodoHelper::formatDbTimestamp(Carbon::now())
                    : null,
            ]);
        }
    }
}
