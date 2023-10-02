<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Laravel\Dusk\Keyboard;
use App\Http\Controllers\Api\TaskController;
use Database\Factories\TaskFactory as factory;
use App\Models\Task;

class DeleteTest extends DuskTestCase
{   
    public function test_delete_task(): void {
        $taskContent = 'Task to be deleted ?';
        Task::create(['title' => $taskContent]);
        $this->assertDatabaseHas('tasks', ['title' => $taskContent]);

        $this->browse(function (Browser $browser) use ($taskContent) {
            $browser->visit('/')
                    ->waitForText('TODO')
                    ->pause(1000)
                    ->assertValue('input[name="inputTitle"]', $taskContent)
                    ->click('.delete', $taskContent)
                    ->pause(1000)
                    ->assertDontSee($taskContent);

            $this->assertDatabaseMissing('tasks', ['title' => $taskContent]);
        });
    }
}
