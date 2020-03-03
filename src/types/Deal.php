<?php
namespace devskyfly\mgp\types;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class Deal extends AbstractType
{
    const CONTENT_TYPE = 'Deal';

    /**
     *
     * @Type("string")
     */
    public $number;

    
    /**
     *
     * @Type("devskyfly\mgp\types\LinkEntity")
     */
    public $contractor;

    /**
     * 
     * @Type("devskyfly\mgp\types\LinkEntity")
     */
    public $manager;
    
    /**
     *
     * @Type("string")
     */
    public $description;

    /**
     *
     * @Type("string")
     */
    public $shortDescription;

    /**
     *
     * @Type("devskyfly\mgp\types\LinkEntity")
     */
    public $program;
    
    /**
     * 
     * @Type("devskyfly\mgp\types\LinkEntity")
     */
    public $state;
    
    /**
     *
     * @SerializedName("Category1000050CustomFieldHukprostavitotvetstvennogonakliente")
     * @Type("bool")
     */
    public $hookProstavitOtvetstvennogoNaKliente;

    public function __construct()
    {
        $this->contentType = static::CONTENT_TYPE;
    }
}