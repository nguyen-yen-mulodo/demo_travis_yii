<?php
/* @var $this PostController */
/* @var $model Posts */

$this->breadcrumbs=array(
	'Posts'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Posts', 'url'=>array('index')),
	array('label'=>'Create Posts', 'url'=>array('create')),
	array('label'=>'Update Posts', 'url'=>array('update', 'id'=>$model->pid)),
	array('label'=>'Delete Posts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Posts', 'url'=>array('admin')),
);
?>

<h1>View Posts #<?php echo $model->pid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pid',
		'title',
		'content',
		array('name'=> 'uid', 'value' => CHtml::encode($model->getAuthor())),
		array('name'=> 'create_dt', 'value' => CHtml::encode($model->getDateFormat('create_dt'))),
		array('name'=> 'update_dt', 'value' => CHtml::encode($model->getDateFormat('update_dt'))),
		array('name'=> 'cid', 'value' => CHtml::encode($model->getCategory())),
	),
)); ?>
