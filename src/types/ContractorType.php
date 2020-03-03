<?php
namespace devskyfly\mgp\types;

use JMS\Serializer\Annotation\Type;

class ContractorType extends AbstractType
{
    const CONTENT_TYPE = 'ContractorType';   

    public function __construct()
    {
        $this->contentType = static::CONTENT_TYPE;
    }
}