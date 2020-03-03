<?php
namespace devskyfly\mgp\managers;

use yii\helpers\Json;
use devskyfly\php56\types\Nmbr;
use devskyfly\php56\types\Obj;
use devskyfly\mgp\MgpException;
use devskyfly\mgp\response\BooleanResponse;
use devskyfly\mgp\response\ContractorResponse;
use devskyfly\mgp\response\ContractorsResponse;
use devskyfly\mgp\types\AbstractContractor;
use devskyfly\mgp\types\ContractorCompany;
use devskyfly\mgp\types\ContractorHuman;
use devskyfly\mgp\types\Employee;
use devskyfly\mgp\types\LinkEntity;

class ContractorManager extends AbstractManager
{

    public function create(AbstractContractor $contractor): ContractorResponse
    {
        $client = $this->client;
        $serializer = $this->serializer;
        $result = [];
        if (Obj::isA($contractor, ContractorHuman::class)) {
            $data = $serializer->serialize($contractor, 'json');
            $url = '/api/v3/contractorHuman';
            $result = $client->makePost($url, $data);
        } elseif (Obj::isA($contractor, ContractorCompany::class)) {
            $data = $serializer->serialize($contractor, 'json');
            $url = '/api/v3/contractorCompany';
            $result = $client->makePost($url, $data);
        } else {
            throw new MgpException('Unexpected type of constractor.');
        }

        return $this->serializer->deserialize($result, ContractorResponse::class, 'json');
    }

    public function getByNameAndInn($name, $inn): ContractorsResponse
    {
        $query = [
            "fields" => [
                "name",
                "contactInfo",
                "type"
            ],
            "sortBy" => [
                [
                    "fieldName" => "name",
                    "desc" => true,
                    "contentType" => "SortField"
                ]
            ],
            "filter" => [
                "contentType" => "CrmFilter",
                "id" => null,
                "config" => [
                    "termGroup" => [
                        "join" => "and",
                        "terms" => [
                            [
                                "comparison" => "contains",
                                "value" => $name,
                                "field" => "name",
                                "contentType" => "FilterTermString"
                            ],
                            [
                                "comparison" => "contains",
                                "value" => $inn,
                                "field" => "Category183CustomFieldInn",
                                "contentType" => "FilterTermString"
                            ]
                        ],
                        "contentType" => "FilterTermGroup"
                    ],
                    "contentType" => "FilterConfig"
                ]
            ],
            "limit" => 25
        ];
        $queryJson = Json::encode($query);

        $result = $this->client->makeGet('/api/v3/contractor?'.$queryJson, []);
        return $this->serializer->deserialize($result, ContractorsResponse::class, 'json');
    }

    public function getById($id): ContractorResponse
    {
        $id = Nmbr::toIntegerStrict($id);
        $url = '/api/v3/contractor/';
        $url = $url.$id;
        $result = $this->client->makeGet($url, [], true);
        //BaseConsole::stdout(print_r(Json::decode($result), true));
        return $this->serializer->deserialize($result, ContractorResponse::class, 'json');
    }

    public function addResponsible(AbstractContractor $contractor, LinkEntity $entity): BooleanResponse
    {
        $client = $this->client;
        $serializer = $this->serializer;
        $result = [];
        $data = $serializer->serialize($entity, 'json');

        if (Obj::isA($contractor, ContractorHuman::class)) {
            $url = '/api/v3/contractorHuman/'.$contractor->id.'/responsibles';
            $result = $client->makePost($url, $data);
        } elseif (Obj::isA($contractor, ContractorCompany::class)) {
            $url = '/api/v3/contractorCompany/'.$contractor->id.'/responsibles';
            $result = $client->makePost($url, $data);
        } else {
            throw new MgpException('Unexpected type of constractor.');
        }
        
        return $this->serializer->deserialize($result, BooleanResponse::class, 'json');
    }

    public function deleteResponsible(AbstractContractor $contractor, Employee $employee): BooleanResponse
    {
        $client = $this->client;
        $serializer = $this->serializer;
        $result = [];
        
        $id = $contractor->id;
        $responsibleContentType = $employee->contentType;
        $responsibleId = $employee->id;

        $data = $serializer->serialize($contractor, 'json');
        $url = "/api/v3/contractor/{$id}/responsibles/{$responsibleContentType}/{$responsibleId}/";
        $result = $client->makeDelete($url, $data);
          
        return $this->serializer->deserialize($result, BooleanResponse::class, 'json');
    }

    /*public function getDeals($id):
    {
        $id = Nmbr::toIntegerStrict($id);
        $url = '/api/v3/contractor/'.$id.'/deals';
        $result = $this->client->makeGet($url, [], true);
        return $this->serializer->deserialize($result, ContractorDealsResponse::class, 'json');
    }*/

    /*public function addEmployee($id)
    {
        $id = Nmbr::toIntegerStrict($id);
        $client = $this->client;
        $serializer = $this->serializer;
        
        //$data = $serializer->serialize($deal, 'json');
        $url = '/api/v3/contractor/'.$id.'/responsibles';
        $result = $client->makePost($url, $data);
        
        return $result;
    }*/
}