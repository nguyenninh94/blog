<?php
  use yii\widgets\LinkPager;
?>

                <?php if(!empty($comments)): ?>
                    <?php foreach($comments as $comment): ?>
                       <div class="bottom-comment"><!--bottom comment-->
                        <h4>5 comments</h4>

                        <div class="comment-img">
                            <img class="img-circle" src="<?= $comment->user->photo ?>" alt="">
                        </div>

                        <div class="comment-text">
                            <a href="#" class="replay btn pull-right"> Replay</a>
                            <h5><?= $comment->user->name ?></h5>

                            <p class="comment-date">
                                August 8, 2017
                            </p>


                            <p class="para"><?= $comment->text ?></p>
                            </div>
                        </div>
                        <!-- end bottom comment-->
                    <?php endforeach ?>
                <?php endif ?>


                <div class="leave-comment"><!--leave comment-->
                    <h4>Leave a reply</h4>
                    
                    <?php if(Yii::$app->session->getFlash('comment')): ?>
                    <div class="alert alert-success" role="alert">
                        <?= Yii::$app->session->getFlash('comment') ?>
                    </div>
                    <?php endif ?>    

                    <?php $form = \yii\widgets\ActiveForm::begin([
                        'action' => ['site/comment', 'id' => $article->id],
                        'options' => ['class' => 'form-horizontal contact-form', 'role' => 'form']
                    ]) ?>
                       <div class="form-group">
                           <div class="col-md-12">
                               <?= $form->field($commentForm, 'comment')->textarea(['class' => 'form-control', 'placeholder' => 'Your message here...'])->label(false) ?>
                           </div>
                       </div>
                       <button class="btn send-btn" type="submit">Post</button>   
                    <?php \yii\widgets\ActiveForm::end() ?>
                </div><!--end leave comment-->

                <!-- pagination-->
                    <?php
                        echo LinkPager::widget([
                           'pagination' => $pagination,
                        ]);    
                    ?>
                <!--/pagination-->