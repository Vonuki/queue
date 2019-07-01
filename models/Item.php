<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Item".
 *
 * @property int $idItem
 * @property int $idQueue
 * @property int $idClient
 * @property int $Status
 * @property string $CreateDate
 * @property string $StatusDate
 * @property string $RestTime
 * @property int $Position
 *
 * @property Client $client
 * @property Queue $queue
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idQueue', 'idClient', 'Status', 'RestTime', 'Position'], 'required'],
            [['idQueue', 'idClient', 'Status', 'Position'], 'integer'],
            [['CreateDate', 'StatusDate', 'RestTime'], 'safe'],
            [['idClient'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['idClient' => 'idClient']],
            [['idQueue'], 'exist', 'skipOnError' => true, 'targetClass' => Queue::className(), 'targetAttribute' => ['idQueue' => 'idQueue']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idItem' => 'Id Item',
            'idQueue' => 'Id Queue',
            'idClient' => 'Id Client',
            'Status' => 'Status',
            'CreateDate' => 'Create Date',
            'StatusDate' => 'Status Date',
            'RestTime' => 'Rest Time',
            'Position' => 'Position',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['idClient' => 'idClient']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQueue()
    {
        return $this->hasOne(Queue::className(), ['idQueue' => 'idQueue']);
    }
}
