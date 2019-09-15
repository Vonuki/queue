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
    public static function getStatusTexts(){
      return array(0 => "Active", 1 => "Archived", 2 => "On Pause");  
    }
  
    public static function getStatusLabels(){
      return array(0 => "label label-success", 1 => "label label-default", 2 => "label label-danger");  
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
        return $this->hasMany(VItem::className(), ['idQueue' => 'idQueue']);
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
    public function getStatusText()
    {
        return self::getStatusTexts()[$this->Status];
    }
  
    public function getStatusLabel()
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
  
  
    /**
     * @Fill Queue for Owner
     */
    public function fillOwner($owner)
    {
        $this->idOwner = $owner->idOwner;
        $this->FirstItem = 0; //first item number
        $this->QueueShare = 0; //private queue
        $this->QueueLen = 0; //curretn lentgh of queue
        $this->Status = 0; //status 
        $this->AvgMin = 0;//Average time in minutes
        $this->AutoTake = 1; // if new item will take aotomaticaly
        return $this;
    }
  
    /**
     * @add Item in queue
     */
    public function addItemSave($item)
    {
        $transaction = Queue::getDb()->beginTransaction(); 
        try {
            $this->QueueLen++;
            $item->PutInPositionSave($this->AvgMin, $this->QueueLen);   // save inside
            $this->save();
            $transaction->commit();
        } catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch(\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }   
        return $this;
    }
    
}