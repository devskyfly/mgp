<?php
namespace devskyfly\mgp\types;

use JMS\Serializer\Annotation\Type;

class ProgramState extends AbstractType
{
    const CONTENT_TYPE = 'ProgramState';
    
    /**
     *
     * @Type("string")
     */
    public $name;


    public function __construct()
    {
        $this->contentType = static::CONTENT_TYPE;
    }
}