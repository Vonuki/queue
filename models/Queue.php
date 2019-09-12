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
     * @return array Kye=>Value for Status options
     */
    public static function getStatusLabels(){
      return array(0 => "Active", 1 => "Archived", 2 => "On Pause");  
    }
    
    /**
     * @return array Kye=>Value for QueueShare options
     */
    public static function getShareLabels(){
      return array(0 => "Private / by link", 1 => "Visible for all");  
    }
 
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
            'idQueue' => Yii::t('lg_common', 'ID Queue'),
            'Description' => Yii::t('lg_common', 'Description'),
            'QueueShare' => Yii::t('lg_common', 'Private | Public'),
            'idOwner' => Yii::t('lg_common', 'Id Owner'),
            'FirstItem' => Yii::t('lg_common', 'First Item'),
            'QueueLen' => Yii::t('lg_common', 'Queue Lenght'),
            'Status' => Yii::t('lg_common', 'Status'),
            'AvgMin' => Yii::t('lg_common', 'Average tact time (min.)'),
            'AutoTake' => Yii::t('lg_common', 'Auto take next Item'),
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
        return self::getStatusLabels()[$this->Status];
    }
  
    /**
     * @return Text value for Share of Queue
     */
    public function getQueueShareTxt()
    {
        return self::getShareLabels()[$this->QueueShare];
    }
    
    /**
     * @return \yii\db\ActiveQuer for all Public Queues
     */
    public function findPublic()
    {
        return Queue::find()->where(['QueueShare' => 1 ])->orderBy('Description')->all();
    }
    
}