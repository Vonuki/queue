<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vItem".
 *
 * @property int $idItem
 * @property int $idQueue
 * @property int $idClient
 * @property int $Status
 * @property string $CreateDate
 * @property string $StatusDate
 * @property string $RestTime
 * @property int $Position
 * @property string $QueueDescription
 * @property string $OwnerDescription
 */
class VItem extends Item
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vItem';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idItem', 'idQueue', 'idClient', 'Status', 'Position'], 'integer'],
            [['idQueue', 'idClient', 'Status', 'RestTime', 'Position'], 'required'],
            [['CreateDate', 'StatusDate', 'RestTime'], 'safe'],
            [['QueueDescription', 'OwnerDescription'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            parent::attributeLabels(),
            'QueueDescription' => Yii::t('lg_common', 'Queue Description'),
            'OwnerDescription' => Yii::t('lg_common', 'Owner Description'),
        ];
    }
  

   public static function primaryKey()
    {
        return ['idItem'];
    }
}
