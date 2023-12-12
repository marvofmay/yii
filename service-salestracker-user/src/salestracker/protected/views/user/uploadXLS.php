<?php

$this->pageTitle=Yii::app()->name . ' - Upload XLS';
$this->breadcrumbs=['Upload XLS',];
?>

<div id="content">
    <h1>Upload XLS</h1>

    <?php if (Yii::app()->user->hasFlash('uploadXLSSuccess')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('uploadXLSSuccess'); ?>
    </div>
    <?php endif; ?>

    <?php if (Yii::app()->user->hasFlash('uploadXLSError')): ?>
    <div class="flash-error">
        <?php echo Yii::app()->user->getFlash('uploadXLSError'); ?>
    </div>
    <?php endif; ?>

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'uploadXLS',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'file'); ?>
        <?php echo $form->fileField($model, 'file'); ?>
        <?php echo $form->error($model, 'file'); ?>
    </div>

    <div class="row btn-uploadXLS">
        <?php echo CHtml::submitButton('Import'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>