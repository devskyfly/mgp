<?php
namespace devskyfly\mgp\response;

use JMS\Serializer\Annotation\Type;

class BooleanResponse extends AbstractResponse
{
    /**
     *
     * @Type("boolean")
     */
    public $data;
}