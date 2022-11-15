<?php

namespace Gdevilbat\SpardaCMS\Modules\Appearance\Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MenuTest extends DuskTestCase
{
    use DatabaseMigrations, \Gdevilbat\SpardaCMS\Modules\Core\Tests\ManualRegisterProvider;
    
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testCRUDMenu()
    {
        $user = \App\Models\User::find(1);
        $faker = \Faker\Factory::create();

        $this->browse(function (Browser $browser) use ($user, $faker) {
            $browser->loginAs($user)
                    ->visit(action('\Gdevilbat\SpardaCMS\Modules\Appearance\Http\Controllers\MenuController@index'))
                    ->assertSee('Menu Builder')
                    ->clickLink('Edit Item')
                    ->clickLink('Add')
                    ->clickLink('Save Menu')
                    ->waitForReload()
                    ->AssertSeeIn('#myEditor', 'Uncategorized')
                    ->script('document.getElementsByName("taxonomy_menu")[0].value = "'.$faker->word.'"');

            $browser->press('Submit')
                    ->assertSee('Success To Update Setting');
        });
    }
}
