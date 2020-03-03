<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\helpers\BaseConsole;
use yii\helpers\Json;
use devskyfly\mgp\managers\ContractorManager;
use devskyfly\mgp\managers\DealManager;
use devskyfly\mgp\serialize\Serializer;
use devskyfly\mgp\types\ContractorCompany;
use devskyfly\mgp\types\ContractorHuman;
use devskyfly\mgp\types\Deal;
use devskyfly\mgp\types\LinkEntity;
use devskyfly\mgp\types\Program;
use devskyfly\mgp\types\ProgramTrigger;
use stdClass;
use devskyfly\mgp\types\Employee;

class DealController extends Controller
{

    public function actionCreate()
    {
        $mgpClient = Yii::$app->mgpClient;
        $serializer = Serializer::getInstance();
        $manager = new ContractorManager([
            'client' => $mgpClient,
            'serializer' => $serializer
        ]);
        $response = $manager->getByNameAndInn('Филпан', '0000000001');
        $contractor = LinkEntity::create($response->data[0]);
        
        $manager = new DealManager([
            'client' => $mgpClient,
            'serializer' => $serializer
        ]);

        $deal = new Deal();
        $deal->contractor = $contractor;
        $program = new Program();
        $program->id = 3;
        $deal->program = $program;

        $json = $serializer->serialize($deal, 'json');
        BaseConsole::stdout(print_r(Json::decode($json), true));

        $result = $manager->create($deal);
        BaseConsole::stdout(print_r(Json::decode($result), true));
    }
    
    public function actionUpdateHook()
    {
        $mgpClient = Yii::$app->mgpClient;
        $serializer = Serializer::getInstance();
        
        $manager = new DealManager([
            'client' => $mgpClient,
            'serializer' => $serializer
        ]);
        
        $response = $manager->getById(201);
        $deal = $response->data;
        BaseConsole::stdout(print_r($deal, true));
        $deal->state = $deal->state->createLink();
        $deal->program = $deal->program->createLink();
        $deal->hookProstavitOtvetstvennogoNaKliente = false;
        
        $updateResponse = $manager->update($deal);
        BaseConsole::stdout(print_r($updateResponse, true));
    }
    
    public function actionUpdateEmp()
    {
        $mgpClient = Yii::$app->mgpClient;
        $serializer = Serializer::getInstance();
        $manager = new DealManager([
            'client' => $mgpClient,
            'serializer' => $serializer
        ]);
        
        $employee = new Employee();
        $employee->id = "1000019";
        $response = $manager->getById(201);
        $deal = $response->data;
        $deal->state = $deal->state->createLink();
        $deal->program = $deal->program->createLink();
        $deal->manager = $employee->createLink();
        $deal->hookProstavitOtvetstvennogoNaKliente = true;
        BaseConsole::stdout(print_r($deal, true));
        
        $dealResponse = $manager->update($deal);
        BaseConsole::stdout(print_r($dealResponse, true));
    }

    /*public function actionGetByNameAndInn($name, $inn)
    {
        $mgpClient = Yii::$app->mgpClient;
        $serializer = Serializer::getInstance();
        $contractorManager = new ContractorManager([
            'client' => $mgpClient,
            'serializer' => $serializer
        ]);
        $result = $contractorManager->getByNameAndInn($name, $inn);
        
        $dealManager = new DealManager();
        BaseConsole::stdout(print_r($result, true));
    }
    
    public function actionGetByContractorId($name, $inn)
    {
        $mgpClient = Yii::$app->mgpClient;
        $serializer = Serializer::getInstance();
        $contractorManager = new ContractorManager([
            'client' => $mgpClient,
            'serializer' => $serializer
        ]);
        $result = $contractorManager->getByNameAndInn($name, $inn);
        
        $dealManager = new DealManager();
        BaseConsole::stdout(print_r($result, true));
    }*/

    /*public function actionGetDeals($id)
    {
        $mgpClient = Yii::$app->mgpClient;
        $serializer = Serializer::getInstance();
        $manager = new ContractorManager(['client' => $mgpClient, 'serializer' => $serializer]);
        $result = $manager->getDeals($id);
       // BaseConsole::stdout(print_r($result, true));
    }*/

    public function actionApplyTrigger()
    {
        $mgpClient = Yii::$app->mgpClient;
        $serializer = Serializer::getInstance();

        $manager = new DealManager(['client' => $mgpClient, 'serializer' => $serializer]);
        $trigger = new ProgramTrigger();
        $trigger->id = 5;
        $manager->applyTrigger(197, $trigger);
    }
    
    public function actionGet($id)
    {
        $mgpClient = Yii::$app->mgpClient;
        $serializer = Serializer::getInstance();
        
        $manager = new DealManager(['client' => $mgpClient, 'serializer' => $serializer]);
        $dealResponse = $manager->getById(200);
        BaseConsole::stdout(print_r($dealResponse, true));
    }
}