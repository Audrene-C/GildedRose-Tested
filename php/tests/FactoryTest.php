<?php

declare(strict_types=1);

namespace Tests;

use App\Updater\IUpdater;
use PHPUnit\Framework\TestCase;
use App\UpdaterFactory;
use App\InterfaceItem;

class FactoryTest extends TestCase
{
    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testFactoryBuild(): void
    {
        // $item = new Item('Aged Brie', 1, 1);
        // $registry = new UpdaterFactoryRegistry();
        // $registry->register(AgedBrieUpdater::class);
        // //overrider newClass pour qu'il retourne ce qu'on veut
        // $factory = new UpdaterFactory($registry);
        // $this->assertInstanceOf(AgedBrieUpdater::class, $factory->build($item));

        $interfaceItem = $this->getMockBuilder(InterfaceItem::class)->getMock();
        $iUpdater = $this->getMockBuilder(IUpdater::class)->getMock();
        
        $iUpdaterFactoryRegistry = \Mockery::mock('alias:App\IUpdaterFactoryRegistry');

        // $iUpdaterFactoryRegistry->shouldReceive('newClass')
        //                         ->andReturn($iUpdater);

        $iUpdaterFactoryRegistry->shouldReceive('resolve')
                                ->andReturn(get_class($iUpdater));

        $factory = new UpdaterFactory($iUpdaterFactoryRegistry);
        $newUpdater = $factory->build($interfaceItem);
        $this->assertSame(get_class($iUpdater), get_class($newUpdater));
    }
}
