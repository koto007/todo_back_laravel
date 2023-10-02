<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Task;

class UpdateTest extends DuskTestCase
{

    public function test_update_title() {
        $oldTitle = 'Let\'s change title';
        Task::create(['title' => $oldTitle]);
        $newTitle = 'Updated !';
        $this->browse(function (Browser $browser) use ($oldTitle, $newTitle) {

            $browser->visit('/')
                    ->pause(1000)
                    ->assertValue('input[name="inputTitle"]', $oldTitle)
                    ->click('.edit-title')
                    ->type('inputTitle', $newTitle)
                    ->press('update-title')
                    ->pause(1000)
                    ->assertValue('input[name="inputTitle"]', $newTitle);
        });
    }

    public function test_update_status_undo() {
        $task = 'change status checked';
        Task::create(['title' => $task]);
        $this->browse(function (Browser $browser) use ($task) {

            $browser->visit('/')
                    ->pause(1000)
                    ->assertValue('input[name="inputTitle"]', $task)
                    ->assertVisible('input[type="checkbox"]')
                    // check
                    ->check('input[type="checkbox"]')
                    ->pause(1000)
                    ->assertChecked('input[type="checkbox"]')
                    // uncheck
                    ->uncheck('input[type="checkbox"]')
                    ->pause(1000)
                    ->assertNotChecked('input[type="checkbox"]', $task);
        });
    }
}
