<?php
/**
 * Title: front-page
 * Slug: learnsphere-tt5-child/front-page
 * Inserter: no
 */
?>
<!-- wp:template-part {"slug":"header"} /-->

<!-- wp:group {"tagName":"main","align":"full","className":"ls-main ls-home","layout":{"type":"constrained"}} -->
<main class="wp-block-group alignfull ls-main ls-home">
	<!-- wp:group {"align":"wide","className":"ls-hero","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide ls-hero">
		<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"ls-hero__koro ls-hero__koro\u002d\u002dtl"} -->
		<figure class="wp-block-image size-full ls-hero__koro ls-hero__koro--tl"><img src="/wp-content/themes/twenty-learnsphere-child/assets/koro/v2-koro-02.svg" alt=""/></figure>
		<!-- /wp:image -->

		<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"ls-hero__koro ls-hero__koro\u002d\u002dtr"} -->
		<figure class="wp-block-image size-full ls-hero__koro ls-hero__koro--tr"><img src="/wp-content/themes/twenty-learnsphere-child/assets/koro/v2-koro-05.svg" alt=""/></figure>
		<!-- /wp:image -->

		<!-- wp:paragraph {"className":"ls-hero__greeting"} -->
		<p class="ls-hero__greeting"><?php /* Translators: 1. is the start of a 'strong' HTML element, 2. is the end of a 'strong' HTML element */ 
