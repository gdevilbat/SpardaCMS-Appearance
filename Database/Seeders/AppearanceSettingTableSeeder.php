<?php

namespace Gdevilbat\SpardaCMS\Modules\Appearance\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use DB;

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

        DB::table('setting')->insert([
            [
                'name' => 'taxonomy_menu',
                'value' => json_encode('category'),
            ]
        ]);
    }
}
