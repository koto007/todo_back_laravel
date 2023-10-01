<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Database\Seeders\StatusTableSeeder;
use App\Models\Task;
use Illuminate\Foundation\Testing\DatabaseTruncation;

class OrderTest extends DuskTestCase
{
    // use DatabaseTruncation;

    public function test_filter_status(): void {
        $this->seed(StatusTableSeeder::class);

        Task::create(['title' => 'Task A']);
        Task::create(['title' => 'Task B']);
        Task::create(['title' => 'Task C']);
        
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->pause(2000)
                    ->waitForText('TODO');

            $elements = $browser->elements('.each-task');

            $taskTitles = $browser->elements('.each-task')->pluck('input')->toArray();
            $sortedTitles = $taskTitles;
            sort($sortedTitles);

            // Assert that the titles match the sorted order
            $browser->assertEquals($sortedTitles, $taskTitles);
        });
    }
}
