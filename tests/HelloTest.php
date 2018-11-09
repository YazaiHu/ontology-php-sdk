<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Ontio\Hello;
use Ontio\Common\Common;

class HelloTest extends TestCase {

    public function testHello() {
        Common::generateKey64Bit();
    }

}
