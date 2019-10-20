<?php

namespace app\models;

use Yii;
use yii\web\NotFoundHttpException;

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
 * @property string $Comment
 *
 * @property Owner $client
 * @property Queue $queue
 */
class Item extends \yii\db\ActiveRecord
{
   /**
   * @return array Kye=>Value for Status options
   */
    public static function getStatusTexts(){
      return array(0 => "In Queue", 1 =>"In work",  2 => "Finished | Archived", 3 => "Canceled by User");  
    }
    public static function getStatusLabels(){
      return array(0 => "label label-success", 1 => "label label-danger", 2 => "label label-default", 3 => "label label-default");  
    }
    
  
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
            [['idQueue', 'idClient', 'Status', 'Position', 'RestTime'], 'integer'],
            [['CreateDate', 'StatusDate','Comment'], 'safe'],
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
            'idItem' => Yii::t('lg_common', 'ID Item'),
            'idQueue' => Yii::t('lg_common', 'ID Queue'),
            'idClient' => Yii::t('lg_common', 'ID Client'),
            'Status' => Yii::t('lg_common', 'Status'),
            'CreateDate' => Yii::t('lg_common', 'Create Date'),
            'StatusDate' => Yii::t('lg_common', 'Status Date'),
            'RestTime' => Yii::t('lg_common', 'Rest|Result Time'),
            'Position' => Yii::t('lg_common', 'Position'),
            'Comment' => Yii::t('lg_common', 'Comment'),
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
  
    /**
     * @return exemplar Status in text 
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
     * @Cancel Item
     */
    public function CancelSave(){
      if($this->Status != 3){
        $this->Position = -1;
        $this->Status = 3;
        $this->StatusDate = date("Y-m-d H:i:s",time());
        $sec = strtotime($this->StatusDate) - strtotime($this->CreateDate);
        $this->RestTime = $sec;
        return $this->save();
      }
      else{
         throw new NotFoundHttpException('Item already Canceled');
      }
    }
  
     /**
     * @Finish Item
     */
    public function FinishSave(){
      if($this->Status != 2){
        $this->Position = -1;
        $this->Status = 2;
        $this->StatusDate = date("Y-m-d H:i:s",time());
        $sec = strtotime($this->StatusDate) - strtotime($this->CreateDate);
        $this->RestTime = $sec;
        return $this->save();
      }
      else{
         throw new NotFoundHttpException('Item already Finished');
      }
    }
  
    /**
     * @Put Item in Position of Queue
     */
    public function PutInPositionSave($takt, $position = 0){
      if($position>0){ $this->Position = $position; }
      else {$this->Position--;}
      $this->Status = $this->Status;
      $this->RestTime = $takt * $this->Position;
      $this->StatusDate = date("Y-m-d H:i:s",time());
      return $this->save();
    }
    
    public function AddComment($idOwner){
      $this->idClient = $idOwner;
      //$this->Comment = $text;
      return $this->save();
    }
  
    /**
     * @Handle Item
     */
    public function HandleSave(){
      if($this->Status != 1){
        $this->Position = 0;
        $this->Status = 1;
        $this->StatusDate = date("Y-m-d H:i:s",time());
        $this->RestTime = 0;
        return $this->save();
      }
      else{
         throw new NotFoundHttpException('Item already Handled');
      }
    }
  
    /**
     * @Create Empty Item for create form
     */
    public function FillEmptyItem($idOwner){
      $this->idClient = $idOwner;
      $this->idQueue = 0;
      $this->Status = 0; //status 
      $this->CreateDate =  date("Y-m-d H:i:s",time());
      $this->StatusDate = date("Y-m-d H:i:s",time());
      $this->RestTime = 0; 
      $this->Position = 0;
      return $this;
    }
    
}