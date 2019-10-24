<?php

namespace app\models;

use Yii;
use dektrium\user\models\User;
use yii\web\IdentityInterface;
use app\commands\utilities as Utilit;


/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 
 * Only for automatic Role assigment after registration
 */

  
class UserDefault extends User  implements IdentityInterface
{
    /**
     * Attempts user confirmation.
     *
     * @param string $code Confirmation code.
     *
     * @return boolean
     */
    public function testHandler($event)
    {
        Yii::$app->session->setFlash('info', 'FTF');
        //\Util::print_var($event->sender);
    }
  
    public function confirm()
    {
        $result = parent::confirm();
        $auth = Yii::$app->authManager;
        $genuser = $auth->getRole('genuser');
        $auth->assign($genuser, $this->id);
        Yii::$app->session->setFlash('info', 'Default Role Assigned');

        return $result;
    }
}