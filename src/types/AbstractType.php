<?php
namespace devskyfly\mgp\types;

use JMS\Serializer\Annotation\Type;

class AbstractType
{
    /**
     *
     * @Type("string")
     */
    public $id;

    /**
     *
     * @Type("string")
     */
    public $contentType;
    
    public function createLink()
    {
        $link = new LinkEntity();
        
        $link->id = $this->id;
        $link->contentType = $this->contentType;
        
        return $link;
    }
    
}