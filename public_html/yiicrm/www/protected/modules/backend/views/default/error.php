<?php
/* @var $this SiteController */
/* @var $error array */

$this->breadcrumbs = array(
    'Ошибка'
);
$this->header = 'Ошибка';
$this->setPageTitle("Ошибка " . $code . ": " . CHtml::encode($message));
?>

<div class="well well-error">
    <b>Ошибка <?php echo $code; ?>:</b>
    <?php echo CHtml::encode($message); ?>
</div>