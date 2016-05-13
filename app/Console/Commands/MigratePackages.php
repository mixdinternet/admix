<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigratePackages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:packages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Executa a migração dos pacotes da MIXD';

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
        $this->comment('Executando php artisan migrate');
        $this->call('migrate');

        $dirs = [
            'vendor/mixdinternet/*/src/database/migrations/*.php'
            , 'packages/*/*/src/database/migrations/*.php'
        ];

        foreach ($dirs as $dir) {
            foreach (glob(base_path() . "/" . $dir) as $filename) {
                $path = dirname(str_replace(base_path() . '/', '', $filename));

                $this->comment('Executando php artisan migrate --path=' . $path);
                $this->call('migrate', [
                    '--path' => $path
                ]);
            }
        }
    }
}
