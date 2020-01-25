<?php 

class SlotTest extends TestCase
{
    public $board = [];

    public $totalWin = 0;
    public $ordered_board = [];
    public $result = [];

    public $bet = 100;
    public $rows = 3;
    public $columns = 5;


    public $winning_table = [
        '3' => 20,
        '4' => 200,
        '5' => 1000
    ];  

    public $symbols = [
        '9','10','J','Q','K','A','cat','dog','monkey','bird'
        ];

    public $paylines = [
        '0' => ['0', '3', '6', '9', '12'],
        '1' => ['1', '4', '7', '10', '13'],
        '2' => ['2', '5', '8', '11', '14'],
        '3' => ['0', '4', '8', '10', '12'],
        '4' => ['2', '4', '6', '10', '14'],
    ];
        
    public function testSlotMachineIsWorkingWell()
    {
        
        $this->result['board'] = $this->prepareTheBoard();
        $this->checkConsecutiveRepites();

        $this->assertEquals(
            $this->board, ['J', 'Cat', 'Bird', 'J', 'J', 'Bird', 'J', 'Q', 'J', 'Q', 'Monkey', 'Q', 'K', 'Bird', 'A']
        );
        
        $this->assertEquals(
            $this->result['board'], "J, J, J, Q, K, Cat, J, Q, Monkey, Bird, Bird, Bird, J, Q, A"
        );

        $this->assertEquals(
            $this->result['paylines'][0]["0 3 6 9 12"], "3"
        );

        $this->assertEquals(
            $this->result['paylines'][1]["0 4 8 10 12"], "3"
        );

        $this->assertEquals(
            $this->result['bet_amount'], "100"
        );

        $this->assertEquals(
            $this->result['total_win'], "40"
        );
    }

    public function prepareTheBoard()
    {
        $this->board = array('J', 'Cat', 'Bird', 'J', 'J', 'Bird', 'J', 'Q', 'J', 'Q', 'Monkey', 'Q', 'K', 'Bird', 'A');
        return $this->orderTheBoard();
    }

    public function orderTheBoard()
    {
        for ($row = 0; $row <= $this->rows-1; $row ++ ) {
            for ($columns = $row; $columns <= $this->rows * $this->columns - 1; $columns = $columns + $this->rows){
                array_push($this->ordered_board, $this->board[$columns]);
            }
        }
        return implode(", ", $this->ordered_board); 
    }

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

    public function winningTableCalculation($consecutives,$paylines)
    {
        if (isset($this->winning_table[$consecutives])) {
            $this->totalWin = $this->winning_table[$consecutives] + $this->totalWin;
        }

        if ($consecutives >= 3) {
            $this->result['paylines'][][implode(" ", $paylines)] = $consecutives;
        }
    }

}