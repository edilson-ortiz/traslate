<?php

namespace App\Console\Commands;

use App\Services\Convertio;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http as FacadesHttp;

class http extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'http';

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

        $data = Convertio::Upload('https://41ce-177-222-37-108.ngrok-free.app/audio/min.m4a');
        print($data['transcript']);
        
    }
}