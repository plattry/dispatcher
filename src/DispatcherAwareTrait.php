<?php

declare(strict_types=1);

namespace Plattry\Dispatcher;

use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * Trait DispatcherAwareTrait
 * @package Plattry\Dispatcher
 */
trait DispatcherAwareTrait
{
    /**
     * Event dispatcher
     * @var EventDispatcherInterface|null
     */
    protected EventDispatcherInterface|null $dispatcher = null;

    /**
     * Set event dispatcher with listeners provider to class.
     * @param EventDispatcherInterface|null $dispatcher
     * @return void
     */
    public function setDispatcher(EventDispatcherInterface|null $dispatcher): void
    {
        $this->dispatcher = $dispatcher;
    }
}
