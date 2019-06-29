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
<<<<<<< HEAD
 * @property User $person
=======
 * @property Person $person
>>>>>>> bcf9dc12a6a3418919718089d3a1ed68fc089dcf
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
<<<<<<< HEAD
            [['idPerson'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idPerson' => 'id']],
=======
            [['idPerson'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['idPerson' => 'idPerson']],
>>>>>>> bcf9dc12a6a3418919718089d3a1ed68fc089dcf
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
<<<<<<< HEAD
        return $this->hasOne(User::className(), ['id' => 'idPerson']);
=======
        return $this->hasOne(Person::className(), ['idPerson' => 'idPerson']);
>>>>>>> bcf9dc12a6a3418919718089d3a1ed68fc089dcf
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQueues()
    {
        return $this->hasMany(Queue::className(), ['idOwner' => 'idOwner']);
    }
}
