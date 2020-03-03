<?php
namespace devskyfly\mgp\types;

use JMS\Serializer\Annotation\Type;

class ContractorCompany extends AbstractContractor
{
    const CONTENT_TYPE = 'ContractorCompany';
    
    /**
     *
     * @Type("string")
     */
    public $name;

     /**
     *
     * @Type("string")
     */
    public $humanNumber;

    public function __construct()
    {
        $this->contentType = static::CONTENT_TYPE;
    }
}