<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Database\Seeders\StatusTableSeeder;
use App\Models\Task;

class OrderTest extends DuskTestCase
{

    public function test_filter_status(): void {
        $this->seed(StatusTableSeeder::class);

        Task::create(['title' => 'Task A']);
        Task::create(['title' => 'Task B']);
        Task::create(['title' => 'Task C']);
        
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->pause(2000)
                    ->waitForText('TODO');

            $tasks = $browser->elements('.each-task input');
            $values = [];

            foreach ($tasks as $task) {
                $values[] = $task->getAttribute('value');
            }

            $sortedTitles = $values;
            sort($sortedTitles);

            $this->assertEquals($sortedTitles, $values);
        });
    }
}
