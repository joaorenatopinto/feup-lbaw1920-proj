<?php

namespace App\Console\Commands;

use App\Auction;
use App\Http\Controllers\AuctionController;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AuctionUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:AuctionUpdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks if any auction should close and closes it';

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
        foreach(Auction::all() as $auction){
            if($auction->getLastStatus()->status == 'ongoing'){
                if($auction->shouldClose()){
                    app('App\Http\Controllers\AuctionController')->close($auction->id);
                } 
            }  
        }
    }
}
