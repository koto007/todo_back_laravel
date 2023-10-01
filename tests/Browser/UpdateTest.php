<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseTruncation;

class UpdateTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_update_title() {
        $oldTitle = 'Let\'s change title';
        $newTitle = 'Updated !';
        $this->browse(function (Browser $browser) use ($oldTitle, $newTitle) {

            $browser->visit('/')
                    ->waitForText('TODO')
                    ->assertSee('TODO')
                    ->type('newTask', $oldTitle)
                    ->press('add')
                    ->pause(3000)
                    // ->waitForText($oldTitle, 10)
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
        $this->browse(function (Browser $browser) use ($task) {

            $browser->visit('/')
                    ->waitForText('TODO')
                    ->assertSee('TODO')
                    ->type('newTask', $task)
                    ->press('add')
                    ->pause(3000)
                    // ->waitForText($task, 10)
                    // ->assertSee($task)
                    ->check('.check-box', $task)
                    // ->type('input-title', $newTitle)
                    // ->waitFor('.update-title')
                    // ->click('.update-title')
                    // ->waitForText($task)
                    
                    ->assertChecked('.check-box', $task);
                    // ->assertSee($newTitle);
            
        });
    }
    
    public function test_update_status_undo() {
        $task = 'change status checked';
        $this->browse(function (Browser $browser) use ($task) {

            $browser->visit('/')
                    ->waitForText('TODO')
                    ->assertSee('TODO')
                    ->type('newTask', $task)
                    ->press('add')
                    ->pause(3000)
                    // ->waitForText($task, 10)
                    // ->assertSee($task)
                    ->check('.check-box', $task)
                    ->check('.check-box', $task)
                    // ->type('input-title', $newTitle)
                    // ->waitFor('.update-title')
                    // ->click('.update-title')
                    // ->waitForText($task)
                    ->assertNotChecked('.check-box', $task);
                    // ->assertSee($newTitle);
            
        });
    }
}
