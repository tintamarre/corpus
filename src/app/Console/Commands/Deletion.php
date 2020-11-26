<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Deletion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maintenance:deletion';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This maintenance commande will find all models with [`deleted_at` != null] and delete them.';

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
        //
    }
}
