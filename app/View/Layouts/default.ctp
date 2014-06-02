<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="description" content="">
<meta name="viewport" content="width=device-width">
	<?=$this->Html->charset(); ?>
	<title><?=DOMAIN_TITLE?></title>
<?php
	echo $this->Html->meta('icon');

	echo $this->Html->css(array('normalize', 'sprite', 'main'));
	echo $this->Html->script(array(
		'vendor/modernizr-2.6.2.min',
		'vendor/jquery/jquery-1.8.3.min',
		'plugins',
		'prettify',
		'main',
	));

	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
?>
</head>
<body>
<div class="over_jpg"></div>
<div class="page_container inner_page">
	<div class="page_container_in">
	    <header class="page_header clearfix">
			<div class="head_top clearfix">
				<div class="head_left">
					<a href="/" class="head_logo"><img src="/img/logo.png" alt=""></a>
				</div>	
				<div class="head_right">
					<ul class="head_flags">
						<li class="selected"><a href=""><img src="/img/_temp/flag_france.gif" alt=""></a></li>
						<li><a href=""><img src="/img/_temp/flag_uk.gif" alt=""></a></li>
						<li><a href=""><img src="/img/_temp/flag_venezuela.gif" alt=""></a></li>
					</ul>
					<div class="head_buttons">
						<a href="" class="head_button head_pink_button"><span class="head_button_icon_place"><i class="_i i_chat"></i></span><span class="head_button_name">guests chat</span></a>
						<a href="" class="head_button head_blue_button"><span class="head_button_icon_place"><i><img src="/img/_temp/chat_ava.png" alt=""></i></span><span class="head_button_name">ASK your buddy</span></a>
					</div>							
				</div>
			</div>
		</header>

		<div class="main_content clearfix">
			<ul class="breadcrumbs">
				<li><a href=""><i class="_i ico_home"></i></a></li>
				<li><a href="">Page 1</a></li>
				<li>Current page</li>
			</ul>
			<div class="main_content_cols clearfix">
				<div class="left_col">
					<div class="banner"><a href=""><img src="/img/_temp/side_banner.jpg" alt=""></a></div>
					<nav class="side_navi accordeon_navi">
						<div class="side_h">Navigator</div>
						<?=$this->element('/SiteUI/categories')?>
					</nav>
				</div>
				<div class="middle_col">
					<?php echo $this->fetch('content'); ?>
				</div>
				<div class="right_col">
					<div class="section">
						<div class="section_h"><span class="side_section_h">News</span></div>
						<ul class="side_news_list">
							<li class="side_news_unit">
								<div class="side_news_h"><a href="">Lorem Impsum dolor</a></div>
								<p>Lorem ipsum dolor sit amet, consectetur <a href="">adipisicing</a> elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim</p>
							</li>
						</ul>
					</div>
					<div class="section">
						<div class="section_h"><span class="side_section_h">Events</span></div>
						<ul class="side_news_list">
							<li class="side_news_unit">
								<img src="/img/_temp/article_2.jpg" alt="" class="side_news_img">
								<div class="side_news_h"><a href="">Lorem Impsum dolor</a></div>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim</p>
							</li>
						</ul>
					</div>
					<div class="section">
						<div class="section_h"><span class="side_section_h">Search</span></div>
						<form action="" class="search_form">
							<div class="form_row"><label for="">Lorem ipsum.</label><input type="text"></div>
							<div class="form_row"><label for="">Lorem ipsum.</label><select name="" id="">
									<option value="">variant</option>
									<option value="">variant</option>
								</select>
							</div>
							<div class="form_row"><button class="button">Search <i class="_i search_arr"></i></button></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>		
</div>
<footer class="footer">
	<div class="footer_in">
		<div class="footer_l">
			<nav class="footer_nav">
				<?=$this->element('/SiteUI/bottom_links')?>
			</nav>
			<address class="copyright">Copyright В© All Rights Reserved | TripBuddy</address>
		</div>
		<div class="footer_r">
			<ul class="social_list">
				<li><a href=""><i class="_i social_icq"></i></a></li>
				<li><a href=""><i class="_i social_skype"></i></a></li>
				<li><a href=""><i class="_i social_yahoo"></i></a></li>
				<li><a href=""><i class="_i social_twitter"></i></a></li>
				<li><a href=""><i class="_i social_instagram"></i></a></li>
				<li><a href=""><i class="_i social_facebook"></i></a></li>
			</ul>
		</div>
	</div>
</footer>
</body>
</html>