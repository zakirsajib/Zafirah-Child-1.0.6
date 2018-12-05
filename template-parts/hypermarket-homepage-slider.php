<!-- Homepage Swiper Slider -->
<section id="zafirah-hero-slider" class="hero-slider">
<?php 
	$page_gallery = fw_get_db_post_option(get_the_ID(), 'page-gallery');
	if( is_array($page_gallery) && count($page_gallery) > 0 ) :?>
	<div class="swiper-container-parent">
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php foreach( $page_gallery as $image ) : ?>
					<div class="swiper-slide"><img srcset="<?php echo $image['url']; ?> 800w, <?php echo $image['url']; ?> 100w" sizes="(max-width:800px) 100vw, 800px" src="<?php echo $image['url']; ?>" alt="<?php echo $image['url']; ?>"/></div>
				<?php endforeach;?>
			</div>	
			<?php //if( count($page_gallery) > 1):?>
			<!-- If we need pagination -->
			<div class="swiper-pagination"></div>
				<!-- If we need navigation buttons -->
<!-- 				<div class="swiper-button-prev"></div> -->
<!-- 				<div class="swiper-button-next"></div> -->
			<?php //endif?>
		</div>
	</div>
<?php endif;
	
if(fw_get_db_post_option(get_the_ID(),'page-video')):?>
	<div class="post-meta-video">
		<div class="ratio-container">
			<div class="ratio-content">
				<?php echo fw_get_db_post_option(get_the_ID(), 'page-video');?>
			</div>
		</div>
	</div>
<?php endif;?>
</section>