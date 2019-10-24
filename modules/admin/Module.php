<?php

namespace app\modules\admin;
use yii\base\Event;
/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    const EVENT_TEST = 'testEvent';
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->trigger(Module::EVENT_TEST, new Event());

        // custom initialization code goes here
    }
}
