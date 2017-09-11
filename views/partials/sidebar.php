<?php
   use yii\helpers\Url;
?>
<div class="col-md-4" data-sticky_column>
                <div class="primary-sidebar">
                    
                    <aside class="widget">
                        <h3 class="widget-title text-uppercase text-center">Popular Posts</h3>
                        <?php foreach($popularPost as $popular): ?>
                           <div class="popular-post">


                            <a href="<?= Url::toRoute(['site/view', 'id' => $popular->id]) ?>" class="popular-img"><img src="<?= $popular->getImage() ?>" alt="">
                                <div class="p-overlay"></div>
                            </a>

                            <div class="p-content">
                                <a href="<?= Url::toRoute(['site/view', 'id' => $popular->id]) ?>" class="text-uppercase"><?= $popular->title ?></a>
                                <span class="p-date">By <?= $popular->user->name ?> on<?= $popular->getDateFormat() ?></span>

                            </div>
                           </div>
                        <?php endforeach ?>   
                    </aside>
                    <aside class="widget pos-padding">
                        <h3 class="widget-title text-uppercase text-center">Recent Posts</h3>
                        <?php foreach($recentPost as $recent): ?>
                          <div class="thumb-latest-posts">


                            <div class="media">
                                <div class="media-left">
                                    <a href="<?= Url::toRoute(['site/view', 'id' => $recent->id]) ?>" class="popular-img"><img src="<?= $recent->getImage() ?>" alt="">

                                        <div class="p-overlay"></div>
                                    </a>
                                </div>
                                <div class="p-content">
                                    <a href="<?= Url::toRoute(['site/view', 'id' => $recent->id]) ?>" class="text-uppercase"><?= $recent->title ?></a>
                                    <span class="p-date">By <?= $recent->user->name ?> on <?= $recent->getDateFormat() ?></span>
                                </div>
                            </div>
                          </div>
                        <?php endforeach ?>
                    </aside>
                    <aside class="widget border pos-padding">
                        <h3 class="widget-title text-uppercase text-center">Categories</h3>
                        <ul>
                          <?php foreach($categories as $cate): ?>
                            <li>
                                <a href="#"><?= $cate->title ?></a>
                                <span class="post-count pull-right"> (<?= $cate->getArticlesCount() ?>)</span>
                            </li>
                          <?php endforeach ?>  
                        </ul>
                    </aside>
                    <aside class="widget pos-padding">
                        <h3 class="widget-title text-uppercase text-center">Follow@Instagram</h3>

                        <div class="instragram-follow">
                            <a href="#">
                                <img src="/public/images/ins-flow.jpg" alt="">
                            </a>
                            <a href="#">
                                <img src="/public/images/ins-flow.jpg" alt="">
                            </a>
                            <a href="#">
                                <img src="/public/images/ins-flow.jpg" alt="">
                            </a>
                            <a href="#">
                                <img src="/public/images/ins-flow.jpg" alt="">
                            </a>
                            <a href="#">
                                <img src="/public/images/ins-flow.jpg" alt="">
                            </a>
                            <a href="#">
                                <img src="/public/images/ins-flow.jpg" alt="">
                            </a>
                            <a href="#">
                                <img src="/public/images/ins-flow.jpg" alt="">
                            </a>
                            <a href="#">
                                <img src="/public/images/ins-flow.jpg" alt="">
                            </a>
                            <a href="#">
                                <img src="/public/images/ins-flow.jpg" alt="">
                            </a>

                        </div>

                    </aside>
                </div>
            </div>