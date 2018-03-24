<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mulu".
 *
 * @property int $id
 * @property string $name
 * @property string $icon
 * @property string $url
 * @property int $parent_id
 */
class Mulu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mulu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['name', 'icon', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'icon' => 'Icon',
            'url' => 'Url',
            'parent_id' => 'Parent ID',
        ];
    }

    public static function menu()
    {

        //定义空数组装菜单
        $menuAll = [];
        //得到一级目录
        $menus = self::find()->where(['parent_id'=>0])->all();

        //循环找出所有子目录
        foreach ($menus as $menu){
            $newMenu = [];
            $newMenu['label'] = $menu->name;
            $newMenu['icon'] = $menu->icon;
            $newMenu['url'] = $menu->url;

            //通过一级菜单找到子目录
            $menuSon = self::find()->where(['parent_id'=>$menu->id])->all();
            //循环找到子目录
            foreach ( $menuSon as $value){
                $newMenuSon = [];
                $newMenuSon['label'] = $value->name;
                $newMenuSon['icon'] = $value->icon;
                $newMenuSon['url'] = $value->url;
                $newMenu['items'][] =$newMenuSon;
            }
            //最后的菜单
            $menuAll[] = $newMenu;
        }
        return $menuAll;
    }
}
