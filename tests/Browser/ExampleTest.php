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

class ExampleTest extends DuskTestCase
{   
    use DatabaseTruncation;

    // protected $exceptTables = ['tasks'];

    /**
     * A basic browser test example.
     */
    public function testBasicExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->waitForText('TODO')
                    ->assertSee('TODO');
        });
    }

    public function test_new_task(): void {
        $this->browse(function (Browser $browser) {
            $newTask = 'Finish application';
            $browser->visit('/')
                    ->waitForText('TODO')
                    ->assertSee('TODO')
                    ->type('newTask', $newTask)
                    ->press('add');

            $this->assertDatabaseHas('tasks', [
                'title' => $newTask,
                'completed' => 0
            ]);
        });
    }

    public function test_delete_task(): void {

        $taskContent = 'Task to be deleted';
        Task::create([
            'title' => $taskContent,
            'completed' => 0,
            'created_at' => Date('Y-m-d H:i:s'),
            'updated_at' => Date('Y-m-d H:i:s')]);

        $this->browse(function (Browser $browser) use ($taskContent) {
            $browser->visit('/')
                ->waitForText($taskContent)
                ->assertSee($taskContent);

            $browser->click('delete', $taskContent);

            $browser->assertDontSee($taskContent);

            $this->assertDatabaseMissing('tasks', ['content' => $taskContent]);
        });

      
    }
}
