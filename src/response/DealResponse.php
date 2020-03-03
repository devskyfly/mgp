<?php
namespace devskyfly\mgp\response;

use JMS\Serializer\Annotation\Type;

class DealResponse extends AbstractResponse
{
    /**
     *
     * @Type("devskyfly\mgp\types\Deal")
     */
    public $data;
}