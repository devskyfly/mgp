<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\helpers\BaseConsole;
use yii\helpers\Json;
use devskyfly\mgp\managers\ContractorManager;
use devskyfly\mgp\serialize\Serializer;
use devskyfly\mgp\types\ContractorCompany;
use devskyfly\mgp\types\ContractorHuman;
use devskyfly\mgp\managers\DealManager;
use devskyfly\mgp\types\ContactInfo;
use devskyfly\mgp\types\Employee;

class ContractorController extends Controller
{

    public function actionCreateCompany()
    {
        $mgpClient = Yii::$app->mgpClient;
        $serializer = Serializer::getInstance();
        $manager = new ContractorManager(['client' => $mgpClient, 'serializer' => $serializer]);
        $contractor = new ContractorCompany();
        
        $contractor->name = "Филпан2";
        $contractor->inn = "0000000001";
        $contractor->activityType = null;
        
        $contact = new ContactInfo();
        $contact->type = ContactInfo::TYPE_PHONE;
        $contact->value = '66666666';
        $contractor->contactInfo = [
            $contact
        ];
        
        $result = $manager->create($contractor);
        BaseConsole::stdout(print_r($result, true));
    }
    
    /*public function actionCreateCompany()
    {
        $mgpClient = Yii::$app->mgpClient;
        $serializer = Serializer::getInstance();
        $manager = new ContractorManager(['client' => $mgpClient, 'serializer' => $serializer]);
        $contractor = new ContractorCompany();
        $contractor->name = "Филпан";
        $contractor->inn = "0000000001";
        $contractor->activityType = null;

        $result = $manager->create($contractor);
        BaseConsole::stdout(print_r(Json::decode($result), true));
    }*/

    public function actionCreateHuman()
    {
        $mgpClient = Yii::$app->mgpClient;
        $contractorManager = $mgpClient->getManager(ContractorManager::class);
        $contractor = new ContractorHuman();
        $contractor->firstName = "Иван";
        $contractor->lastName = "Филиппов1";
        $contractor->middleName = "Ярославович";
        $contractor->inn = "000000000003";
        //$contractor->activityType = null;
        $contractor->isPublic = true;
        $contractor->responsibles = [];
        
        $result = $contractorManager->create($contractor);
        $contractor = $result->data;
        $employee = new Employee();
        $employee->id = "1000013";
        $result = $contractorManager->deleteResponsible($contractor, $employee);
        BaseConsole::stdout(print_r($result, true));
    }

    public function actionGet($id)
    {
        
        $mgpClient = Yii::$app->mgpClient;
        $serializer = Serializer::getInstance();
        $manager = new ContractorManager(['client' => $mgpClient, 'serializer' => $serializer]);
        $result = $manager->getById($id);
        BaseConsole::stdout(print_r($result->data, true));
    }

    public function actionGetByNameAndInn($name, $inn)
    {
        $mgpClient = Yii::$app->mgpClient;
        $serializer = Serializer::getInstance();
        $manager = new ContractorManager(['client' => $mgpClient, 'serializer' => $serializer]);
        $result = $manager->getByNameAndInn($name, $inn);
        BaseConsole::stdout(print_r($result, true));
    }

    /*public function actionGetDeals($id)
    {
        $mgpClient = Yii::$app->mgpClient;
        $serializer = Serializer::getInstance();
        $manager = new ContractorManager(['client' => $mgpClient, 'serializer' => $serializer]);
        $result = $manager->getDeals($id);
        BaseConsole::stdout(print_r($result, true));
    }*/
    
    public function actionGetActiveDeals($name, $inn)
    {
        $mgpClient = Yii::$app->mgpClient;
        $serializer = Serializer::getInstance();
        $contractorManager = new ContractorManager(['client' => $mgpClient, 'serializer' => $serializer]);
        $dealManager = new DealManager(['client' => $mgpClient, 'serializer' => $serializer]);
        $contractorsResponse = $contractorManager->getByNameAndInn($name, $inn);
        $contractor = $contractorsResponse->data[0];
        $dealsResponse = $dealManager->getActiveByContractor($contractor);
        BaseConsole::stdout(print_r($dealsResponse, true));
    }
    
    /*public function actionUpdateManager()
    {
        $mgpClient = Yii::$app->mgpClient;
        $serializer = Serializer::getInstance();
        $contractorManager = new ContractorManager(['client' => $mgpClient, 'serializer' => $serializer]);
        $contractorResponse = $contractorManager->getById(1001122);
        $contractor = $contractorResponse['data'];
        $employee = new Employee();
        $employee->id = "1000027";
        
        $contractor 
        $deal->manager = $employee->createLink();
        
        
        $dealResponse = $manager->update($deal);
        BaseConsole::stdout(print_r($dealResponse, true));
    }*/
    
    /*public function actionGetDeals($id)
    {
        $mgpClient = Yii::$app->mgpClient;
        $serializer = Serializer::getInstance();
        $ContractorManager = new ContractorManager(['client' => $mgpClient, 'serializer' => $serializer]);
        $DealManager = new DealManager(['client' => $mgpClient, 'serializer' => $serializer]);
        $result = $manager->getDeals($id);
        BaseConsole::stdout(print_r($result, true));
    }*/

    public function actionAddResponsible()
    {
        $mgpClient = Yii::$app->mgpClient;
        $contractorManager = $mgpClient->getManager(ContractorManager::class);
        $contractor = ($contractorManager->getById(1001160))->data;
        $manager = new Employee();
        $manager->id = "1000027";
        $link = $manager->createLink();
        $responsibleResponse =  $contractorManager->addResponsible($contractor, $link);
        BaseConsole::stdout(print_r($responsibleResponse, true));
    }
}