<?php

namespace Modules\PaymentReceived\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Tag\Entities\PaymentReceived;

class PaymentReceivedDatabaseSeeder extends Seeder
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
         * PaymentReceiveds Seed
         * ------------------
         */

        // DB::table('paymentreceiveds')->truncate();
        // echo "Truncate: paymentreceiveds \n";

        PaymentReceived::factory()->count(20)->create();
        $rows = PaymentReceived::all();
        echo " Insert: paymentreceiveds \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
