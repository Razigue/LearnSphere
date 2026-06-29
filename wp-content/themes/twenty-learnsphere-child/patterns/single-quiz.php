<?php
/**
 * Title: single-quiz
 * Slug: learnsphere-tt5-child/single-quiz
 * Inserter: no
 */
?>
<!-- wp:template-part {"slug":"header"} /-->

<!-- wp:group {"tagName":"main","align":"full","className":"ls-main ls-single ls-single\u002d\u002dquiz","layout":{"type":"constrained"}} -->
<main class="wp-block-group alignfull ls-main ls-single ls-single--quiz"><!-- wp:group {"align":"wide","className":"ls-single-hero","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide ls-single-hero"><!-- wp:group {"className":"ls-single-meta","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
<div class="wp-block-group ls-single-meta"><!-- wp:post-terms {"term":"ls_category","className":"ls-badge ls-badge\u002d\u002dcategory"} /-->

<!-- wp:post-terms {"term":"ls_difficulty","className":"ls-badge ls-badge\u002d\u002ddifficulty"} /-->

<!-- wp:post-date {"metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}}} /--></div>
<!-- /wp:group -->

<!-- wp:post-title {"textAlign":"center","align":"wide","className":"ls-single-title"} /-->

<!-- wp:post-excerpt {"textAlign":"center","moreText":"","className":"ls-single-excerpt"} /--></div>
<!-- /wp:group -->

<!-- wp:post-featured-image {"aspectRatio":"16/9","align":"wide","className":"ls-single-image"} /-->

<!-- wp:group {"align":"wide","className":"ls-quiz-runner","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide ls-quiz-runner"><!-- wp:paragraph {"className":"ls-eyebrow"} -->
<p class="ls-eyebrow"><?php esc_html_e('Quiz interactif', 'learnsphere-tt5-child');?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e('Répondez aux questions puis validez votre score.', 'learnsphere-tt5-child');?></h2>
<!-- /wp:heading -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#quiz"><?php esc_html_e('Commencer le quiz', 'learnsphere-tt5-child');?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:paragraph -->
<p><?php esc_html_e('Cette zone est prête à recevoir le bloc de quiz du plugin LearnSphere. Les questions, réponses et corrections restent gérées côté plugin.', 'learnsphere-tt5-child');?></p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[ls_quiz]
<!-- /wp:shortcode --></div>
<!-- /wp:group --></main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer"} /-->