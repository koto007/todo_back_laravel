<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Database\Seeders\StatusTableSeeder;
use Database\Seeders\TaskTableSeeder;
use App\Models\Task;

class FilterTest extends DuskTestCase
{
    use DatabaseTruncation;

    public function test_filter_status(): void {
        $this->seed(StatusTableSeeder::class);
        $this->seed(TaskTableSeeder::class);
        $taskInProgress = Task::create(['title' => 'task in progress']);
        $taskCompleted = Task::create(['title' => 'task completed']);

        $this->browse(function (Browser $browser) use($taskCompleted) {
            $browser->visit('/')
                ->waitForText('TODO')
                ->pause(2000)
                // ->waitForText('task in progress')
                ->assertVisible('.each-task-COMP')
                ->assertVisible('.each-task-INPR')
                ->click('.delete', $taskCompleted)
                ->click('.COMP button')
                ->assertVisible('.each-task-COMP')
                ->assertMissing('.each-task-INPR')
                ;
        });
    }
    
}
