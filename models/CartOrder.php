<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_cart".
 *
 * @property int $order_id
 * @property string $status
 * @property string|null $cancel
 * @property string $created_time
 *
 * @property Cart[] $carts
 */
class OrderCart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_cart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'string'],
            [['created_time'], 'safe'],
            [['cancel'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'status' => 'Status',
            'cancel' => 'Cancel',
            'created_time' => 'Created Time',
        ];
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::class, ['id_order' => 'order_id']);
    }
}