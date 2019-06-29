<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Persons".
 *
 * @property int $idPerson
 * @property string $Description
 * @property string $Login
 * @property string $Pass
 * @property string $Email
 * @property string $Phone
 * @property int $Status
 *
 * @property Client[] $clients
 * @property Owner[] $owners
 */
class Persons extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Persons';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Description', 'Login', 'Pass', 'Email', 'Phone'], 'required'],
            [['Status'], 'integer'],
            [['Description'], 'string', 'max' => 50],
            [['Login', 'Pass', 'Email', 'Phone'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idPerson' => 'Id Person',
            'Description' => 'Description',
            'Login' => 'Login',
            'Pass' => 'Pass',
            'Email' => 'Email',
            'Phone' => 'Phone',
            'Status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClients()
    {
        return $this->hasMany(Client::className(), ['idPerson' => 'idPerson']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwners()
    {
        return $this->hasMany(Owner::className(), ['idPerson' => 'idPerson']);
    }
}
