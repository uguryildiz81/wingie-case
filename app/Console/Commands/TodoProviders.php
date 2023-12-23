<?php

namespace App\Console\Commands;

use App\Services\Integration\IntegrationService;
use Illuminate\Console\Command;

class TodoProviders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'todo:providers';

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

        $integrations = config('integration.integrations');
        $integrationService = new IntegrationService();
        collect($integrations)->map(function (string $integration) use ($integrationService) {
            $integrationService->insertProvider($integration);
        });
    }
}
