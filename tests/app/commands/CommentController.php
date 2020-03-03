<?php
namespace app\commands;

use devskyfly\mgp\managers\CommentManager;
use devskyfly\mgp\managers\DealManager;
use devskyfly\mgp\types\Comment;
use Yii;
use yii\console\Controller;
use yii\helpers\BaseConsole;

class CommentController extends Controller
{
    public function actionAdd()
    {
        $mgpClient = Yii::$app->mgpClient;
        $dealManager = $mgpClient->getManager(DealManager::class);
        $commentManager = $mgpClient->getManager(CommentManager::class);
        $dealResponse = $dealManager->getById(202);
        $deal = $dealResponse->data;
        $comment = new Comment();
        $comment->content = "Machine comment";
        $result = $commentManager->create($deal, $comment);
        BaseConsole::stdout(print_r($result, true));
    }
    
}