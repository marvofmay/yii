<?php

$this->pageTitle=Yii::app()->name . ' - Register';
$this->breadcrumbs = ['Register',];
?>

<div id="content">
    <h1>Register</h1>
    <?php if(Yii::app()->user->hasFlash('register')): ?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('register'); ?>
        </div>
    <?php elseif(Yii::app()->user->hasFlash('errors')): ?>
        <div class="flash-error">
            <?php echo Yii::app()->user->getFlash('errors'); ?>
        </div>
    <?php else: ?>
        <div class="form">
            <?php
                $form = $this->beginWidget('CActiveForm', [
                    'id' => 'register-form',
                    'enableClientValidation' => true,
                    'clientOptions' => [
                        'validateOnSubmit' => true,
                    ],
                ]);
            ?>
            <p class="note">Fields with <span class="required">*</span> are required.</p>
            <?php echo $form->errorSummary($model); ?>

            <div class="row">
                <?php echo $form->labelEx($model,'email'); ?>
                <?php echo $form->textField($model,'email'); ?>
                <?php echo $form->error($model,'email'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model,'password'); ?>
                <?php echo $form->passwordField($model,'password'); ?>
                <?php echo $form->error($model,'password'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'confirmPassword'); ?>
                <?php echo $form->passwordField($model, 'confirmPassword'); ?>
                <?php echo $form->error($model, 'confirmPassword'); ?>
            </div>

            <div class="row buttons">
                <?php echo CHtml::submitButton('Submit'); ?>
            </div>
            <?php $this->endWidget(); ?>
        </div><!-- form -->
    <?php endif; ?>
</div>
