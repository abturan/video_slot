<?php namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use App\Http\Controllers\SlotMachine;

class Slot extends Command
{

    protected $signature = "slot";
    protected $description = 'Slot Machine Challenge';

    
    public function handle()
    {
        try {
            $slotMachine = new SlotMachine;  
            echo $slotMachine->start();
            echo "\n";
        } catch (Exception $e) {
            $this->error($e);
        }
    }
}
