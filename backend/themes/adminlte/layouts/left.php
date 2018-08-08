<?php
use common\models\Transfer;
?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/admin-icon.png" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?php
                if (!Yii::$app->user->isGuest) {
                    echo Yii::$app->user->identity->email;
                }?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?php
            // $countModel = Transfer::find()->where(['status_view' => 1])->groupBy(['id'])->count();
        ?>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Postzii', 'options' => ['class' => 'header']],
                    //['label' => 'จัดการผู้ใช้', 'icon' => 'cog', 'url' => ['/gii']],
                    [
                        'label' => Yii::t('manageUser', 'Manage User'),
                        'icon' => 'cog',
                        'url' => '#',
                        'items' => [
                            ['label' => Yii::t('user', 'User Member List'), 'icon' => 'address-book', 'url' => ['/profile/index'],],
                            ['label' => Yii::t('manageUser', 'Member Studio List'), 'icon' => 'address-book', 'url' => ['/tbl-studio/index'],],
                            ['label' => Yii::t('manageUser', 'Verify Member'), 'icon' => 'check-circle', 'url' => ['/verify-member/index'],],
                            /*[
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],*/
                        ],
                    ],
                    [
                        'label' => Yii::t('schedule', 'Graduation Schedule'),
                        'icon' => 'calendar',
                        'url' => '#',
                        'items' => [
                            ['label' => Yii::t('schedule', 'Create Schedule'), 'icon' => 'calendar-plus-o', 'url' => ['/graduation-schedule/create']],
                            ['label' => Yii::t('schedule', 'Update Schedule'), 'icon' => 'calendar-check-o', 'url' => ['/graduation-schedule/index']],
                        ],
                    ],
                    ['label' => 'ข้อมูลการจอง', 'icon' => 'calendar-check-o', 'url' => ['/debug']],
                    [
                        // 'label' => $countModel == 0 ? 'ข้อมูลการโอนเงิน' : 'ข้อมูลการโอนเงิน <span class="label label-danger" style="margin-left:10px">'.$countModel.'</span>', 
                        'label' => 'ข้อมูลการโอนเงิน',
                        // 'template' => '<p>test</p>',
                        'icon' => 'dollar', 
                        'url' => ['/transfer/index']
                    ],
                    ['label' => 'รายงานสถิติ', 'icon' => 'line-chart', 'url' => ['/report/sumary-report']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
