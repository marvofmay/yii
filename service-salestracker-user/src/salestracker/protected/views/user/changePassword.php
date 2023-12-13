<?php
    $this->pageTitle=Yii::app()->name . ' - Change password';
    $this->breadcrumbs = ['Change password',];
?>

<div id="content">
    <?php if (Yii::app()->user->hasFlash('changePassword')): ?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('changePassword'); ?>
        </div>
    <?php elseif (Yii::app()->user->hasFlash('errors')): ?>
        <div class="flash-error">
            <?php echo Yii::app()->user->getFlash('errors'); ?>
        </div>
    <?php else: ?>

        <h1>Change password</h1>
        <div class="form">
            <?php
                $form = $this->beginWidget('CActiveForm', [
                    'id' => 'change-password-form',
                    'enableClientValidation' => true,
                    'clientOptions' => [
                        'validateOnSubmit' => true,
                    ],
                ]);
            ?>

            <p class="note">Fields with <span class="required">*</span> are required.</p>
            <?php echo $form->errorSummary($model); ?>
            <div class="row">
                <?php echo $form->labelEx($model,'newPassword'); ?>
                <?php echo $form->passwordField($model,'newPassword'); ?>
                <?php echo $form->error($model,'newPassword'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'confirmNewPassword'); ?>
                <?php echo $form->passwordField($model, 'confirmNewPassword'); ?>
                <?php echo $form->error($model, 'confirmNewPassword'); ?>
            </div>

            <div class="row buttons">
                <?php echo CHtml::submitButton('Submit'); ?>
            </div>
            <?php $this->endWidget(); ?>
        </div><!-- form -->
    <?php endif; ?>
</div>
