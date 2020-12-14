<?php

    use PHPUnit\Framework\TestCase;

    class DatabaseTest extends TestCase{
        public function testDBConnectionn(){
            require('includes/database.php');

            $this->assertEquals(FALSE, $query->connect());
        }
    }


?>