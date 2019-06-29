<?php

namespace Gdevilbat\SpardaCMS\Modules\Appearance\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MenuControllerTest extends TestCase
{
    use RefreshDatabase, \Gdevilbat\SpardaCMS\Modules\Core\Tests\ManualRegisterProvider;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testReadMenu()
    {
        $response = $this->get(action('\Gdevilbat\SpardaCMS\Modules\Appearance\Http\Controllers\MenuController@index'));

        $response->assertStatus(302)
                 ->assertRedirect(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\Auth\LoginController@showLoginForm')); // Return Not Valid, User Not Login

        $user = \App\User::find(1);

        $response = $this->actingAs($user)
                         ->get(action('\Gdevilbat\SpardaCMS\Modules\Appearance\Http\Controllers\MenuController@index'))
                         ->assertSuccessful(); // Return Valid
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateMenu()
    {
        $response = $this->get(action('\Gdevilbat\SpardaCMS\Modules\Appearance\Http\Controllers\MenuController@index'));

        $response->assertStatus(302)
                 ->assertRedirect(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\Auth\LoginController@showLoginForm')); //Return Not Valid, User Not Login

        $user = \App\User::find(1);

        $faker = \Faker\Factory::create();
        $name = $faker->word;
        $slug = $faker->word;

        $category = \Gdevilbat\SpardaCMS\Modules\Taxonomy\Entities\TermTaxonomy::with('term')->where(['taxonomy' => 'category'])->first();

        $response = $this->actingAs($user)
                         ->from(action('\Gdevilbat\SpardaCMS\Modules\Appearance\Http\Controllers\MenuController@index'))
                         ->json('POST', action('\Gdevilbat\SpardaCMS\Modules\Appearance\Http\Controllers\MenuController@store'), [
                                'menu' => [
                                    [
                                        'text' => $category->term->name,
                                        'term_id' => $category->term->getKey(),
                                        'target' => '_self',
                                        'slug' => $category->taxonomy.'/'.$category->slug,
                                        'menu_order' => 0,
                                        'title' => ''
                                    ]
                                ]
                            ])
                         ->assertSuccessful();

        $this->assertDatabaseHas(\Gdevilbat\SpardaCMS\Modules\Taxonomy\Entities\TermTaxonomy::getTableName(), ['term_id' => $category->term->getKey(), 'taxonomy' => 'navbar']);
    }

}
