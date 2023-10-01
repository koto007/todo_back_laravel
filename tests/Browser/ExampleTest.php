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
}
