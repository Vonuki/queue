<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Queue".
 *
 * @property int $idQueue
 * @property string $Description
 * @property int $QueueShare
 * @property int $idOwner
 * @property int $FirstItem
 * @property int $QueueLen
 * @property int $Status
 * @property int $AvgMin
 * @property int $AutoTake
 *
 * @property Item[] $items
 * @property Owner $owner
 */
class Queue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Queue';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Description', 'QueueShare', 'idOwner', 'FirstItem', 'QueueLen'], 'required'],
            [['QueueShare', 'idOwner', 'FirstItem', 'QueueLen', 'Status', 'AvgMin', 'AutoTake'], 'integer'],
            [['Description'], 'string', 'max' => 50],
            [['idOwner'], 'exist', 'skipOnError' => true, 'targetClass' => Owner::className(), 'targetAttribute' => ['idOwner' => 'idOwner']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idQueue' => Yii::t('lg_queue', 'ID Queue'),
            'Description' => Yii::t('lg_queue', 'Description'),
            'QueueShare' => Yii::t('lg_queue', 'Queue Share'),
            'idOwner' => Yii::t('lg_queue', 'Id Owner'),
            'FirstItem' => Yii::t('lg_queue', 'First Item'),
            'QueueLen' => Yii::t('lg_queue', 'Queue Lenght'),
            'Status' => Yii::t('lg_queue', 'Status'),
            'AvgMin' => Yii::t('lg_queue', 'Average tact time (min.)'),
            'AutoTake' => Yii::t('lg_queue', 'Auto take next Item'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['idQueue' => 'idQueue']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(Owner::className(), ['idOwner' => 'idOwner']);
    }
  
    /**
     * @return Text value for Status of Queue
     */
    public function getStatusTxt()
    {
        $status = "";
        switch ($this->Status) {
          case 0:
            $status = Yii::t('lg_queue', 'Active');
            break;
          case 1:
            $status = Yii::t('lg_queue', 'Archived');
            break;
          case 2:
            $status = Yii::t('lg_queue', 'On Pause');
            break;
         default:
            $status =  Yii::t('lg_queue', 'Null');
            break;
        }  
        return $status;
    }
}