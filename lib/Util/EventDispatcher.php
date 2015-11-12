<?php

namespace Stripe\Util;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class EventDispatcher
{
    const EVENT_PRE_REQUEST     = 'stripe.pre_request';
    const EVENT_POST_REQUEST    = 'stripe.post_request';

    /**
     * @var EventDispatcherInterface
     */
    private static $eventDispatcher;

    /**
     * @param EventDispatcherInterface $eventDispatcher
     */
    public static function setEventDispatcher(EventDispatcherInterface $eventDispatcher)
    {
        static::$eventDispatcher = $eventDispatcher;
    }

    /**
     * @param string $name
     * @param string|array|Event $event
     */
    public static function dispatchEvent($name, $event)
    {
        if (null === static::$eventDispatcher) {
            return;
        }

        if (!$event instanceof Event) {
            $event = new GenericEvent($event);
        }

        static::$eventDispatcher->dispatch($name, $event);
    }
}
