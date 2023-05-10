<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send command to the selected devices';

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
     * @return int
     */
    public function handle()
    {
        $this->info('My command is running!');
    }
}
