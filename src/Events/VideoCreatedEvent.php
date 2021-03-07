<?php

namespace App\Events;

use Symfony\Component\EventDispatcher\GenericEvent;

class VideoCreatedEvent extends GenericEvent {

    public function __construct($video)
    {
        $this->video = $video;
    }
}
