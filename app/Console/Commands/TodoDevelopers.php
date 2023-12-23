<?php

namespace App\Console\Commands;

use App\Services\Integration\IntegrationService;
use Illuminate\Console\Command;

class TodoDevelopers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'todo:developers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $integrationService = new IntegrationService();
        $integrationService->updateTodoDevelopers();
    }
}
