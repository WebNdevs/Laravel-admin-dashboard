<?php

namespace Modules\Group\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Tag\Entities\Group;

class GroupDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        /*
         * Groups Seed
         * ------------------
         */

        // DB::table('groups')->truncate();
        // echo "Truncate: groups \n";

        Group::factory()->count(20)->create();
        $rows = Group::all();
        echo " Insert: groups \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
