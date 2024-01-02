<?php
    $this->pageTitle=Yii::app()->name . ' - List Users';
    $this->breadcrumbs=['List categories',];
?>

<div id="content">
    <h1>Categories list</h1>
    <?php if (Yii::app()->user->hasFlash('errors')): ?>
        <div class="flash-error">
            <?php echo Yii::app()->user->getFlash('errors'); ?>
        </div>
    <?php else: ?>
        <ul>
        <?php
            foreach ($categories as $category) {
               echo '<li>' . $category->getName() . ' (posts: ' . count($category->posts) . ')</li>';
            }
        ?>
        </ul>
    <?php endif; ?>
</div>