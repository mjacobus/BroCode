<?php

namespace BroTest\Code;

use Bro\Code\CsFixerFactory;
use PHPUnit_Framework_TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\CS\Console\Application;

class CsFixerFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var CsFixerFactory
     */
    protected $object;

    /**
     * @before
     */
    public function initialize()
    {
        $this->object = new CsFixerFactory();
    }

    /**
     * @test
     */
    public function createRetrunsAnConsoleApplication()
    {
        $product = $this->object->create([
            'binFilePath' => __FILE__,
            'preset'      => 'bro',
        ]);

        $this->assertInstanceOf('Symfony\CS\Console\Application', $product);
    }
}
