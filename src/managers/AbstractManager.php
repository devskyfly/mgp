<?php
namespace devskyfly\mgp\managers;

use devskyfly\mgp\Client;
use devskyfly\mgp\MgpException;
use devskyfly\php56\types\Obj;
use JMS\Serializer\Serializer;
use yii\base\BaseObject;

class AbstractManager extends BaseObject
{
    public $client;

    public $serializer;
    
    public function init()
    {
        if (!Obj::isA($this->client, Client::class)) {
            throw new MgpException('Property client is not '.Client::class.' type.');
        }

        if (!Obj::isA($this->serializer, Serializer::class)) {
            throw new MgpException('Property serializer is not '.Serializer::class.' type.');
        }
    }
}