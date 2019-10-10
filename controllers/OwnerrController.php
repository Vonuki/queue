<?php

namespace app\controllers;

use Yii;
use app\models\Owner;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * OwnerController implements the REST api for Owner model.
 *  
 * Status:
 * 0 - Active
 * 1 - Archived
 */
class OwnerrController extends ActiveController
{
    public $modelClass = 'app\models\Owner';
}