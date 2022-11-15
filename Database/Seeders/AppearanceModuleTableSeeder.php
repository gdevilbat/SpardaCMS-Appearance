<?php

namespace Gdevilbat\SpardaCMS\Modules\Appearance\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use DB;

use Gdevilbat\SpardaCMS\Modules\Core\Entities\Module;

class AppearanceModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Module::firstOrCreate(
            ['slug' => 'appearance'],
            [
                'name' => 'Appearance',
                'scope' => array('menu', 'create', 'read', 'update', 'delete', 'permission'),
                'is_scanable' => '1',
                'created_at' => \Carbon\Carbon::now()
            ]
        );
    }
}
