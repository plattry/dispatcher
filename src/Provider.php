<?php

declare(strict_types=1);

namespace Plattry\Dispatcher;

use Psr\EventDispatcher\ListenerProviderInterface;

/**
 * Class Provider
 * @package Plattry\Dispatcher
 */
class Provider implements ListenerProviderInterface
{
    /**
     * @var \Closure[][]
     */
    protected array $listeners = [];

    /**
     * @param string $eventName
     * @param callable $callable
     * @param int $priority
     * @return void
     * @throws \InvalidArgumentException
     */
    public function addListener(string $eventName, callable $callable, int $priority = 0): void
    {
        !class_exists($eventName) &&
        throw new \InvalidArgumentException("Not found class $eventName");

        $implements = class_implements($eventName);
        $implements === false || !isset($implements[EventInterface::class]) &&
        throw new \InvalidArgumentException("Invalid event $eventName");

        $this->listeners[$eventName][$priority][] = \Closure::fromCallable($callable);

        ksort($this->listeners[$eventName]);
    }

    /**
     * @inheritDoc
     */
    public function getListenersForEvent(object $event): iterable
    {
        return array_reduce(
            $this->listeners[$event::class] ?? [],
            fn($front, $next) => [...$front ?: [], ...$next]
        );
    }
}
