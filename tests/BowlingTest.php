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
            assertEquals(2, $this->bowling->result($roll));
        }

        public function testResultFrameOneMiss() {
            $roll  = $this->bowling->roll('1');
            $roll .= $this->bowling->roll('-');
            assertEquals(1, $this->bowling->result($roll));
        }

        public function testResultFrameTwoMiss() {
            $roll  = $this->bowling->roll('-');
            $roll .= $this->bowling->roll('-');
            assertEquals(0, $this->bowling->result($roll));
        }

        public function testResultFrameWithSpare() {
            $roll  = $this->bowling->roll('1');
            $roll .= $this->bowling->roll('/');
            assertEquals(10, $this->bowling->result($roll));
        } 

        public function testResultFrameWithStrike() {
            $roll  = $this->bowling->roll('X');
            assertEquals(10, $this->bowling->result($roll));
        }


        // Teste le résultat de plusieurs frame (2 lancers)
        public function testResultFrame1111() {
            $roll  = $this->bowling->roll('1');
            $roll .= $this->bowling->roll('1');
            $roll .= $this->bowling->roll('1');
            $roll .= $this->bowling->roll('1');
            assertEquals(4, $this->bowling->result($roll));
        }

        public function testResultFramesWithSpare() {
            $roll  = $this->bowling->roll('1');
            $roll .= $this->bowling->roll('/');
            $roll .= $this->bowling->roll('1');
            $roll .= $this->bowling->roll('1');
            assertEquals(13, $this->bowling->result($roll));
        } 

    }

?>