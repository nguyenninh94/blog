<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ContactForm;
use app\models\CommentForm;
use app\models\Comment;

use yii\data\Pagination;
use app\models\Article;
use app\models\Category;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public $successUrl = 'Success';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function successCallback($client)
    {
        $attributes = $client->getUserAttributes();

        $user = \app\models\User::find()->where(['email' => $attributes['email']])->one();

        if(!empty($user))
        {

            Yii::$app->user->login($user);
        } else {
            $session = Yii::$app->session;
            $session['attributes'] = $attributes;

            $this->successUrl = \yii\helpers\Url::to(['site/index']);
        }
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $data = Article::getAllArticles();

        $popularPost = Article::getPopular();
        $recentPost = Article::getRecent();
        $categories = Category::getAll();

        return $this->render('index', [
            'articles' => $data['articles'],
            'pagination' => $data['pagination'],
            'popularPost' => $popularPost,
            'recentPost' => $recentPost,
            'categories' => $categories
        ]);
    }

    public function actionView($id)
    {
        $article = Article::findOne($id);

        $popularPost = Article::getPopular();
        $recentPost = Article::getRecent();
        $categories = Category::getAll();

        //$comments = $article->comments;
        //$comments = $article->getComments()->where(['status' => 1])->all();
        $data = Article::getAllCommentByArticle($id);

        $allArticles = Article::getAll();

        //$topComment = $article->getComments()->where(['id max'])->all();
        $topComments = Article::getTopComment($id);

        $article->viewedCounter();

        $commentForm = new CommentForm();
        
        return $this->render('single_page', [
            'article' => $article,
            'popularPost' => $popularPost,
            'recentPost' => $recentPost,
            'categories' => $categories,
            'comments' => $data['comments'],
            'pagination' => $data['pagination'],
            'allArticles' => $allArticles,
            'topComments' => $topComments,
            'commentForm' => $commentForm
        ]);
    }

    public function actionCategory($id)
    {
        $data = Article::getAllArticlesByCategory($id);

        $popularPost = Article::getPopular();
        $recentPost = Article::getRecent();
        $categories = Category::getAll();

        return $this->render('category', [
            'articles' => $data['articles'],
            'pagination' => $data['pagination'],
            'popularPost' => $popularPost,
            'recentPost' => $recentPost,
            'categories' => $categories
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionComment($id)
    {
        $model = new CommentForm();

        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if($model->saveComment($id))
            {
                Yii::$app->getSession()->setFlash('comment', 'Your comment will be added soon!');
                return $this->redirect(['site/view', 'id' => $id]);
            }
        }
    }
}
