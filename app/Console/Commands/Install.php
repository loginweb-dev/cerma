<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cerma:install';

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
     * @return int
     */
    public function handle()
    {
        $this->call('key:generate');
        $this->call('migrate:refresh');
        $this->call('db:seed');

        $this->info('
            █ █▄░█ █▀ ▀█▀ ▄▀█ █░░ █░░ █▀▀ █▀▄ █ █ █
            █ █░▀█ ▄█ ░█░ █▀█ █▄▄ █▄▄ ██▄ █▄▀ ▄ ▄ ▄
        ');
    }
}
