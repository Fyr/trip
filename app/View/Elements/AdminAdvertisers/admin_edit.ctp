<?
	echo $this->PHForm->input('user_id', array('class' => 'input-medium', 'options' => $users));
	// echo $this->PHForm->input('Advertiser.title', array('onkeyup' => 'article_onChangeTitle()'));
	echo $this->element('Article.edit_title');
	echo $this->element('Article.edit_slug');
	/*
	echo $this->PHForm->input('Advertiser.middle_name', array('class' => 'input-medium'));
	echo $this->PHForm->input('Advertiser.last_name', array('class' => 'input-medium'));
	echo $this->PHForm->input('Advertiser.email', array('class' => 'input-medium'));
	echo $this->PHForm->input('Advertiser.phone', array('class' => 'input-medium'));
    echo $this->PHForm->input('Advertiser.password', array(
    	'class' => 'input-medium', 
    	'required' => false,
    	'label' => array('text' => __('Change password'), 'class' => 'control-label')
    ));
    echo $this->PHForm->input('Advertiser.password_confirm', array('class' => 'input-medium', 'type' => 'password', 'required' => false));
    */
	echo $this->PHForm->input('teaser');
    echo $this->PHForm->input('active');
?>
<script type="text/javascript">
function article_onChangeTitle() {
	if (!slug_EditMode) {
		$('#AdvertiserSlug').val(translit($('#AdvertiserTitle').val()));
	}
}

function article_onChangeSlug() {
	slug_EditMode = ($('#AdvertiserSlug').val() && true);
}

function translit(str) {
	return ru2en.tr_url(str);
}
</script>