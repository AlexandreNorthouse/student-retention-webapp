<?php
    declare(strict_types=1);
    //require_once();

    use PHPUnit\Framework\TestCase;


    class DefaultMethodsTest extends TestCase
    {

        public function testGenerateReturnArray()
        {
            $this->assertEquals(0, 0, "They're the same!");
        }

        public function testFormatFields()
        {
            $this->assertNotEquals(0, 0, "They're not the same!");
        }
    }
?>