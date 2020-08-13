<?php

namespace App\Console\Commands;

use App\Services\GetInfoService;
use Illuminate\Console\Command;

class GetPlots extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plots:info {plots}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $plots = $this->argument('plots');
        $service = new GetInfoService();
        $res = $service->getInfo($plots);
        $counter = 0;
        echo "╔═════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════╗";
        echo "\n";
        echo "║  CN                               |    Addr                                                                                                                                       | Price                  | Area               ║";
        echo "\n";
        echo "╟─────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────╢";
        echo "\n";
        foreach ($res as $plot) {
            $counter++;
            echo "║                                                                                                                                                                                                                                 ║";
            echo "\n";
            echo "║ " . $plot->cadastral_number . "                | " . $plot->address . "                                   |  " . $plot->price . "                 |  " . $plot->area . "             ║";
            echo "\n";
            echo "║                                                                                                                                                                                                                                 ║";
            echo "\n";
            if ($counter != count($res)) {
                echo "╟─────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────╢";
                echo "\n";
            }
        }

        echo "╚═════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════════╝";
    }
}
