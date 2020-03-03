<?php
namespace devskyfly\mgp\response;

use JMS\Serializer\Annotation\Type;


abstract class AbstractResponse
{
    /**
     *
     * @Type("devskyfly\mgp\response\Meta")
     */
    public $meta;

    /**
     *
     * @Type("devskyfly\mgp\response\Pagination")
     */
    public $pagination;

    /**
     *
     * @Type("devskyfly\mgp\response\AbstractData")
     */
    public $data;
}