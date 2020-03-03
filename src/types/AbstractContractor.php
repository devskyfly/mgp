<?php
namespace devskyfly\mgp\types;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;


abstract class AbstractContractor extends AbstractType
{
    /**
     * 
     * @SerializedName("Category183CustomFieldInn")
     * @Type("string")
     */
    public $inn;
    
    /**
     *
     * @SerializedName("Category183CustomFieldKpp")
     * @Type("string")
     */
    public $kpp;

     /**
     * 
     * @Type("devskyfly\mgp\types\ContractorType")
     */
     public $type;
    
    // @Type("array")
    //public $responsible
    
    /**
     * 
     * @Type("array<devskyfly\mgp\types\ContactInfo>")
     */
    public $contactInfo;

    /**
     * 
     * @Type("boolean")
     */
    public $isPublic = false;

    /**
     * @Type("string")
     */
    public $description = "";

    /**
     *
     * @Type ("array")
     */
    public $attaches = [];

    /**
     *
     * @Type ("array")
     */
    public $responsibles = [];

}