<?php
namespace devskyfly\mgp\types;

use JMS\Serializer\Annotation\Type;

class Program extends AbstractType
{
    const CONTENT_TYPE = 'Program';
    
    /**
     *
     * @Type("string")
     */
    public $name;

    /**
     *
     * @Type("int")
     */
    public $statesCount;

    /**
     *
     * @Type("array")
     */
    public $states;

    public function __construct()
    {
        $this->contentType = static::CONTENT_TYPE;
    }
}