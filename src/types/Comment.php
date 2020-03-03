<?php
namespace devskyfly\mgp\types;

use JMS\Serializer\Annotation\Type;

class Comment extends AbstractType
{
    const CONTENT_TYPE = 'Comment';

    /**
     *
     * @Type("string")
     */
    public $content;

    /**
     *
     * @Type("devskyfly\mgp\types\Deal")
     */
    public $subject;

    public function __construct()
    {
        $this->contentType = static::CONTENT_TYPE;
    }
}