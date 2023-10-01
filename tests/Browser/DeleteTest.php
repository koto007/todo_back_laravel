<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Laravel\Dusk\Keyboard;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use App\Http\Controllers\Api\TaskController;
use Database\Factories\TaskFactory as factory;
use App\Models\Task;

class DeleteTest extends DuskTestCase
{   
    use DatabaseTruncation;

    public function test_delete_task(): void {
        $taskContent = 'Task to be deleted';
        Task::create(['title' => $taskContent]);

        $this->browse(function (Browser $browser) use ($taskContent) {
            $browser->visit('/')
                    ->waitForText('TODO')
                    ->assertSee('TODO')
                    // ->type('newTask', $taskContent)
                    // ->press('add')
                    // ->pause(2000)
                    ->waitForText($taskContent, 10)
                    ->assertSee($taskContent)
                    ;

            $browser->click('.delete', $taskContent);

            $browser->assertDontSee($taskContent);

            $this->assertDatabaseMissing('tasks', ['title' => $taskContent]);
        });

      
    }
}
