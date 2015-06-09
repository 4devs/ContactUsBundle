<?php

namespace FDevs\ContactUsBundle\Event;

final class MessageEvents
{
    /**
     * The CREATE event is dispatched then message create
     *
     * The event listener method receives a FDevs\ContactUsBundle\Event\MessageEvent instance
     *
     * @Event
     *
     * @var string
     */
    const CREATE = 'fdevs_contact_us.message.create';

    /**
     * The SAVE event is dispatched then message save
     *
     * The event listener method receives a FDevs\ContactUsBundle\Event\MessageEvent instance
     *
     * @Event
     *
     * @var string
     */
    const SAVE = 'fdevs_contact_us.message.save';
}
