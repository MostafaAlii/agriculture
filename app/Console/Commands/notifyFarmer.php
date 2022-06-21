<?php

namespace App\Console\Commands;

use App\Models\Farmer;
use App\Models\Product;
use App\Mail\NotifyFarmerMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class notifyFarmer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'farmer:notify_expire_offer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'notify farmer with expired offers of his products';

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
       // Log::info('ssss');
        //---------------------------------------------------------------
        $all_farmars=Farmer::all();
        foreach($all_farmars as $farmer){
            $expire_offers=$farmer->expireProducts();
            
            if(count($expire_offers)>0){
                //send mail to farmer with this products to renew offer
                Mail::To($farmer->email)->send(new NotifyFarmerMail($expire_offers));
            
                //update this offers with null values for[start date & end date & special price]
                $ids=$farmer->expireProducts()->pluck('id');
                Product::whereIn('id',$ids)->update([
                    'special_price'=>Null,
                    'special_price_start'=>Null,
                    'special_price_end'=>Null,
                    
                ]);
            }
        }
        //---------------------------------------------------------------
    }
}
