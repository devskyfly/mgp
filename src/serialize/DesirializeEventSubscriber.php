<?php
namespace devskyfly\mgp\serialize;

use devskyfly\mgp\MgpException;
use devskyfly\mgp\types\ContractorCompany;
use devskyfly\mgp\types\ContractorHuman;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\PreDeserializeEvent;
use yii\helpers\BaseConsole;

class DesirializeEventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            array(
                'event' => 'serializer.pre_deserialize',
                'method' => 'onPreDeserializeAbstractContractor',
                'class' => 'devskyfly\\mgp\\types\\AbstractContractor', // if no class, subscribe to every serialization
                'format' => 'json', // optional format
                'priority' => 0, // optional priority
            ),
        );
    }

    public function onPreDeserializeAbstractContractor(PreDeserializeEvent $event)
    {
        $data = $event->getData();
        $contentType = $data['contentType'];

        if (ContractorCompany::CONTENT_TYPE == $contentType) {
            $event->setType(ContractorCompany::class);
        } elseif (ContractorHuman::CONTENT_TYPE == $contentType) {
            $event->setType(ContractorHuman::class);
        } else {
            throw new MgpException("There is not '{$contentType}' suggestion.");
        }
    }
    
}

