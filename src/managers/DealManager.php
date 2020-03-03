<?php
namespace devskyfly\mgp\managers;

use yii\helpers\Json;
use devskyfly\php56\types\Nmbr;
use devskyfly\mgp\response\DealResponse;
use devskyfly\mgp\types\AbstractContractor;
use devskyfly\mgp\types\Deal;
use devskyfly\mgp\types\ProgramTrigger;
use devskyfly\mgp\response\ContractorDealsResponse;
use devskyfly\mgp\response\BooleanResponse;

class DealManager extends AbstractManager
{
    public function create(Deal $deal): DealResponse
    {
        $client = $this->client;
        $serializer = $this->serializer;

        $data = $serializer->serialize($deal, 'json');
        $url = '/api/v3/deal';
        $result = $client->makePost($url, $data);

        return $this->serializer->deserialize($result, DealResponse::class, 'json');
    }
    
    public function update(Deal $deal): BooleanResponse
    {
        $client = $this->client;
        $serializer = $this->serializer;
        
        $data = $serializer->serialize($deal, 'json');
        $url = '/api/v3/deal';
        $result = $client->makePost($url, $data);
        
        return $this->serializer->deserialize($result, BooleanResponse::class, 'json');
    }
    
    public function getById($id): DealResponse
    {
        $id = Nmbr::toIntegerStrict($id);
        $client = $this->client;
        $serializer = $this->serializer;
        $url = '/api/v3/deal/' . $id;
        $result = $client->makeGet($url, []);
        //BaseConsole::stdout(print_r(Json::decode($result), true));
        return $this->serializer->deserialize($result, DealResponse::class, 'json');
    }

    public function getActiveByContractor(AbstractContractor $contracor): ContractorDealsResponse
    {
        $query = [
            'fields' => [
                'number',
                'contractor',
                'price'
            ],
            'sortBy' => [
                0 => [
                    'fieldName' => 'name',
                    'desc' => false,
                    'contentType' => 'SortField'
                ]
            ],
            'filter' => [
                'contentType' => 'TradeFilter',
                'id' => NULL,
                'config' => [
                    'termGroup' => [
                        'join' => 'and',
                        'terms' => [
                            0 => [
                                'comparison' => 'equals',
                                'value' => [
                                    0 => [
                                        'id' => '11',
                                        'contentType' => 'ProgramState'
                                    ],
                                    1 => [
                                        'id' => '9',
                                        'contentType' => 'ProgramState'
                                    ]
                                ],
                                'field' => 'state',
                                'contentType' => 'FilterTermRef'
                            ],
                            1 => [
                                'comparison' => 'equals',
                                'value' => [
                                    0 => [
                                        'id' => $contracor->id,
                                        'contentType' => 'ContractorHuman'
                                    ]
                                ],
                                'field' => 'contractor',
                                'contentType' => 'FilterTermRef'
                            ]
                        ],
                        'contentType' => 'FilterTermGroup'
                    ],
                    'contentType' => 'FilterConfig'
                ],
                'program' => [
                    'id' => '3',
                    'contentType' => 'Program'
                ]
            ],
            "limit" => 25
        ];

        $queryJson = Json::encode($query);

        $result = $this->client->makeGet('/api/v3/deal?'.$queryJson, []);
        return $this->serializer->deserialize($result, ContractorDealsResponse::class, 'json');
    }

    public function applyTrigger(Deal $deal, ProgramTrigger $trigger): bool
    {
        $id = Nmbr::toIntegerStrict($deal->id);
        $client = $this->client;
        $serializer = $this->serializer;
        
        $data = $serializer->serialize($trigger, 'json');
        $url = '/api/v3/deal/'.$id.'/applyTrigger';
        $result = $client->makePost($url, $data);
        
        return $result;
    }
}