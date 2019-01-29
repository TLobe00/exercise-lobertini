<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\product;
use App\inventory;
use App\comments;

class getProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exercise:getProducts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets current products';

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

        $products = product::limit(20000)->orderBy('created_at', 'DESC')->get();




        dd($products->find(1)->inventory);

    }
}
