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
 * @property Owner $client
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
            [['idClient'], 'exist', 'skipOnError' => true, 'targetClass' => Owner::className(), 'targetAttribute' => ['idClient' => 'idOwner']],
            [['idQueue'], 'exist', 'skipOnError' => true, 'targetClass' => Queue::className(), 'targetAttribute' => ['idQueue' => 'idQueue']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idItem' => Yii::t('lg_common', 'Id Item'),
            'idQueue' => Yii::t('lg_common', 'Id Queue'),
            'idClient' => Yii::t('lg_common', 'Id Client'),
            'Status' => Yii::t('lg_common', 'Status'),
            'CreateDate' => Yii::t('lg_common', 'Create Date'),
            'StatusDate' => Yii::t('lg_common', 'Status Date'),
            'RestTime' => Yii::t('lg_common', 'Rest Time'),
            'Position' => Yii::t('lg_common', 'Position'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Owner::className(), ['idOwner' => 'idClient']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQueue()
    {
        return $this->hasOne(Queue::className(), ['idQueue' => 'idQueue']);
    }
}