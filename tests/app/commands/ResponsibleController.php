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
use devskyfly\mgp\managers\EmployeeManager;
use devskyfly\php56\types\Nmbr;
use devskyfly\mgp\managers\ResponsibleManager;
use devskyfly\mgp\types\LinkEntity;
use devskyfly\mgp\types\Employee;

class ResponsibleController extends Controller
{

    public function actionAdd($id)
    {
        
        $mgpClient = Yii::$app->mgpClient;
        $serializer = Serializer::getInstance();
        $responsibleManager = new ResponsibleManager(['client' => $mgpClient, 'serializer' => $serializer]);
        $contractorManager = new ContractorManager(['client' => $mgpClient, 'serializer' => $serializer]);
        $contractor = ($contractorManager->getById(1001122))->data;
        $manager = new Employee();
        $manager->id = "1000019";
        $link = $manager->createLink();
        //BaseConsole::stdout(print_r($contractor, true));
        //BaseConsole::stdout(print_r($link, true));
        $responsibleResponse = $responsibleManager->add($contractor, $link);
        BaseConsole::stdout(print_r($responsibleResponse, true));
    }
}