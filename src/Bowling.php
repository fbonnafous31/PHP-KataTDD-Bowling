<?php

    namespace App;

    class Bowling {

        public function roll(string $value): string {
            return $value;
        }

        public function frame_result(string $frame): int {
            $score = 0;            
            $ball1 = $this->load_value($frame[0]);
            if (isset($frame[1])) $ball2 = $this->load_value($frame[1]);
            if (isset($frame[2])) $ball3 = $this->load_value($frame[2]);

            if ($frame[0] === 'X') {
                if ($frame[2] === '/') $score = 10 + $ball2 + ($ball3 - $ball2);
                else $score = 10 + $ball2 + $ball3;
            } elseif ($frame[1] === '/') {
                $score = 10 + $ball3;
            } else {
                $score += $ball1;   
                $score += $ball2;   
            }
            return $score;
        }

        public function game_result(): int {
            $frames   = func_get_args();
            $nbframes = func_num_args();
            $result   = 0;
            $i        = 0;

            foreach ($frames as $frame) {
                // spare
                if (isset($frame[1]) and ($frame[1] === '/')) {
                    if ($i+1<$nbframes) $frame .= $frames[$i+1][0];
                }

                // strike
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

            // extra ball
            if ((isset($frames[9][2])) and ($frames[9][2] === 'X')) $result += 20;

            return $result;
        }

        private function load_value (string $value): int {
            $new_value = $value;
            if ($value === '-') $new_value = 0;
            if ($value === '/') $new_value = 10;
            if ($value === 'X') $new_value = 10;

            return $new_value;
        }

    }
    
?>
