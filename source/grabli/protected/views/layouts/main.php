<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/framework.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.4.2.min.js"></script>
	

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
	<link rel="shortcut icon" href="/favicon.gif"/>
    <link rel="icon" type="image/gif" href="/favicon.gif"/>
</head>

<body>

<div class="g" style="min-height: 100%;">
	<div >
		<div class="g-row">
			<div class="g-12">

				<div id="logo">
					<img src="/images/logo.png" style="height: 30px; float: left; margin-right: 10px;" />
					<h1 style="margin: 7px 0px;"><?php echo CHtml::encode(Yii::app()->name); ?></h1>
				</div>


				<div class="f-nav-bar">
					<div class="f-nav-bar-body">
						<div class="f-nav-bar-title">
							<?php if (isset($pageTitle)) : ?>
							<?php endif; ?>
							<a href="/">Grabl!</a>
						</div><!-- f-nav-bar-title -->


							<?php $this->widget('zii.widgets.CMenu',array(
								'items'=>array(

									array('label'=>'Home', 'url'=>array('/site/index')),
									array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
									array('label'=>'Contact', 'url'=>array('/site/contact')),
									array('label'=>'The application logic', 'url'=>array('/site/logic')),


									array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
									array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
								),
								'htmlOptions' => array( 'class' => 'f-nav'),
							)); ?>

					</div><!-- f-nav-bar-body -->
				</div><!-- f-nav-bar -->

				<?php if(isset($this->breadcrumbs)):?>
					<?php $this->widget('zii.widgets.CBreadcrumbs', array(
						'links'=>$this->breadcrumbs,
					)); ?><!-- breadcrumbs -->
				<?php endif?>
			</div>
		</div>

		<div class="g-row">
			<div class="g-9">
				<?php echo $content; ?>
			</div>

			<div class="g-3">
				<?php if (yii::app()->user->isGuest) :  ?>
					<?php $this->renderPartial('/users/login_form'); ?>
				<?php else : ?>
					<?php $this->renderPartial('/users/user_menu'); ?>
				<?php endif; ?>
			</div>

		</div>

	</div>

</div>

<div class="g f-nav-bar" style="margin-top: -52px; height: 50px; background-color: silver;">
	<div class="g-row" style="margin-top: 10px;">
		<div class="g-12">
			<div id="footer" class="" style="text-align: center; ">
				v. <?=Yii::app()->params['version'] ?>
				<br />
				&copy <?=date('Y') ?> GRABL! the bug tracker
			</div><!-- footer -->
		</div>
	</div>
</div>

</body>
</html>
