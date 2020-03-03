<?php
namespace devskyfly\mgp\types;

use JMS\Serializer\Annotation\Type;

class Employee extends AbstractType
{
    const CONTENT_TYPE = 'Employee';
    
    /**
     *
     * @Type("string")
     */
    public $firstName;

   /**
     *
     * @Type("string")
     */
    public $lastName;

    /**
     *
     * @Type("string")
     */
    public $middleName;

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