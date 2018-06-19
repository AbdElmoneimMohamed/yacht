<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeployLocal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploy:local';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'deploy my app locally';

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
        $this->call("key:generate");
        $this->call("migrate:refresh");
        $this->call("db:seed");
        $this->call("passport:install");

    }
}
