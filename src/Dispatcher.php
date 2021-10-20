<?php

declare(strict_types=1);

namespace Plattry\Dispatcher;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;
use Psr\EventDispatcher\StoppableEventInterface;

/**
 * Class Dispatcher
 * @package Plattry\Dispatcher
 */
class Dispatcher implements EventDispatcherInterface
{
    /**
     * @var ListenerProviderInterface
     */
    protected ListenerProviderInterface $provider;

    /**
     * @param ListenerProviderInterface $provider
     */
    public function __construct(ListenerProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @inheritDoc
     * @throws \LogicException
     */
    public function dispatch(object $event): object
    {
        foreach ($this->provider->getListenersForEvent($event) as $listener) {
            $event = $listener($event);

            !$event instanceof EventInterface &&
            throw new \LogicException("Event callable must return the event that was passed, now modified by callable.");

            if ($event instanceof StoppableEventInterface && $event->isPropagationStopped())
                return $event;
        }

        return $event;
    }
}
