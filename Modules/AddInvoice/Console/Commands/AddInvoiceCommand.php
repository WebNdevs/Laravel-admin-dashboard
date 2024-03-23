<?php

namespace Modules\AddInvoice\Console\Commands;

use Illuminate\Console\Command;

class AddInvoiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:AddInvoiceCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'AddInvoice Command description';

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
