<?php

namespace Gdevilbat\SpardaCMS\Modules\Appearance\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use DB;

use Gdevilbat\SpardaCMS\Modules\Core\Entities\Setting;

class AppearanceSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Setting::firstOrCreate(
            ['name' => 'taxonomy_menu'],
            [
                'value' => 'category',
            ]
        );
    }
}
