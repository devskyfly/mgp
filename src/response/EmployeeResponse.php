<?php
namespace devskyfly\mgp\response;

use JMS\Serializer\Annotation\Type;

class EmployeeResponse extends AbstractResponse
{
    /**
     *
     * @Type("array<devskyfly\mgp\types\Employee>")
     */
    public $data;
}