<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class ImageClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Limpa o cache das imagens';

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
        $this->comment('Limpando a pasta ' . config('image.write_path'));
        File::deleteDirectory(public_path(config('image.write_path')), true);
    }
}
