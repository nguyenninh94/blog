<?php
   use yii\helpers\Url;
?>
               <?php foreach($topComments as $topComment): ?>
               <div class="top-comment"><!--top comment-->
                    <img src="/public/images/comment.jpg" class="pull-left img-circle" alt="">
                    <h4><?= $topComment->user->name ?></h4>
                <?php endforeach ?>    

                    <p><?= $topComment->text ?></p>
                </div><!--top comment end-->

                <div class="row"><!--blog next previous-->
                    <div class="col-md-6">
                        <div class="single-blog-box">
                            <a href="#">
                                <img src="/public/images/blog-next.jpg" alt="">

                                <div class="overlay">

                                    <div class="promo-text">
                                        <p><i class=" pull-left fa fa-angle-left"></i></p>
                                        <h5>Rubel is doing Cherry theme</h5>
                                    </div>
                                </div>


                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-blog-box">
                            <a href="#">
                                <img src="/public/images/blog-next.jpg" alt="">

                                <div class="overlay">

                                    <div class="promo-text">
                                        <p><i class=" pull-left fa fa-angle-left"></i></p>
                                        <h5>Rubel is doing Cherry theme</h5>
                                    </div>
                                </div>


                            </a>
                        </div>
                    </div>
                </div><!--blog next previous end-->
                
                <div class="related-post-carousel"><!--related post carousel-->
                    <div class="related-heading">
                        <h4>You might also like</h4>
                    </div>
                    <div class="items">
                      <?php foreach($allArticles as $article): ?>
                        <div class="single-item">
                            <a href="<?= Url::toRoute(['site/view', 'id' => $article->id]) ?>">
                                <img src="<?= $article->getImage() ?>" alt="<?= $article->title ?>">

                                <p><?= $article->title ?></p>
                            </a>
                        </div>
                      <?php endforeach ?>  
                    </div>
                </div><!--related post carousel-->