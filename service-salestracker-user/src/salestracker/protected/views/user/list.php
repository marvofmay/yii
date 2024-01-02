<?php
    $this->pageTitle=Yii::app()->name . ' - List Users';
    $this->breadcrumbs=['List users',];
?>

<div id="content">
    <h1>Users list</h1>
    <?php if (Yii::app()->user->hasFlash('errors')): ?>
        <div class="flash-error">
            <?php echo Yii::app()->user->getFlash('errors'); ?>
        </div>
    <?php else: ?>
        <ul>
        <?php
            foreach ($users as $user) {
               echo '<li>' . $user->getEmail() . '</li>';
            }
        ?>
        </ul>
    <?php endif; ?>
</div>