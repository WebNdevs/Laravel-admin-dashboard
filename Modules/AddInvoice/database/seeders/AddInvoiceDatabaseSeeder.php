<?php

namespace Modules\AddInvoice\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Tag\Entities\AddInvoice;

class AddInvoiceDatabaseSeeder extends Seeder
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
         * AddInvoices Seed
         * ------------------
         */

        // DB::table('addinvoices')->truncate();
        // echo "Truncate: addinvoices \n";

        AddInvoice::factory()->count(20)->create();
        $rows = AddInvoice::all();
        echo " Insert: addinvoices \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
