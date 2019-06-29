<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Owners".
 *
 * @property int $idOwner
 * @property string $Description
 * @property int $idPerson
 * @property int $Status
 *
 * @property User $person
 * @property Queue[] $queues
 */
class Owners extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Owners';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Description', 'idPerson'], 'required'],
            [['idPerson', 'Status'], 'integer'],
            [['Description'], 'string', 'max' => 50],
            [['idPerson'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idPerson' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idOwner' => 'Id Owner',
            'Description' => 'Description',
            'idPerson' => 'Id Person',
            'Status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(User::className(), ['id' => 'idPerson']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQueues()
    {
        return $this->hasMany(Queue::className(), ['idOwner' => 'idOwner']);
    }
}
