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
                if ($frame[$i] == '-') $cumul = 0;
                if ($frame[$i] == '/') $cumul = 10 - $frame[$i-1];                        
                if ($frame[$i] == 'X') $cumul = 10;                        
                $result += $cumul;
            }
            return $result;
        }

    }
    
?>
