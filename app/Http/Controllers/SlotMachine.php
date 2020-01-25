<?php namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use App\Enums\Config;

class SlotMachine extends Controller
{
    public $board = [];

    public function __construct()
    { 
        $this->totalWin = 0;
        $this->ordered_board = [];
        $this->result = [];

        $this->bet = Config::BET;
        $this->rows = Config::ROWS;
        $this->columns = Config::COLUMNS;

        $this->symbols = Config::SYMBOLS;
        $this->winning_table = Config::WINNING_TABLE;
        $this->paylines = Config::PAYLINES;
    }

    public function start() 
    {
        $this->result['board'] = $this->prepareTheBoard();
        $this->checkConsecutiveRepites();

        return json_encode($this->result);
    }

    /**
     * Prepare the board
     */
    public function prepareTheBoard()
    {
        for ($x = 0; $x<=$this->rows*$this->columns-1; $x++){  
            array_push($this->board, $this->symbols[array_rand($this->symbols)]);
        }  
        
        return $this->orderTheBoard();
    }

    /**
     * Order the board
     */
    public function orderTheBoard()
    {
        for ($row = 0; $row <= $this->rows-1; $row ++ ) {
            for ($columns = $row; $columns <= $this->rows * $this->columns - 1; $columns = $columns + $this->rows){
                array_push($this->ordered_board, $this->board[$columns]);
            }
        }
        return implode(", ", $this->ordered_board); 
    }

    /**
     * Check Consecutive Repites
     */
    public function checkConsecutiveRepites()
    {
        foreach ($this->paylines as $i => $paylines) {
            
            $tempWord = null;
            $consecutives = 1;
            
            foreach ($paylines as $payline) {
                if ($tempWord != null && $this->board[$payline] == $tempWord) {
                    $consecutives ++;
                } else {
                    if ($consecutives>=3)
                        $this->winningTableCalculation($consecutives,$paylines);
                    
                    $consecutives = 1;
                }
                $tempWord = $this->board[$payline];
            }
            $this->winningTableCalculation($consecutives,$paylines);
        } 

        $this->result['bet_amount'] = $this->bet;
        $this->result['total_win'] = $this->totalWin;
    }

    /**
     * Winning table calculation
     */
    public function winningTableCalculation($consecutives,$paylines)
    {
        if (isset($this->winning_table[$consecutives])) 
            $this->totalWin = $this->winning_table[$consecutives] + $this->totalWin;
        
        if ($consecutives >= 3) 
            $this->result['paylines'][][implode(" ", $paylines)] = $consecutives;
    }
}

