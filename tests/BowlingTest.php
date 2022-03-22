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
            $frame  = $this->bowling->roll('1');
            $frame .= $this->bowling->roll('1');
            assertEquals('11', $frame);
        }

        public function testOneFrameOneMiss() {
            $frame  = $this->bowling->roll('1');
            $frame .= $this->bowling->roll('-');
            assertEquals('1-', $frame);
        }

        public function testOneFrameTwoMiss() {
            $frame  = $this->bowling->roll('-');
            $frame .= $this->bowling->roll('-');
            assertEquals('--', $frame);
        }

        public function testOneFrameWithSpare() {
            $frame  = $this->bowling->roll('1');
            $frame .= $this->bowling->roll('/');
            assertEquals('1/', $frame);
        }

        public function testOneFrameWithStrike() {
            $frame  = $this->bowling->roll('X');
            assertEquals('X', $frame);
        }


        // Teste le résultat de deux lancers
        public function testResultFrame11() {
            $frame  = $this->bowling->roll('1');
            $frame .= $this->bowling->roll('1');
            assertEquals(2, $this->bowling->result($frame));
        }

        public function testResultFrameOneMiss() {
            $frame  = $this->bowling->roll('1');
            $frame .= $this->bowling->roll('-');
            assertEquals(1, $this->bowling->result($frame));
        }

        public function testResultFrameTwoMiss() {
            $frame  = $this->bowling->roll('-');
            $frame .= $this->bowling->roll('-');
            assertEquals(0, $this->bowling->result($frame));
        }

        public function testResultFrameWithSpare() {
            $frame  = $this->bowling->roll('1');
            $frame .= $this->bowling->roll('/');
            assertEquals(10, $this->bowling->result($frame));
        } 

        public function testResultFrameWithStrike() {
            $frame  = $this->bowling->roll('X');
            assertEquals(10, $this->bowling->result($frame));
        }

    }

?>