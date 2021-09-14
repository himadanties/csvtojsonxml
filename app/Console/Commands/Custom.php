<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class Custom extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:json {filepath}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate json file';

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
        $filepath = $this->argument('filepath');
        if(isset($filepath)){
            $filename = $filepath;
            if(file_exists($filename)) {
                $rows = array_map('str_getcsv', file($filename));
                $header = array_shift($rows);
                $csv = array();
                foreach ($rows as $row) {
                    $csv[] = array_combine($header, $row);
                }
    
                if(!empty($csv)){
                    $createJson = Storage::disk('public')->put('items.json', json_encode($csv));
                    if($createJson === true){
                        $this->info('Json file created/updated.');
                    } else {
                        $this->info('Json creation/updation failed!');
                    }
                }
            } else {
                $this->info('Invalid File!');
            }
        } else {
            $this->info('Enter a valid command. Command should have a filepath as argument.');
        }

    }
}