<?php

declare(strict_types=1);

namespace Plattry\Dispatcher;

/**
 * Interface EventHandlerInterface
 * @package Plattry\Dispatcher
 */
interface EventHandlerInterface
{
    /**
     * Get event name
     * @return string
     */
    public function getName(): string;

    /**
     * Get handler priority
     * @return int
     */
    public function getPriority(): int;

    /**
     * Handle the event.
     * @param object $event
     * @return object
     */
    public function handle(object $event): object;
}
