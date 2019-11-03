<?php

namespace app\models\user;

class RegistrationForm extends \dektrium\user\models\RegistrationForm
    {
        /**
         * @var string
         */
        public $captcha;
        /**
         * @inheritdoc
         */
        public function rules()
        {
            $rules = parent::rules();
            $rules[] = ['captcha', 'required'];
            $rules[] = ['captcha', 'captcha'];
            return $rules;
        }
    }