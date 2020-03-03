<?php
namespace devskyfly\mgp\response;

use JMS\Serializer\Annotation\Type;

class CommentResponse extends AbstractResponse
{
    /**
     *
     * @Type("devskyfly\mgp\types\Comment")
     */
    public $data;
}