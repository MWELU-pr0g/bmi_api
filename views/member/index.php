<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\grid\GridView;
use yii\widgets\ListView;

$this->title = 'Index';
$this->params['breadcrumbs'][] = $this->title;
// print_r($model);exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<div >
<meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <h1><?= Html::encode($this->title) ?></h1>
    <?= 
    GridView::widget([
    'dataProvider' => $model,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
       
        'name',
        'height',
        'weight',]
]); 
?>

  </html>


       
