<?php

    namespace App;

    class Bowling {

        public function roll(string $value): string {
            return $value;
        }

        public function result(string $frame): int {
            $result = 0;
            for ($i=0; $i<strlen($frame); $i++) {
                if ($i > 1) {
                    // spare
                    if ($frame[$i-1] == '/') {
                        $cumul = 0;
                    } else {
                        $cumul = $frame[$i];
                    }
                } else {
                    $cumul = $frame[$i];
                }
            
                // Miss 
                if ($frame[$i] == '-') $cumul = 0;

                // Spare
                if ($frame[$i] == '/') {
                    // frame courant égal 10
                    $cumul  = 10 - $frame[$i-1];   
                    // double la valeur du premier lancer après spare
                    if ($i+1<strlen($frame)) {
                        $cumul += $frame[$i+1]*2;  
                    }                   
                }
                
                // Strike
                if ($frame[$i] == 'X') $cumul = 10;                        
                $result += $cumul;
            }
            return $result;
        }

    }
    
?>
