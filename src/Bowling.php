<?php

    namespace App;

    class Bowling {

        public function roll(string $value): string {
            return $value;
        }

        public function result(string $frame): int {
            $result = 0;
            for ($i=0; $i<strlen($frame); $i++) {
                $cumul = $frame[$i];
                if (($frame[$i-1] == '/') and ($i+1==strlen($frame))) $cumul = 0;
                
                // Miss 
                if ($frame[$i] == '-') $cumul = 0;

                // Spare
                if ($frame[$i] == '/') {
                    // frame courant égal 10
                    $cumul  = 10 - $frame[$i-1] + $frame[$i+1];                    
                }
                $result += $cumul;
            }
            return $result;
        }

    }
    
?>
