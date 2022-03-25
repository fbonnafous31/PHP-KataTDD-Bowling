<?php

    namespace App;

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

    class BowlingTest extends TestCase {

        protected function setUp(): void {
            $this->bowling = new Bowling();
        }

        // Teste les lancers des boules de bowling
        public function testOneFrameEqual11() {
            $roll  = $this->bowling->roll('1');
            $roll .= $this->bowling->roll('1');
            assertEquals('11', $roll);
        }

        public function testOneFrameOneMiss() {
            $roll  = $this->bowling->roll('1');
            $roll .= $this->bowling->roll('-');
            assertEquals('1-', $roll);
        }

        public function testOneFrameTwoMiss() {
            $roll  = $this->bowling->roll('-');
            $roll .= $this->bowling->roll('-');
            assertEquals('--', $roll);
        }

        public function testOneFrameWithSpare() {
            $roll  = $this->bowling->roll('1');
            $roll .= $this->bowling->roll('/');
            assertEquals('1/', $roll);
        }

        public function testOneFrameWithStrike() {
            $roll  = $this->bowling->roll('X');
            assertEquals('X', $roll);
        }

        // Teste le résultat d'un frame (2 lancers)
        public function testResultFrame11() {
            $roll  = $this->bowling->roll('1');
            $roll .= $this->bowling->roll('1');
            assertEquals(2, $this->bowling->frame_result($roll));
        }

        public function testResultFrameOneMiss() {
            $roll  = $this->bowling->roll('1');
            $roll .= $this->bowling->roll('-');
            assertEquals(1, $this->bowling->frame_result($roll));
        }

        public function testResultFrameTwoMiss() {
            $roll  = $this->bowling->roll('-');
            $roll .= $this->bowling->roll('-');
            assertEquals(0, $this->bowling->frame_result($roll));
        }

        public function testResultFramesWithSpare() {
            $roll  = $this->bowling->roll('1');
            $roll .= $this->bowling->roll('/');
            $roll .= $this->bowling->roll('4');
            assertEquals(14, $this->bowling->frame_result($roll));
        } 

        public function testResultFramesWithStrike() {
            $roll  = $this->bowling->roll('X');
            $roll .= $this->bowling->roll('8');
            $roll .= $this->bowling->roll('1');
            assertEquals(19, $this->bowling->frame_result($roll));
        } 

        // Test de plusieurs frame
        public function testResultTwoFrames1111() {
            $frame1  = $this->bowling->roll('1');
            $frame1 .= $this->bowling->roll('1');
            $frame2  = $this->bowling->roll('1');
            $frame2 .= $this->bowling->roll('1');
            assertEquals(4, $this->bowling->game_result($frame1, $frame2));
        }

        public function testResultFrameWithOneSpare() {
            $ball  = $this->bowling->roll('2');
            $ball .= $this->bowling->roll('/');
            $ball .= $this->bowling->roll('4');
            assertEquals(14, $this->bowling->frame_result($ball));
        } 

        public function testResultFrameWithOneStrike() {
            $ball  = $this->bowling->roll('X');
            $ball .= $this->bowling->roll('7');
            $ball .= $this->bowling->roll('2');
            assertEquals(19, $this->bowling->frame_result($ball));
        } 

        public function testResultFrameWithTwoStrike() {
            $ball  = $this->bowling->roll('X');
            $ball .= $this->bowling->roll('X');
            $ball .= $this->bowling->roll('2');
            assertEquals(22, $this->bowling->frame_result($ball));
        } 

        public function testResultFrameWithThreeStrike() {
            $ball  = $this->bowling->roll('X');
            $ball .= $this->bowling->roll('X');
            $ball .= $this->bowling->roll('X');
            assertEquals(30, $this->bowling->frame_result($ball));
        } 

        public function testResultFramesWithTwoSpare() {
            $frame1  = $this->bowling->roll('5');
            $frame1 .= $this->bowling->roll('/');
            $frame2  = $this->bowling->roll('5');
            $frame2 .= $this->bowling->roll('/');
            $frame2 .= $this->bowling->roll('5');
            assertEquals(30, $this->bowling->game_result($frame1, $frame2));
        } 
        
        public function testResultFramesWithThreeStrike() {
            $frame1 = $this->bowling->roll('X');
            $frame2 = $this->bowling->roll('X');
            $frame3 = $this->bowling->roll('X');
            assertEquals(30, $this->bowling->game_result($frame1, $frame2, $frame3));
        } 

        // 9- 9- 9- 9- 9- 9- 9- 9- 9- 9- (20 rolls: 10 pairs of 9 and miss) = 10 frames * 9 points = 90
        public function testResultFor10PairsOf9andMiss() {
            $frame1   = $this->bowling->roll('9');
            $frame1  .= $this->bowling->roll('-');
            $frame2   = $this->bowling->roll('9');
            $frame2  .= $this->bowling->roll('-');
            $frame3   = $this->bowling->roll('9');
            $frame3  .= $this->bowling->roll('-');
            $frame4   = $this->bowling->roll('9');
            $frame4  .= $this->bowling->roll('-');
            $frame5   = $this->bowling->roll('9');
            $frame5  .= $this->bowling->roll('-');
            $frame6   = $this->bowling->roll('9');
            $frame6  .= $this->bowling->roll('-');
            $frame7   = $this->bowling->roll('9');
            $frame7  .= $this->bowling->roll('-');
            $frame8   = $this->bowling->roll('9');
            $frame8  .= $this->bowling->roll('-');
            $frame9   = $this->bowling->roll('9');
            $frame9  .= $this->bowling->roll('-');
            $frame10  = $this->bowling->roll('9');
            $frame10 .= $this->bowling->roll('-');

            assertEquals('90', $this->bowling->game_result($frame1, $frame2, $frame3, $frame4, $frame5, $frame6, $frame7, $frame8, $frame9, $frame10));
        }

        // 5/ 5/ 5/ 5/ 5/ 5/ 5/ 5/ 5/ 5/5 (21 rolls: 10 pairs of 5 and spare, with a final 5) = 10 frames * 15 points = 150       
        public function testResultFor10PairsOf5andSpare() {
            $frame1  = $this->bowling->roll('5');
            $frame1 .= $this->bowling->roll('/');
            $frame2  = $this->bowling->roll('5');
            $frame2 .= $this->bowling->roll('/');
            $frame3  = $this->bowling->roll('5');
            $frame3 .= $this->bowling->roll('/');
            $frame4  = $this->bowling->roll('5');
            $frame4 .= $this->bowling->roll('/');
            $frame5  = $this->bowling->roll('5');
            $frame5 .= $this->bowling->roll('/');
            $frame6  = $this->bowling->roll('5');
            $frame6 .= $this->bowling->roll('/');
            $frame7  = $this->bowling->roll('5');
            $frame7 .= $this->bowling->roll('/');
            $frame8  = $this->bowling->roll('5');
            $frame8 .= $this->bowling->roll('/');
            $frame9  = $this->bowling->roll('5');
            $frame9 .= $this->bowling->roll('/');
            $frame10  = $this->bowling->roll('5');
            $frame10 .= $this->bowling->roll('/');
            $frame10 .= $this->bowling->roll('5');
            assertEquals('150', $this->bowling->game_result($frame1, $frame2, $frame3, $frame4, $frame5, $frame6, $frame7, $frame8, $frame9, $frame10));
        }

        // X X X X X X X X X X X X (12 rolls: 12 strikes) = 10 frames * 30 points = 300
        public function testResultFor10Strike() {
            $frame1   = $this->bowling->roll('X');
            $frame2   = $this->bowling->roll('X');
            $frame3   = $this->bowling->roll('X');
            $frame4   = $this->bowling->roll('X');
            $frame5   = $this->bowling->roll('X');
            $frame6   = $this->bowling->roll('X');
            $frame7   = $this->bowling->roll('X');
            $frame8   = $this->bowling->roll('X');
            $frame9   = $this->bowling->roll('X');
            $frame10  = $this->bowling->roll('X');
            $frame11  = $this->bowling->roll('X');
            $frame12  = $this->bowling->roll('X');
            assertEquals('300', $this->bowling->game_result($frame1, $frame2, $frame3, $frame4, $frame5, $frame6, $frame7, $frame8, $frame9, $frame10, $frame11, $frame12));
        }

        // Exemple de résultat de partie
        // https://bcc85.fr/calcul-du-score/
        public function testGame1() {
            $frame1   = $this->bowling->roll('1');
            $frame1  .= $this->bowling->roll('2');
            $frame2   = $this->bowling->roll('X');
            $frame3   = $this->bowling->roll('0');
            $frame3  .= $this->bowling->roll('/');
            $frame4   = $this->bowling->roll('4');
            $frame4  .= $this->bowling->roll('2');
            $frame5   = $this->bowling->roll('0');
            $frame5  .= $this->bowling->roll('/');
            $frame6   = $this->bowling->roll('6');
            $frame6  .= $this->bowling->roll('2');
            $frame7   = $this->bowling->roll('0');
            $frame7  .= $this->bowling->roll('/');
            $frame8   = $this->bowling->roll('6');
            $frame8  .= $this->bowling->roll('/');
            $frame9   = $this->bowling->roll('8');
            $frame9  .= $this->bowling->roll('/');
            $frame10  = $this->bowling->roll('2');
            $frame10 .= $this->bowling->roll('/');
            $frame10 .= $this->bowling->roll('8');
        assertEquals(131, $this->bowling->game_result($frame1, $frame2, $frame3, $frame4, $frame5, $frame6, $frame7, $frame8, $frame9, $frame10));
        }

        public function testGame2() {
            $frame1   = $this->bowling->roll('-');
            $frame1  .= $this->bowling->roll('/');
            $frame2   = $this->bowling->roll('1');
            $frame2  .= $this->bowling->roll('7');
            $frame3   = $this->bowling->roll('0');
            $frame3  .= $this->bowling->roll('/');
            $frame4   = $this->bowling->roll('0');
            $frame4  .= $this->bowling->roll('2');
            $frame5   = $this->bowling->roll('0');
            $frame5  .= $this->bowling->roll('/');
            $frame6   = $this->bowling->roll('6');
            $frame6  .= $this->bowling->roll('0');
            $frame7   = $this->bowling->roll('X');
            $frame8   = $this->bowling->roll('0');
            $frame8  .= $this->bowling->roll('/');
            $frame9   = $this->bowling->roll('6');
            $frame9  .= $this->bowling->roll('2');
            $frame10  = $this->bowling->roll('0');
            $frame10 .= $this->bowling->roll('/');
            $frame10 .= $this->bowling->roll('2');
            assertEquals(109, $this->bowling->game_result($frame1, $frame2, $frame3, $frame4, $frame5, $frame6, $frame7, $frame8, $frame9, $frame10));
        }

    }

?>