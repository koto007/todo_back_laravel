<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Database\Seeders\StatusTableSeeder;
use Database\Seeders\TaskTableSeeder;

class FilterTest extends DuskTestCase
{
    // use DatabaseMigrations;

    public function test_filter_status(): void {
        $this->seed(StatusTableSeeder::class);
        $this->seed(TaskTableSeeder::class);
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->waitForText('TODO')
                ->assertVisible('.each-task.COMP')
                ->assertVisible('.each-task.INPR')
                ->click('.COMP button')
                ->assertVisible('.each-task.COMP')
                ->assertMissing('.each-task.INPR')
                ;
        });
    }
    
}
