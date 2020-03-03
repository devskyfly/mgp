<?php
namespace devskyfly\mgp\response;

use JMS\Serializer\Annotation\Type;

class Meta
{
    /**
     *
     * @Type("int")
     */
    public $status;

    /**
     *
     * @Type("array")
     */
    public $errors;

    /**
     *
     * @Type("devskyfly\mgp\response\Pagination")
     */
    public $pagination;
}