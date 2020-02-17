<?php
    declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Default_Mehtods.php");

    use PHPUnit\Framework\TestCase;


    class DefaultMethodsTest extends TestCase
    {

        public function testFormatFields()
        {
            $testArray = array(
                "Test" => "   test   "
            );

            $correctArray = array(
                "Test" => "test"
            );
            $this->assertEquals(defaultMethods::formatFields($testArray), $correctArray, "They're the same!");
        }

        public function testGenerateReturnArray()
        {
            
            $this->assertNotEquals(0, 0, "They're not the same!");
        }
    }
?>