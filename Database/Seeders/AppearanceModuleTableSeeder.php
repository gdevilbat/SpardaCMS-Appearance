<?php

namespace Gdevilbat\SpardaCMS\Modules\Appearance\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use DB;

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

        DB::table('module')->insert([
            [
                'name' => 'Appearance',
                'slug' => 'appearance',
                'scope' => json_encode(array('menu', 'create', 'read', 'update', 'delete')),
                'created_at' => \Carbon\Carbon::now()
            ]
        ]);
    }
}
