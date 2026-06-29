<?php
/**
 * Title: single-course
 * Slug: learnsphere-tt5-child/single-course
 * Inserter: no
 */
?>
<!-- wp:template-part {"slug":"header"} /-->

<!-- wp:group {"tagName":"main","align":"full","className":"ls-main ls-single ls-single\u002d\u002dcourse","layout":{"type":"constrained"}} -->
<main class="wp-block-group alignfull ls-main ls-single ls-single--course">
	<!-- wp:group {"align":"wide","className":"ls-single-hero","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide ls-single-hero">
		<!-- wp:group {"className":"ls-single-meta","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
		<div class="wp-block-group ls-single-meta"><!-- wp:post-terms {"term":"ls_category","className":"ls-badge ls-badge\u002d\u002dcategory"} /--><!-- wp:post-terms {"term":"ls_difficulty","className":"ls-badge ls-badge\u002d\u002ddifficulty"} /--><!-- wp:post-date /--></div>
		<!-- /wp:group -->

		<!-- wp:post-title {"level":1,"textAlign":"center","className":"ls-single-title"} /-->
		<!-- wp:post-excerpt {"textAlign":"center","moreText":"","className":"ls-single-excerpt"} /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:post-featured-image {"align":"wide","aspectRatio":"16/9","className":"ls-single-image"} /-->

	<!-- wp:group {"align":"wide","className":"ls-single-layout","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide ls-single-layout">
		<!-- wp:group {"className":"ls-single-content","layout":{"type":"constrained"}} -->
		<div class="wp-block-group ls-single-content">
			<!-- wp:post-content {"layout":{"type":"constrained"}} /-->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"ls-course-aside","layout":{"type":"default"}} -->
		<div class="wp-block-group ls-course-aside">
			<!-- wp:heading {"level":2} -->
			<h2 class="wp-block-heading"><?php esc_html_e('À retenir', 'learnsphere-tt5-child');?></h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph -->
			<p><?php esc_html_e('Retrouvez les objectifs, la durée et les ressources du cours dans les champs administrables.', 'learnsphere-tt5-child');?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","className":"ls-comments","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide ls-comments">
		<!-- wp:pattern {"slug":"twentytwentyfive/comments"} /-->
	</div>
	<!-- /wp:group -->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer"} /-->