echo sprintf( esc_html__( 'Bonjour, on est %1$sLearnSphere%2$s', 'learnsphere-tt5-child' ), '<strong>', '</strong>' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":1,"className":"ls-hero__title"} -->
		<h1 class="wp-block-heading ls-hero__title"><?php esc_html_e('Apprendre sans perdre le sourire.', 'learnsphere-tt5-child');?></h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"ls-hero__lede"} -->
		<p class="ls-hero__lede"><?php esc_html_e('Une plateforme e-learning claire, rapide et accessible à tous les apprenants. Cours et quiz interactifs, par des humains, pour des humains.', 'learnsphere-tt5-child');?></p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"className":"ls-hero__ctas","layout":{"type":"flex","justifyContent":"center","flexWrap":"wrap"}} -->
		<div class="wp-block-buttons ls-hero__ctas">
			<!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/cours"><?php esc_html_e('Voir tous les cours', 'learnsphere-tt5-child');?></a></div>
			<!-- /wp:button -->

			<!-- wp:button {"className":"is-style-outline"} -->
			<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/quiz"><?php esc_html_e('Tester un quiz', 'learnsphere-tt5-child');?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","className":"ls-quick-row","layout":{"type":"grid","columnCount":4,"minimumColumnWidth":null}} -->
	<div class="wp-block-group alignwide ls-quick-row">
		<!-- wp:group {"className":"ls-quick-card","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
		<div class="wp-block-group ls-quick-card"><!-- wp:paragraph {"className":"ls-quick-card__icon"} -->
		<p class="ls-quick-card__icon"><?php esc_html_e('01', 'learnsphere-tt5-child');?></p>
		<!-- /wp:paragraph --><!-- wp:paragraph -->
		<p><?php /* Translators: 1. is the start of a 'strong' HTML element, 2. is the end of a 'strong' HTML element, 3. is a 'br' HTML element, 4. is the start of a 'span' HTML element, 5. is the end of a 'span' HTML element */ 
echo sprintf( esc_html__( '%1$sAccueil%2$s%3$s%4$s/%5$s', 'learnsphere-tt5-child' ), '<strong>', '</strong>', '<br>', '<span>', '</span>' ); ?></p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"ls-quick-card","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
		<div class="wp-block-group ls-quick-card"><!-- wp:paragraph {"className":"ls-quick-card__icon"} -->
		<p class="ls-quick-card__icon"><?php esc_html_e('02', 'learnsphere-tt5-child');?></p>
		<!-- /wp:paragraph --><!-- wp:paragraph -->
		<p><?php /* Translators: 1. is the start of a 'strong' HTML element, 2. is the end of a 'strong' HTML element, 3. is a 'br' HTML element, 4. is the start of a 'span' HTML element, 5. is the end of a 'span' HTML element */ 
echo sprintf( esc_html__( '%1$sCours%2$s%3$s%4$s/cours%5$s', 'learnsphere-tt5-child' ), '<strong>', '</strong>', '<br>', '<span>', '</span>' ); ?></p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"ls-quick-card","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
		<div class="wp-block-group ls-quick-card"><!-- wp:paragraph {"className":"ls-quick-card__icon"} -->
		<p class="ls-quick-card__icon"><?php esc_html_e('?', 'learnsphere-tt5-child');?></p>
		<!-- /wp:paragraph --><!-- wp:paragraph -->
		<p><?php /* Translators: 1. is the start of a 'strong' HTML element, 2. is the end of a 'strong' HTML element, 3. is a 'br' HTML element, 4. is the start of a 'span' HTML element, 5. is the end of a 'span' HTML element */ 
echo sprintf( esc_html__( '%1$sQuiz%2$s%3$s%4$s/quiz%5$s', 'learnsphere-tt5-child' ), '<strong>', '</strong>', '<br>', '<span>', '</span>' ); ?></p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"ls-quick-card","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
		<div class="wp-block-group ls-quick-card"><!-- wp:paragraph {"className":"ls-quick-card__icon"} -->
		<p class="ls-quick-card__icon"><?php esc_html_e('@', 'learnsphere-tt5-child');?></p>
		<!-- /wp:paragraph --><!-- wp:paragraph -->
		<p><?php /* Translators: 1. is the start of a 'strong' HTML element, 2. is the end of a 'strong' HTML element, 3. is a 'br' HTML element, 4. is the start of a 'span' HTML element, 5. is the end of a 'span' HTML element */ 
echo sprintf( esc_html__( '%1$sContact%2$s%3$s%4$s/contact%5$s', 'learnsphere-tt5-child' ), '<strong>', '</strong>', '<br>', '<span>', '</span>' ); ?></p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","className":"ls-section","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide ls-section">
		<!-- wp:group {"className":"ls-section-head","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
		<div class="wp-block-group ls-section-head">
			<!-- wp:heading {"level":2} -->
			<h2 class="wp-block-heading"><?php esc_html_e('Nos derniers cours', 'learnsphere-tt5-child');?></h2>
			<!-- /wp:heading -->
			<!-- wp:buttons -->
			<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} -->
			<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/cours"><?php esc_html_e('Voir tous les cours', 'learnsphere-tt5-child');?></a></div>
			<!-- /wp:button --></div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->

		<!-- wp:query {"queryId":101,"query":{"perPage":4,"pages":0,"offset":0,"postType":"course","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"className":"ls-query ls-query\u002d\u002dcourses"} -->
		<div class="wp-block-query ls-query ls-query--courses"><!-- wp:post-template {"className":"ls-card-grid","layout":{"type":"grid","columnCount":4}} -->
			<!-- wp:group {"className":"ls-card ls-course-card","layout":{"type":"default"}} -->
			<div class="wp-block-group ls-card ls-course-card">
				<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3","className":"ls-card__image"} /-->
				<!-- wp:group {"className":"ls-card__body","layout":{"type":"default"}} -->
				<div class="wp-block-group ls-card__body">
					<!-- wp:group {"className":"ls-card__meta","layout":{"type":"flex","flexWrap":"wrap"}} -->
					<div class="wp-block-group ls-card__meta"><!-- wp:post-terms {"term":"ls_category","className":"ls-badge ls-badge\u002d\u002dcategory"} /--><!-- wp:post-terms {"term":"ls_difficulty","className":"ls-badge ls-badge\u002d\u002ddifficulty"} /--></div>
					<!-- /wp:group -->
					<!-- wp:post-title {"isLink":true,"level":3,"className":"ls-card__title"} /-->
					<!-- wp:post-excerpt {"moreText":"","excerptLength":18,"className":"ls-card__excerpt"} /-->
					<!-- wp:read-more {"content":"<?php esc_attr_e('Découvrir →', 'learnsphere-tt5-child');?>","className":"ls-card__link"} /-->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		<!-- /wp:post-template --></div>
		<!-- /wp:query -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","className":"ls-section","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide ls-section">
		<!-- wp:group {"className":"ls-section-head","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
		<div class="wp-block-group ls-section-head">
			<!-- wp:heading {"level":2} -->
			<h2 class="wp-block-heading"><?php esc_html_e('Nos derniers quiz', 'learnsphere-tt5-child');?></h2>
			<!-- /wp:heading -->
			<!-- wp:buttons -->
			<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} -->
			<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/quiz"><?php esc_html_e('Voir tous les quiz', 'learnsphere-tt5-child');?></a></div>
			<!-- /wp:button --></div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->

		<!-- wp:query {"queryId":102,"query":{"perPage":4,"pages":0,"offset":0,"postType":"quiz","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"className":"ls-query ls-query\u002d\u002dquiz"} -->
		<div class="wp-block-query ls-query ls-query--quiz"><!-- wp:post-template {"className":"ls-card-grid","layout":{"type":"grid","columnCount":4}} -->
			<!-- wp:group {"className":"ls-card ls-quiz-card","layout":{"type":"default"}} -->
			<div class="wp-block-group ls-card ls-quiz-card">
				<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"5/3","className":"ls-card__image"} /-->
				<!-- wp:group {"className":"ls-card__body","layout":{"type":"default"}} -->
				<div class="wp-block-group ls-card__body">
					<!-- wp:group {"className":"ls-card__meta","layout":{"type":"flex","flexWrap":"wrap"}} -->
					<div class="wp-block-group ls-card__meta"><!-- wp:post-terms {"term":"ls_category","className":"ls-badge ls-badge\u002d\u002dcategory"} /--><!-- wp:post-terms {"term":"ls_difficulty","className":"ls-badge ls-badge\u002d\u002ddifficulty"} /--></div>
					<!-- /wp:group -->
					<!-- wp:post-title {"isLink":true,"level":3,"className":"ls-card__title"} /-->
					<!-- wp:post-excerpt {"moreText":"","excerptLength":16,"className":"ls-card__excerpt"} /-->
					<!-- wp:read-more {"content":"<?php esc_attr_e('Lancer →', 'learnsphere-tt5-child');?>","className":"ls-card__link"} /-->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		<!-- /wp:post-template --></div>
		<!-- /wp:query -->
	</div>
	<!-- /wp:group -->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer"} /-->
