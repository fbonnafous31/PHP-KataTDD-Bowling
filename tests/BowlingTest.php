<?php

    namespace App;

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

    class BowlingTest extends TestCase {

        protected function setUp(): void {
            $this->bowling = new Bowling();
        }

        // Teste les lancées des boules de bowling
        public function testOneFrameEqual11() {
            $result  = $this->bowling->roll('1');
            $result .= $this->bowling->roll('1');
            assertEquals('11', $result);
        }

        public function testOneFrameOneMiss() {
            $result  = $this->bowling->roll('1');
            $result .= $this->bowling->roll('-');
            assertEquals('1-', $result);
        }

        public function testOneFrameTwoMiss() {
            $result  = $this->bowling->roll('-');
            $result .= $this->bowling->roll('-');
            assertEquals('--', $result);
        }

        public function testOneFrameWithSpare() {
            $result  = $this->bowling->roll('1');
            $result .= $this->bowling->roll('/');
            assertEquals('1/', $result);
        }

        public function testOneFrameWithStrike() {
            $result  = $this->bowling->roll('X');
            assertEquals('X', $result);
        }

    }

?>