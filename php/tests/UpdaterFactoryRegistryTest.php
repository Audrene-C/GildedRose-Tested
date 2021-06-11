<?php

declare(strict_types=1);

namespace Tests;

use App\InterfaceItem;
use App\UpdaterFactoryRegistry;
use PHPUnit\Framework\TestCase;
use Exception;
use ReflectionObject;

class UpdaterFactoryRegistryTest extends TestCase
{
    public function testUpdaterFactoryRegistryRegister(): void
    {
        $registry = new UpdaterFactoryRegistry();
        $registry->register("coucou");

        $reflector = new ReflectionObject($registry);
        $property = $reflector->getProperty('updaters');
        $property->setAccessible(true);
        $this->assertContains('coucou', $property->getValue($registry));
    }

    public function testUpdaterFactoryRegistryResolve(): void
    {
        $interfaceItem = $this->getMockBuilder(InterfaceItem::class)->getMock();
        $registry = new UpdaterFactoryRegistry();
        $iUpdater = \Mockery::mock('alias:IUpdater');
        $iUpdater->shouldReceive('resolve')
            ->andReturn(true);

        $registry->register(get_class($iUpdater));
        $this->assertEquals('IUpdater', $registry->resolve($interfaceItem));
    }

    public function testUpdaterFactoryRegistryCannotResolveWithoutUpdaters(): void
    {
        $interfaceItem = $this->getMockBuilder(InterfaceItem::class)->getMock();
        $registry = new UpdaterFactoryRegistry();
        $this->expectException(Exception::class);
        $registry->resolve($interfaceItem);
    }
}
