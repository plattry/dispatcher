<?php

declare(strict_types=1);

namespace Plattry\Dispatcher;

use Psr\EventDispatcher\StoppableEventInterface;

/**
 * Class StoppableEvent
 * @package Plattry\Dispatcher
 */
class StoppableEvent extends Event implements StoppableEventInterface
{
    /**
     * @var bool
     */
    protected bool $propagation_stopped = false;

    /**
     * @param bool $propagation_stopped
     * @return void
     */
    public function setPropagationStopped(bool $propagation_stopped): void
    {
        $this->propagation_stopped = $propagation_stopped;
    }

    /**
     * @inheritDoc
     */
    public function isPropagationStopped(): bool
    {
        return $this->propagation_stopped;
    }
}
