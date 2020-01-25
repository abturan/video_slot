# Video Slot Backend Test
This is a Backend Test for Vide Slot. This Backend Test runs on the laravel console and using Laravel Lumen. 

## Installation
1. Download as .zip or clone this repo using https://github.com/abturan/video_slot.git
```console
git clone https://github.com/abturan/video_slot.git
```
2. Run ```composer install``` to install the project dependencies
3. Type ```php artisan slot``` to play!   


## Created files

1. ```app/Enums/Config.php```: It is the file where the symbols, winning tables, paylines etc used in the game are determined.
2. ```app/Console/Commands/Slot.php```: Main command file wich the game run on.
3. ```app/Http/Controllers/SlotMachine.php```: Main controller file.
4. ```app/Console/Kernel.php```: The file in which the console file is integrated into the system.

