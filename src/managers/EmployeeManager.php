<?php
namespace devskyfly\mgp\managers;


use devskyfly\php56\types\Nmbr;
use devskyfly\mgp\types\Employee;
use devskyfly\mgp\response\EmployeeResponse;

class EmployeeManager extends AbstractManager
{
    public function getById($id): EmployeeResponse
    {
        $id = Nmbr::toIntegerStrict($id);
        $url = '/api/v3/employee/';
        $url = $url.$id;
        $result = $this->client->makeGet($url, [], true);
        return $this->serializer->deserialize($result, Employee::class, 'json');
    }
}