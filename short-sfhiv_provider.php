<?	$post = get_post();	?>
<?	$time_format = get_option('time_format');	?>
<article id="post-<?=the_ID();?>" <?php 
	post_class("short");
	do_action("short_attributes");
	?>>
	<header>
		<h3 class="entry-title"><?=the_title();?></h3>
	</header>
	<div class="services services-list">
	<?	foreach($post->services as $service):	?>
		<div id="sfhiv-service-<?=$service->ID;?>" class="service service-list-item">
			<h4><a href="<?=get_permalink($service->ID);?>"><?=get_the_title($service->ID);?></a></h4>
			<div class="entry-content">
				<?=apply_filters("content",$service->post_content);?>
			</div>
			<ul class="list sfhiv_service_time_hour service-time-list">
			<?
			$locations = sfhiv_service_hours_sort_by_location($service->times);
			foreach($locations as $location){
				echo '<li class="sfhiv_service_hour type-sfhiv_service_hour status-publish hentry list-item">';
				$times = sfhiv_service_hours_sort_by_start_end($location->times);
				echo '<div class="times-list">';
				foreach($times as $time){
					echo '<div class="time-container">';
					echo '<div class="date date-float">';
					foreach($time['times'] as $hour){
						sfhiv_service_hour_display_day_markup($hour->ID);
					}
					echo '</div>';
					echo '<div class="time time-float">';
					sfhiv_service_hour_display_time_markup($time['start'],$time['end'],$time_format);
					echo '</div>';
					echo '</div>';
				}
				echo '</div><!-- end .times-list -->';
				sfhiv_location_format($location);
				echo '</li>';
			}
			?>
			</ul>
			<div class="clear">&nbsp;</div>
		</div>
	<?	endforeach; ?>
	</div>
	<div class="clear"></div>
</article>