<?php

    namespace App;

    class Bowling {

        public function roll(string $value): string {
            return $value;
        }

        public function frame_result(string $frame): int {
            $result    = 0;
            for ($i=0; $i<strlen($frame); $i++) {  
                $next1     = 0;
                $next2     = 0;    
                // previous ball    
                if ($i > 0) {
                    $previous = $frame[$i-1];
                    if ($previous == '-') $previous = 0;
                }

                // next balls
                if ($i+1 < strlen($frame)) $next1 = $frame[$i+1];
                if (isset($next1) and ($next1 === '-')) $next1 = 0;
                if (isset($next1) and ($next1 === 'X')) $next1 = 10;
                if ($i+2 < strlen($frame)) $next2 = intval($frame[$i+2]);
                if (isset($next2)) {
                   if ($next2 == '-') $next2 = 0;
                   if ($next2 == '/') $next2 = 10;
                } 

                // current ball
                if (($frame[$i] != '/') or ($frame[$i] != '/') or ($frame[$i] != '/')) {
                    $score = intval($frame[$i]);   
                }
                
                // exception ball
                if ($frame[$i] === '-') $score = 0; 
                if ($frame[$i] === '/') $score = 10;
                if ($frame[$i] === 'X') $score = 10;

                // spare (/)
                if ($frame[$i] == '/') {
                    $score -= $previous;

                    // exception last ball
                    if ($i+2 >= strlen($frame)) $score += 0;
                    else $score += $next1;
                }

                // strike (X)
                if ($frame[$i] == 'X') {
                    if ((isset($previous)) and ($previous = 'X')) $score += 10; 
                    $score += $next1 + $next2;
                }  

                $result += $score;

                if ($frame[$i] == 'X') return $result; 
            }
            return $result;
        }

        public function game_result(): int {
            $frames   = func_get_args();
            $nbframes = func_num_args();
            $result   = 0;
            $i        = 0;

            foreach ($frames as $frame) {

                if (isset($frame[1]) and ($frame[1] == '/')) {
                    if ($i+1<$nbframes) $frame .= $frames[$i+1][0];
                }

                if ($frame[0] == 'X') {
                    if ($i+1<$nbframes) {
                        if ($frames[$i+1][0] == 'X') {
                            $frame .= 'X';
                            if (isset($frames[$i+2][0]) and ($frames[$i+2][0]) == 'X') $frame .= 'X';
                            else {
                                if (isset($frames[$i+2][0])) $frame .= $frames[$i+2][0];
                            }     
                        }
                        else {
                            $frame .= $frames[$i+1][0];
                            $frame .= $frames[$i+1][1];
                        } 
                    } 
                }

                if (($frame === 'XXX') and ($i+3 >= $nbframes)) $result -=20;
                if (substr($frame, 0, 2)=='XX') {
                    if (strlen($frame)==3) {
                        $result += $this->frame_result($frame);
                    }
                } else $result += $this->frame_result($frame);
                $i++;
            }

            return $result;
        }

    }
    
?>
