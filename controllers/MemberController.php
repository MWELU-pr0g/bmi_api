<?php

namespace app\controllers;


use Yii;
use app\models\Member;

class MemberController extends \yii\rest\Controller
{


    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionNew()
    {

        \Yii::$app->response->format = \Yii\web\Response::FORMAT_JSON;  //returns in json
        // echo "jkfhsdkjj";
        $new = new Member();
        $new->scenario = Member::SCENERIO_CREATE;
        // $new->attributes = \Yii::$app->request->post();

        // $new->load(Yii::$app->request->post());
        $new->name = \Yii::$app->request->post('name');
        $new->height = \Yii::$app->request->post('height');
        $new->weight = \Yii::$app->request->post('weight');
        $height = $new->height;
        $weight = $new->weight;

        $bmi = $weight / ($height * $height);

        $new->result = intval($bmi);
        $message = "";
        if ($new->save()) {
           
            if ($bmi < 18.5) {
                $message = "You are underweight.";
            } else if ($bmi >= 18.5 && $bmi <= 24.9) {
                $message = "Congrats!!! You have normal weight.";
            } else if ($bmi > 24.9 && $bmi <= 29.9) {
                $message = "You are overweight.";
            } else {
                $message = "Be careful!!! You are obese.";
            }

            return array(
                'bmi'=>$bmi,
                'status' => true,
                'data' => $message,
            );
        } else {
            $error = $new->errors;

            return ['status'=> false, 'message'=> $error];
        }

    }

    public function actionList()
    {
        // print_r("hello there!");
        // exit;

        \Yii::$app->response->format = \Yii\web\Response::FORMAT_JSON;


        $new = Member::find()->all();

        if (count($new) > 0) {

            return array('status' => true, 'data' => $new);
        } else {
            return array('status' => false, 'data' => "Sorry!!!No Record Found");
        }
    }
}
