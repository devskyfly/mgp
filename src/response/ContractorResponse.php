<?php
namespace devskyfly\mgp\response;

use JMS\Serializer\Annotation\Type;

class ContractorResponse extends AbstractResponse
{
    /**
     *
     * @Type("devskyfly\mgp\types\AbstractContractor")
     */
    public $data;
}