<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Ontio\Hello;

class HelloTest extends TestCase {
    
    public function testHello() {
        $hello = new Hello();
        
        $this->assertTrue($hello instanceof Hello);
    }
    
}