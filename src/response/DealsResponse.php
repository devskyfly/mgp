<?php
namespace devskyfly\mgp\response;

use JMS\Serializer\Annotation\Type;

class DealsResponse extends AbstractResponse
{
    /**
     *
     * @Type("array<devskyfly\mgp\types\Deal>")
     */
    public $data;
}