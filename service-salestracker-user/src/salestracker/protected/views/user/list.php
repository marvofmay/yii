<?php

$this->pageTitle=Yii::app()->name . ' - List Users';
$this->breadcrumbs=array(
	'List Users',
);
?>

<div id="content">
    <h1>Users list</h1>
    <ul>
    <?php
        foreach ($users as $user) {
           echo '<li>' . $user->getEmail() . '</li>';
        }
    ?>
    </ul>
</div>