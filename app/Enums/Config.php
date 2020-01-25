<?php

namespace App\Enums;

abstract class Config
{
    
    const SYMBOLS = [
        '9','10','J','Q','K','A','cat','dog','monkey','bird'
        ];

    const WINNING_TABLE = [
        '3' => 20,
        '4' => 200,
        '5' => 1000
    ];  

    const PAYLINES = [
        '0' => ['0', '3', '6', '9', '12'],
        '1' => ['1', '4', '7', '10', '13'],
        '2' => ['2', '5', '8', '11', '14'],
        '3' => ['0', '4', '8', '10', '12'],
        '4' => ['2', '4', '6', '10', '14'],
    ]; 

    const BET = 100;
    const ROWS = 3;
    const COLUMNS = 5;

}
