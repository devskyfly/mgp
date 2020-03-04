<?php
namespace devskyfly\mgp\types;

use JMS\Serializer\Annotation\Type;

class ContactInfo
{
    const TYPE_EMAIL = 'email';
    const TYPE_JABBER = 'jabber';
    const TYPE_ICQ = 'icq';
    const TYPE_SKYPE = 'skype';
    const TYPE_LINK = 'link';
    const TYPE_PHONE = 'phone';
    const TYPE_TELEGRAM = 'telegram';
    const TYPE_WHATSAPP = 'whatsapp';
    const TYPE_VIBER = 'viber';
    
    const CONTENT_TYPE = 'ContactInfo';
    
    /**
     *
     * @Type("string")
     */
    public $type;

    /**
     *
     * @Type("string")
     */
    public $value;

    
    //@Type("string")
    //public $comment;

    //@Type("boolean")
    //public $isMain;

    /*public $subject;*/

    public function __construct()
    {
        $this->contentType = static::CONTENT_TYPE;
    }
}