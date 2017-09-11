<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(Yii::$app->session->getFlash('comment')): ?>
        <div class="alert alert-success" role="alert">
           <?= Yii::$app->session->getFlash('comment') ?>
        </div>
    <?php endif ?> 

    <?php if(!empty($comments)): ?>
        <table class="table table-bordered">
            <thead>
                <th>Id</th>
                <th>Author</th>
                <th>Content</th>
                <th>Action</th>
            </thead>
            <tbody>
            <?php foreach($comments as $comment): ?>
                <tr>
                    <td><?= $comment->id ?></td>
                    <td><?= $comment->user->name ?></td>
                    <td><?= $comment->text ?></td>
                    <td>
                        <a href="<?= Url::toRoute(['comment/delete', 'id' => $comment->id]) ?>" class="btn btn-danger">Delete</a>

                        <?php if($comment->isAllowed()): ?>
                           <a href="<?= Url::toRoute(['comment/disallow', 'id' => $comment->id]) ?>" class="btn btn-warning">Disallow</a>
                        <?php else: ?>   
                            <a href="<?= Url::toRoute(['comment/allow', 'id' => $comment->id]) ?>" class="btn btn-success">Allow</a>
                        <?php endif ?>   
                    </td>
                </tr>
            <?php endforeach ?>    
            </tbody>
        </table>
    <?php endif ?>
</div>
