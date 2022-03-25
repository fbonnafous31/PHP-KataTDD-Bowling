<?php

    namespace App;

    class Bowling {

        public function roll(string $value): string {
            return $value;
        }

        public function frame_result(string $frame): int {
            $score = 0;
            
            $frame0 = $frame[0];
            if ($frame[0] === '-') $frame0 = 0;
            if ($frame[0] === '/') $frame0 = 10;
            if ($frame[0] === 'X') $frame0 = 10;

            $frame1 = 0;
            if (isset($frame[1])) $frame1 = $frame[1];
            if ((isset($frame[1])) and ($frame[1] === '-')) $frame1 = 0;
            if ((isset($frame[1])) and ($frame[1] === '/')) $frame1 = 10;
            if ((isset($frame[1])) and ($frame[1] === 'X')) $frame1 = 10;

            $frame2 = 0;
            if (isset($frame[2])) $frame2 = $frame[2];
            if ((isset($frame[2])) and ($frame[2] === '-')) $frame2 = 0;
            if ((isset($frame[2])) and ($frame[2] === '/')) $frame2 = 10;
            if ((isset($frame[2])) and ($frame[2] === 'X')) $frame2 = 10;

            if ($frame[0] === 'X') {
                $score = 10 + $frame1 + $frame2;
            } elseif ($frame[1] === '/') {
                $score = 10 + $frame2;
            } else {
                $score += intval($frame0);   
                $score += intval($frame1);   
            }
            return $score;
        }

        public function game_result(): int {
            $frames   = func_get_args();
            $nbframes = func_num_args();
            $result   = 0;
            $i        = 0;

            foreach ($frames as $frame) {

                if (isset($frame[1]) and ($frame[1] === '/')) {
                    if ($i+1<$nbframes) $frame .= $frames[$i+1][0];
                }

                if ($i+2<$nbframes) {
                    if ($frame[0] === 'X') {
                        if ($frames[$i+1][0] === 'X') {
                            $frame .= 'X';
                            $frame .= $frames[$i+2][0];
                        } else {
                            $frame .= $frames[$i+1][0];
                            if (isset($frames[$i+1][1])) $frame .= $frames[$i+1][1];
                        }

                    } 
                }

                if ($frame != 'X') $result += $this->frame_result($frame);
                $i++;
            }

            if ((isset($frames[9][2])) and ($frames[9][2] === 'X')) $result += 20;

            return $result;
        }

    }
    
?>
