<?php
/* @var $this PostController */
/* @var $model Posts */

$this->breadcrumbs=array(
	'Posts'=>array('index'),
	$model->title=>array('view','id'=>$model->pid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Posts', 'url'=>array('index')),
	array('label'=>'Create Posts', 'url'=>array('create')),
	array('label'=>'View Posts', 'url'=>array('view', 'id'=>$model->pid)),
	array('label'=>'Manage Posts', 'url'=>array('admin')),
);
?>

<h1>Update Posts <?php echo $model->pid; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>