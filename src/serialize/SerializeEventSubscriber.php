<?php
namespace devskyfly\mgp\serialize;

use devskyfly\mgp\types\LinkEntity;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\PreSerializeEvent;
use yii\helpers\BaseConsole;


class SerializeEventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            array(
                'event' => 'serializer.pre_serialize',
                'method' => 'onPreSerializeAbstractContractor',
                'class' => 'devskyfly\\mgp\\types\\AbstractContractor', // if no class, subscribe to every serialization
                'format' => 'json', // optional format
                'priority' => 0, // optional priority
            ),
        );
    }

    public function onPreSerializeAbstractContractor(PreSerializeEvent $event)
    {
        $object = $event->getObject();
        if (LinkEntity::class == get_class($object)) {
            $event->setType(LinkEntity::class);
        }
    }
}

