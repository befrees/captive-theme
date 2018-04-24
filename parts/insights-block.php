
		<?php $insights = get_posts('cat=1') ?>
		<div class="block-insights-home">
			<div class="container">
				<div class="h1 title-block text-center">Latest Insights</div>
				<div class="insights-container container">
					<div class="slider-insights dots-yellow">
					<?php foreach($insights as $insight): ?>
						<div class="_item-post">
							<div class="_inner">
								<figure><a href="<?php echo get_permalink($insight->ID); ?>"><?php echo get_the_post_thumbnail($insight->ID, 'img_276_166', array('class'=>'img-border img-thumbnail')); ?></a></figure>
								<div class="_title h5"><a href="<?php echo get_permalink($insight->ID); ?>"><?php echo $insight->post_title; ?></a></div>
								<div class="_date"><?php echo get_the_date('M.d.Y', $insight->ID) ?></div>
								<div class="_entry"><?php echo get_the_excerpt($insight->ID); ?></div>
							</div>
						</div>
					<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div> <!-- .block-insights-home -->