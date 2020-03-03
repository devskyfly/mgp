<?php
namespace devskyfly\mgp\response;

use JMS\Serializer\Annotation\Type;

class Pagination
{
    /**
     *
     * @Type("int")
     */
    public $count;

    /**
     *
     * @Type("int")
     */
    public $limit;
}