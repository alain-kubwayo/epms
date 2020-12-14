<?php

    use PHPUnit\Framework\TestCase;
    require  'includes/action.php';

    class ActionTest extends TestCase{
        public function testViewMethod(){
            

            $crudObject = new CrudOperation();

            $this->assertEquals([], $crudObject->viewMethod("Employee"), "it kinda failed");
        }
        public function test(){
            $expected = "my name";
            $actual = "My House";
            $message = "it is not working";
            $this->assertEquals($expected, $actual, $message);
        }
    }


?>