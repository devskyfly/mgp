<?php
namespace devskyfly\mgp\serialize;

use JMS\Serializer\Metadata\PropertyMetadata;
use JMS\Serializer\Naming\PropertyNamingStrategyInterface;
use yii\helpers\BaseConsole;

class CamelCaseNamingStrategy implements PropertyNamingStrategyInterface
{
    public function translateName(PropertyMetadata $metadata): string
    {
        return $metadata->name;
    }
}