<?php

namespace Modules\PaymentReceived\Console\Commands;

use Illuminate\Console\Command;

class PaymentReceivedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:PaymentReceivedCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'PaymentReceived Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
