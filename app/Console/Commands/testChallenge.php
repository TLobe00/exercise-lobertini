<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp;

class testChallenge extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:challenge';

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
     * @return mixed
     */
    public function handle()
    {
        //

        $object = $this->getURL('http://letsrevolutionizetesting.com/challenge?', NULL);
        $i = 1;

        while (isset($object->follow)) {
          $id = strstr($object->follow,'?id=');
          $id = str_replace('?id=','',$id);
          //dd($id);
          $object = $this->getURL($object->follow, $id);
          $i++;
        }

        if (isset($object->message)) {
          print $object->message;
        }
    }

    public function getURL($url, $data) {

      $url = str_replace('challenge?','challenge.json?',$url);

      $client = new GuzzleHttp\Client();
      $body = $client->get($url)->getBody();

      $obj = json_decode($body);

      return $obj;
    }
}
