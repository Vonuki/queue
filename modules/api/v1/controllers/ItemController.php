<?php
namespace app\modules\api\v1\controllers;

use yii\rest\ActiveController;

/**
 * ItemController implements the REST api for Item model.
 */

class ItemController extends ActiveController
{
    // We are using the regular web app modules:
    public $modelClass = 'app\models\Item';

}