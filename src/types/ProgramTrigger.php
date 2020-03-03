<?php
namespace devskyfly\mgp\types;

use JMS\Serializer\Annotation\Type;

class ProgramTrigger extends AbstractType
{
    const CONTENT_TYPE = 'ProgramTrigger';
    
    /**
     *
     * @Type("string")
     */
    public $name;

    /**
     *
     * @Type("boolean")
     */
    public $enabled;

    
    //@Type("string")
    //public $reasons;

    public function __construct()
    {
        $this->contentType = static::CONTENT_TYPE;
    }
}