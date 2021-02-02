<?php
namespace app\modules\api\v1\controllers;

use yii\rest\ActiveController;

/**
 * OwnerController implements the REST api for Owner model.
 */

class QueueController extends ActiveController
{
    // We are using the regular web app modules:
    public $modelClass = 'app\models\Queue';
   
}