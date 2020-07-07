<?php

namespace app\models;

use Yii;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "member".
 *
 * @property int $id
 * @property string $name
 * @property int $height
 * @property int $weight
 * @property int $result
 */
class Member extends \yii\db\ActiveRecord
{

    const SCENERIO_CREATE = "create";
    const SCENERIO_LIST = "list";

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'height', 'weight'], 'required', 'on' => 'create'],
            [['height', 'weight', 'result'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'height' => 'Height',
            'weight' => 'Weight',
            'result' => 'Result'
        ];
    }

    public function scenarios()
    {
        $scenario = parent::scenarios();
        $scenarios["create"] = ['name', 'height', 'weight'];
        return $scenario;
    }
    public function scenarios2()
    {
        $scenario = parent::scenarios();
        $scenarios2["list"] = ['name', 'height', 'weight', 'result'];
        return $scenario;
    }


    public function results()
    {
        
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, 'http://localhost/bmi/web/member/list'); 
        curl_setopt($ch, CURLOPT_POST, 1 ); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $postResult = curl_exec($ch);
       $list = json_decode($postResult)->data;
        curl_close($ch);
        
        // print_r($list);exit;

        $data =  new ArrayDataProvider(
            [
                'allModels' => $list,
            ]
        );

        // print_r($data);exit;

        return $data;
        
    }
    
}
