<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Laravel\Dusk\Keyboard;
use App\Http\Controllers\Api\TaskController;
use Database\Factories\TaskFactory as factory;
use App\Models\Task;

class RegisterTest extends DuskTestCase
{ 
    public function test_new_task(): void {
        $this->browse(function (Browser $browser) {
            $newTask = 'Finish application';

            $browser->visit('/')
                    ->waitForText('TODO')
                    ->assertSee('TODO')
                    ->type('newTask', $newTask)
                    ->press('add')
                    ->pause(1000);
                   
            $this->assertDatabaseHas('tasks', ['title' => $newTask]);
        });
    }

    public function test_new_empty_task(): void {
        $this->browse(function (Browser $browser) {
            $newTask = '';

            $browser->visit('/')
                    ->waitForText('TODO')
                    ->assertSee('TODO')
                    ->type('newTask', $newTask)
                    ->press('add')
                    ->assertSee('Task name required');
        });
    }
}
