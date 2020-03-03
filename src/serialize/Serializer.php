<?php
namespace devskyfly\mgp\serialize;

use JMS\Serializer\EventDispatcher\EventDispatcher;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;

class Serializer
{
    public static $instance;
    
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance =  SerializerBuilder::create()
                ->configureListeners(function(EventDispatcher $dispatcher){
                    $dispatcher->addSubscriber(new DesirializeEventSubscriber());
                    $dispatcher->addSubscriber(new SerializeEventSubscriber());
                })
                /*->setSerializationContextFactory(function () {
                    return SerializationContext::create()->setSerializeNull(true);
                })*/
                ->setPropertyNamingStrategy(new SerializedNameAnnotationStrategy(new CamelCaseNamingStrategy()))
                ->build();
        }
        return static::$instance;
    }
}