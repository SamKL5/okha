<?php
use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use app\models\Category;

$session = Yii::$app->session;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => '<img src="../../files/Лого7.svg" class="logo"/>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark header-new fixed-top',
        ],
    ]);
    foreach(Category::find()->all() as $val){
        $category[] = [
            'label' => $val->name,
            'url' => ['/site/catalog?category='.$val->id],
        ];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav header-menu'],
        'items' => [
            ['label' => 'Каталог','options' => ['id' => 'down_history'], 'items'=>$category],
            ['label' => 'Конструктор', 'url' => ['/site/konst']],
            ['label' => 'О нас', 'url' => ['/site/about']],
            ['label' => 'Контакты', 'url' => ['/site/contact']],
            !$session->has('auth_admin') ? (
                ''
            ) : (
                ['label' => 'Админ', 'url' => ['/admin/panel/index']]
            ),
            !$session->has('auth_admin') ? (
                ''
            ) : (
                '<li>'
                . Html::beginForm(['/admin/auth/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton('Выйти',['class' => 'btn btn-link logout'])
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    echo "<a class='korzina' href='/korzina/index' style='display: none;'>
    <span>
        <span class='session_count'>
        </span>
    </span>";
    echo "<p class='session_price'></p><p>₽</p></a>";
    NavBar::end();
    ?>
</header>
<main role="main" class="flex-shrink-0">
<div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'homeLink' => ['label' => 'Панель', 'url' => '/admin/panel/index'],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
</div>
</main>

<footer class="footer mt-auto py-3 text-muted new-footer">
    <div class="container">
        <div class='ft-f'>
            <img src="../../files/Лого7.svg">
            <p>ООО "ОKнa"</p><p>Дааддададдададдадад аддадад  аддад  аддадададдадад</p>
            <p style="font-weight:bold;">okha@mail.ru</p>
            <p style="font-size: 12px;color: #c3c3c3;">© 2022 Группа компаний "ОКна"</p>
        </div>
        <div class='ft-s'>
        <?php
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav new-footer-ul'],
            'items' => [
                ['label' => 'Главная', 'url' => ['/site/index']],
                ['label' => 'Каталог','options' => ['id' => 'down_history'], 'items'=>$category],
                ['label' => 'О нас', 'url' => ['/site/about']],
                ['label' => 'Обратная связь', 'url' => ['/site/contact']],
            ],
        ]);
    
        ?>
        </div>
        <div class='ft-t'>

        </div>
    </div>
    
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
