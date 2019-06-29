<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Clients".
 *
 * @property int $idClient
 * @property string $Description
 * @property int $idPerson
 * @property int $Status
 *
 * @property User $person
 * @property Item[] $items
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Clients';
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
            'idClient' => 'Id Client',
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
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['idClient' => 'idClient']);
    }
}
