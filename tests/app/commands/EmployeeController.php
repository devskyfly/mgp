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

class EmployeeController extends Controller
{

    public function actionGet($id)
    {
        $id = Nmbr::toIntegerStrict($id);
        $mgpClient = Yii::$app->mgpClient;
        $serializer = Serializer::getInstance();
        $employeeManager = new EmployeeManager(['client' => $mgpClient, 'serializer' => $serializer]);
        $employeeResponse = $employeeManager->getById($id);
        BaseConsole::stdout(print_r($employeeResponse, true));
    }
}