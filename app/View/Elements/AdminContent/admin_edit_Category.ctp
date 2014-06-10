<?
	echo $this->PHForm->input('Article.title');
	echo $this->PHForm->input('Article.color', array(
		'label' => array('class' => 'control-label', 'text' => __('Color, #')), 
		'class' => 'input-small'
	));
?>
