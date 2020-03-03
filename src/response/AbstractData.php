<?php
namespace devskyfly\mgp\response;

use JMS\Serializer\Annotation\Type;


abstract class AbstractData
{
    /**
     *
     * @Type("devskyfly\mgp\response\Meta")
     */
    public $meta;

    public $data;
}