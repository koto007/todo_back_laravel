<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\TestCase;
use Database\Seeders\StatusTableSeeder;
use Database\Seeders\TaskTableSeeder;
use App\Models\Task;

class FilterTest extends DuskTestCase
{

    public function test_filter_status(): void {
        $this->seed(StatusTableSeeder::class);
        $this->seed(TaskTableSeeder::class);

        $this->browse(function (Browser $browser) use($taskCompleted) {
            $browser->visit('/')
                ->waitForText('TODO')
                ->pause(2000)
                ->assertVisible('.each-task-COMP')
                ->assertVisible('.each-task-INPR')
                ->click('.COMP button')
                ->assertVisible('.each-task-COMP')
                ->assertMissing('.each-task-INPR')
                ;
        });
    }
    
}
