<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $product_id
 * @property string $name
 * @property float $price
 * @property string $country
 * @property string $color
 * @property $photo
 * @property int $count
 * @property int $id_type
 * @property string $created
 *
 * @property Cart[] $carts
 * @property Category $category
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'country', 'color', 'photo', 'count', 'id_type'], 'required'],
            [['price'], 'number'],
            [['photo'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['count', 'id_type'], 'integer'],
            [['created'], 'safe'],
            [['name', 'country', 'color'], 'string', 'max' => 255],
            [['id_category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['id_category' => 'id_category']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_product' => 'Номер продукта',
            'name' => 'Название',
            'price' => 'Цена',
            'country' => 'Страна',
            'color' => 'Цвет',
            'photo' => 'Фото',
            'count' => 'Количество',
            'id_category' => 'Номер категории',
            'created' => 'Создано',
        ];
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::class, ['id_product' => 'product_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id_category' => 'id_category']);
    }
}