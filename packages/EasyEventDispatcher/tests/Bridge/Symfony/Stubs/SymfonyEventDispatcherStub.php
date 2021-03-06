<?php

declare(strict_types=1);

namespace EonX\EasyEventDispatcher\Tests\Bridge\Symfony\Stubs;

use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

final class SymfonyEventDispatcherStub implements EventDispatcherInterface
{
    /**
     * @var object[]
     */
    private $dispatched = [];

    /**
     * @param object $event The event to pass to the event handlers/listeners
     *
     * @return object The passed $event MUST be returned
     */
    public function dispatch($event)
    {
        $this->dispatched[] = $event;

        return $event;
    }

    /**
     * @return object[]
     */
    public function getDispatchedEvents(): array
    {
        return $this->dispatched;
    }
}
