<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use App\Models\Task;

class UpdateTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_update_title() {
        $oldTitle = 'Let\'s change title';
        Task::create(['title' => $oldTitle]);
        $newTitle = 'Updated !';
        $this->browse(function (Browser $browser) use ($oldTitle, $newTitle) {

            $browser->visit('/')
                    ->pause(3000)
                    ->waitForText($oldTitle, 10)
                    // ->assertSee($oldTitle)
                    ->click('.edit-title')
                    ->type('inputTitle', $newTitle)
                    ->press('update-title')
                    ->pause(3000)
                    ->waitForText($newTitle, 10)
                    ->assertSee($newTitle);
        });
    }

    public function test_update_status() {
        $task = 'change status';
        Task::create(['title' => $task]);

        $this->browse(function (Browser $browser) use ($task) {

            $browser->visit('/')
                  ->pause(1000)
                    // ->waitForText($task, 10)
                    // ->assertSee($task)
                    ->check('.check-box', $task)
                    // ->type('input-title', $newTitle)
                    // ->waitFor('.update-title')
                    // ->click('.update-title')
                    // ->waitForText($task)
                    ->pause(5000)
                    ->assertChecked('.check-box', $task);
                    // ->assertSee($newTitle);

        });
    }
    
    public function test_update_status_undo() {
        $task = 'change status checked';
        Task::create(['title' => $task]);
        $this->browse(function (Browser $browser) use ($task) {

            $browser->visit('/')
                    ->pause(1000)
                    // ->waitForText($task, 10)
                    // ->assertSee($task)
                    ->check('.check-box', $task)
                    ->check('.check-box', $task)
                    // ->type('input-title', $newTitle)
                    // ->waitFor('.update-title')
                    // ->click('.update-title')
                    // ->waitForText($task)
                    ->pause(3000)
                    ->assertNotChecked('.check-box', $task);
                    // ->assertSee($newTitle);
            
        });
    }
}
