<?php
/**
* @package   yoo_master2
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// get theme configuration
include($this['path']->path('layouts:theme.config.php'));

?>
<!DOCTYPE HTML>
<html lang="<?php echo $this['config']->get('language'); ?>" dir="<?php echo $this['config']->get('direction'); ?>"  data-config='<?php echo $this['config']->get('body_config','{}'); ?>'>

<head>
<?php echo $this['template']->render('head'); ?>

<?php if ($this['config']->get('bg')) : ?>
<style type="text/css">
html {
background:url(<?php echo $this['config']->get('site_url'); ?>/<?php echo $this['config']->get('bg-image'); ?>)no-repeat center center fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
}
</style>
<?php endif; ?>

<style type="text/css">
.uk-container-left {margin:<?php echo $this['config']->get('space-left'); ?>}
<?php if ($this['config']->get('shadow')) : ?>
.uk-container {-webkit-box-shadow: 0 3px 20px 0 rgba(0, 0, 0, 0.1);-moz-box-shadow: 0 3px 20px 0 rgba(0, 0, 0, 0.1);box-shadow: 0 3px 20px 0 rgba(0, 0, 0, 0.1);}
<?php endif; ?>

</style>

</head>

<body class="<?php echo $this['config']->get('body_classes'); ?>">


	<?php if ($this['widgets']->count('absolute')) : ?>
	<div class="absolute uk-hidden-small"><?php echo $this['widgets']->render('absolute'); ?></div>
	<?php endif; ?>

	<!-- UK CONTAINER -->
	<div class="uk-container uk-container-left">
	
		<!-- TOP -->
		<?php if ($this['widgets']->count('toolbar-l')) : ?>
		<div class="toolbar">
			<div class="tm-toolbar uk-clearfix">
			  <?php if ($this['widgets']->count('toolbar-l')) : ?>
			  <div class="uk-float-left"><?php echo $this['widgets']->render('toolbar-l'); ?></div>
			  <?php endif; ?>

			  <?php if ($this['widgets']->count('search')) : ?>
			  <div class="uk-navbar-flip">
				   <div class="uk-hidden-small"><?php echo $this['widgets']->render('search'); ?></div>
			  </div>
			  <?php endif; ?>
			</div>
		</div>
		<?php endif; ?>
	
		<?php //if ($this['widgets']->count('menu')) : ?>
        <div class="menustyle1 menu-outer">

			<nav class="tm-navbar uk-navbar no-space">
				
			  <?php if ($this['widgets']->count('logo')) : ?>
				<div class="logo uk-hidden-small">
					<a class="tm-logo" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo'); ?></a>
				</div>
			  <?php endif; ?>
		
			  <?php if ($this['widgets']->count('menu')) : ?>
			  <div class="menu-inner uk-hidden-small">
			  <?php echo $this['widgets']->render('menu'); ?>
			  </div>
			  <?php endif; ?>
		
			  <?php if ($this['widgets']->count('offcanvas')) : ?>
			  <a href="#offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>
			  <?php endif; ?>
  
			  <?php if ($this['widgets']->count('logo-small')) : ?>
			  <div class="uk-navbar-content uk-navbar-center uk-visible-small"><a class="tm-logo" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo-small'); ?></a></div>
			  <?php endif; ?>
	
			</nav>
	  </div>
      <?php //endif; ?>

		<?php //if ($this['widgets']->count('menu + logo')) : ?>
        <div class="menustyle2 menu-outer">

			<nav class="tm-navbar uk-navbar no-space">
				
			  <?php if ($this['widgets']->count('logo')) : ?>
				<div class="logo uk-hidden-small">
					<a class="tm-logo" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo'); ?></a>
				</div>
			  <?php endif; ?>
		
			  <?php if ($this['widgets']->count('menu')) : ?>
			  <div class="menu-inner">
			  <?php echo $this['widgets']->render('menu'); ?>
			  </div>
			  <?php endif; ?>
		
			  <?php if ($this['widgets']->count('offcanvas')) : ?>
			  <a href="#offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>
			  <?php endif; ?>
  
			  <?php if ($this['widgets']->count('logo-small')) : ?>
			  <div class="uk-navbar-content uk-navbar-center uk-visible-small"><a class="tm-logo" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo-small'); ?></a></div>
			  <?php endif; ?>
	
			</nav>
	  </div>
      <?php //endif; ?>

		
		<?php if ($this['widgets']->count('headerbar')) : ?>
		<div class="headerbar uk-clearfix"><?php echo $this['widgets']->render('headerbar'); ?></div>
		<?php endif; ?>
		
		<?php if ($this['widgets']->count('breadcrumbs')) : ?>
		<?php echo $this['widgets']->render('breadcrumbs'); ?>
		<?php endif; ?>

		<?php if ($this['widgets']->count('top-a')) : ?>
		<div id="top-a">
			<section class="<?php echo $grid_classes['top-a']; echo $display_classes['top-a']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-a', array('layout'=>$this['config']->get('grid.top-a.layout'))); ?></section>
		</div>
		<?php endif; ?>

		<?php if ($this['widgets']->count('top-b')) : ?>
		<div id="top-b">
			<section class="<?php echo $grid_classes['top-b']; echo $display_classes['top-b']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-b', array('layout'=>$this['config']->get('grid.top-b.layout'))); ?></section>
		</div>
		<?php endif; ?>
		
		<?php if ($this['widgets']->count('top-c')) : ?>
		<div id="top-c">
			<section class="<?php echo $grid_classes['top-c']; echo $display_classes['top-c']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-c', array('layout'=>$this['config']->get('grid.top-c.layout'))); ?></section>
		</div>
		<?php endif; ?>
		
		<?php if ($this['widgets']->count('top-d')) : ?>
		<div id="top-d">
			<section class="<?php echo $grid_classes['top-d']; echo $display_classes['top-d']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-d', array('layout'=>$this['config']->get('grid.top-d.layout'))); ?></section>
		</div>
		<?php endif; ?>


		<div id="main"></div>
			<?php if ($this['widgets']->count('main-top + main-bottom + sidebar-a + sidebar-b') || $this['config']->get('system_output', true)) : ?>
				
				<div class="tm-middle uk-grid" data-uk-grid-match data-uk-grid-margin>

					<?php if ($this['widgets']->count('main-top + main-bottom') || $this['config']->get('system_output', true)) : ?>
					<div class="<?php echo $columns['main']['class'] ?>">

						<?php if ($this['widgets']->count('main-top')) : ?>
						<section class="<?php echo $grid_classes['main-top']; echo $display_classes['main-top']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('main-top', array('layout'=>$this['config']->get('grid.main-top.layout'))); ?></section>
						<?php endif; ?>

						<?php if ($this['config']->get('system_output', true)) : ?>
						<main class="tm-content">


							<?php echo $this['template']->render('content'); ?>

						</main>
						<?php endif; ?>

						<?php if ($this['widgets']->count('main-bottom')) : ?>
						<section class="<?php echo $grid_classes['main-bottom']; echo $display_classes['main-bottom']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('main-bottom', array('layout'=>$this['config']->get('grid.main-bottom.layout'))); ?></section>
						<?php endif; ?>

					</div>
					<?php endif; ?>

					<?php foreach($columns as $name => &$column) : ?>
					<?php if ($name != 'main' && $this['widgets']->count($name)) : ?>
					<aside class="<?php echo $column['class'] ?>"><?php echo $this['widgets']->render($name) ?></aside>
					<?php endif ?>
					<?php endforeach ?>
			
				</div>

			<?php endif; ?>

		<?php if ($this['widgets']->count('bottom-a')) : ?>
		<div id="bottom-a">
			<section class="<?php echo $grid_classes['bottom-a']; echo $display_classes['bottom-a']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-a', array('layout'=>$this['config']->get('grid.bottom-a.layout'))); ?></section>
		</div>
		<?php endif; ?>

		<?php if ($this['widgets']->count('bottom-b')) : ?>
		<div id="bottom-b">
			<section class="<?php echo $grid_classes['bottom-b']; echo $display_classes['bottom-b']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-b', array('layout'=>$this['config']->get('grid.bottom-b.layout'))); ?></section>
		</div>
		<?php endif; ?>
		
		<?php if ($this['widgets']->count('bottom-c')) : ?>
		<div id="bottom-c">
			<section class="<?php echo $grid_classes['bottom-c']; echo $display_classes['bottom-c']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-c', array('layout'=>$this['config']->get('grid.bottom-c.layout'))); ?></section>
		</div>
		<?php endif; ?>
		
		<?php if ($this['widgets']->count('bottom-d')) : ?>
		<div id="bottom-d">
			<section class="<?php echo $grid_classes['bottom-d']; echo $display_classes['bottom-d']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-d', array('layout'=>$this['config']->get('grid.bottom-d.layout'))); ?></section>
		</div>
		<?php endif; ?>


		<!-- Footer Module -->
		<?php if ($this['widgets']->count('debug') || $this['config']->get('warp_branding', true) || $this['widgets']->count('footer')) : ?>
			<div class="tm-footer uk-text-center">
				<?php echo $this['widgets']->render('footer'); $this->output('warp_branding'); echo $this['widgets']->render('debug');?>
		<?php endif; ?>

</div>

	<!-- Off Canvas -->
	<?php if ($this['widgets']->count('offcanvas')) : ?>
	<div id="offcanvas" class="uk-offcanvas">
		<div class="uk-offcanvas-bar"><?php echo $this['widgets']->render('offcanvas'); ?></div>
	</div>
	<?php endif; ?>

	<!-- Top Scroller -->
	<?php if ($this['config']->get('totop_scroller', true)) : ?>
	<a class="tm-totop-scroller" data-uk-smooth-scroll href="#"></a>
	<?php endif; ?>


<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){
		event.preventDefault();
		$('html,body').animate({scrollTop:$(this.hash).offset().top-70}, 900);
		});
	});
</script>
	<?php echo $this->render('footer'); ?>

</body>
</html>