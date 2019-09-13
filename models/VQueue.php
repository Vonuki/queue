<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vQueue".
 *
 * @property int $idQueue
 * @property string $Description
 * @property int $QueueShare
 * @property int $idOwner
 * @property int $Firsttem
 * @property int $QueueLen
 * @property int $Status
 * @property int $AvgMin
 * @property int $AutoTake
 * @property string $OwnerDescription
 */
class VQueue extends Queue
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vQueue';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idQueue', 'QueueShare', 'idOwner', 'Firsttem', 'QueueLen', 'Status', 'AvgMin', 'AutoTake'], 'integer'],
            [['Description', 'QueueShare', 'idOwner', 'QueueLen'], 'required'],
            [['Description', 'OwnerDescription'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            parent::attributeLabels(),
            'OwnerDescription' => Yii::t('lg_common', 'Owner Description'),
        ];
    }
  
    public static function primaryKey()
    {
        return ['idQueue'];
    }
}
