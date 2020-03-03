<?php
namespace devskyfly\mgp\response;

use JMS\Serializer\Annotation\Type;

class ContractorsResponse extends AbstractResponse
{
    /**
     *
     * @Type("array<devskyfly\mgp\types\AbstractContractor>")
     */
    public $data;
}