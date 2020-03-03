<?php
namespace devskyfly\mgp\types;

use JMS\Serializer\Annotation\Type;

class ContractorHuman extends AbstractContractor
{
    const CONTENT_TYPE = 'ContractorHuman';

    /**
     *
     * @Type("string")
     */
    public $firstName;
    
    /**
     *
     * @Type("string")
     */
    public $middleName;

    /**
     *
     * @Type("string")
     */
    public $lastName;

    public function __construct()
    {
        $this->contentType = static::CONTENT_TYPE;
    }
}