<?php
/**
 * Title: archive-quiz
 * Slug: learnsphere-tt5-child/archive-quiz
 * Inserter: no
 */
?>
<!-- wp:template-part {"slug":"header"} /-->

<!-- wp:group {"tagName":"main","align":"full","className":"ls-main ls-archive ls-archive\u002d\u002dquiz","layout":{"type":"constrained"}} -->
<main class="wp-block-group alignfull ls-main ls-archive ls-archive--quiz"><!-- wp:group {"align":"wide","className":"ls-archive-hero","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide ls-archive-hero"><!-- wp:paragraph {"className":"ls-eyebrow"} -->
<p class="ls-eyebrow"><?php esc_html_e('Quiz', 'learnsphere-tt5-child');?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php esc_html_e('Tous les quiz', 'learnsphere-tt5-child');?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"ls-archive-hero__lede"} -->
<p class="ls-archive-hero__lede"><?php esc_html_e('Testez vos connaissances avec des questions courtes, visuelles et corrigées immédiatement.', 'learnsphere-tt5-child');?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","className":"ls-filter-panel","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide ls-filter-panel"><!-- wp:search {"label":"<?php esc_attr_e('Rechercher un quiz', 'learnsphere-tt5-child');?>","showLabel":false,"placeholder":"<?php esc_attr_e('Rechercher un quiz...', 'learnsphere-tt5-child');?>","buttonText":"<?php esc_attr_e('Rechercher', 'learnsphere-tt5-child');?>","buttonUseIcon":true,"className":"ls-search"} /-->

<!-- wp:shortcode -->
[learnsphere_tax_filter taxonomy="ls_category" base="/quiz/" all_label="Tous"]
<!-- /wp:shortcode -->

<!-- wp:shortcode -->
[learnsphere_tax_filter taxonomy="ls_difficulty" base="/quiz/" all_label="Tous"]
<!-- /wp:shortcode --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":202,"query":{"perPage":6,"pages":0,"offset":0,"postType":"quiz","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide","className":"ls-query ls-query\u002d\u002darchive"} -->
<div class="wp-block-query alignwide ls-query ls-query--archive"><!-- wp:post-template {"className":"ls-card-grid","layout":{"type":"grid","columnCount":3}} -->
<!-- wp:group {"className":"ls-card ls-quiz-card","layout":{"type":"default"}} -->
<div class="wp-block-group ls-card ls-quiz-card"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"5/3","className":"ls-card__image"} /-->

<!-- wp:group {"className":"ls-card__body","layout":{"type":"default"}} -->
<div class="wp-block-group ls-card__body"><!-- wp:group {"className":"ls-card__meta","layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group ls-card__meta"><!-- wp:post-terms {"term":"ls_category","className":"ls-badge ls-badge\u002d\u002dcategory"} /-->

<!-- wp:post-terms {"term":"ls_difficulty","className":"ls-badge ls-badge\u002d\u002ddifficulty"} /--></div>
<!-- /wp:group -->

<!-- wp:post-title {"isLink":true,"className":"ls-card__title"} /-->

<!-- wp:post-excerpt {"moreText":"","excerptLength":18,"className":"ls-card__excerpt"} /-->

<!-- wp:group {"className":"ls-card__foot","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"nowrap"}} -->
<div class="wp-block-group ls-card__foot"><!-- wp:post-date {"metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}}} /-->

<!-- wp:read-more {"content":"<?php esc_attr_e('Lancer →', 'learnsphere-tt5-child');?>","className":"ls-card__link"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-pagination {"className":"ls-pagination","layout":{"type":"flex","justifyContent":"center"}} -->
<!-- wp:query-pagination-previous {"label":"<?php esc_attr_e('← Précédent', 'learnsphere-tt5-child');?>"} /-->

<!-- wp:query-pagination-numbers /-->

<!-- wp:query-pagination-next {"label":"<?php esc_attr_e('Suivant →', 'learnsphere-tt5-child');?>"} /-->
<!-- /wp:query-pagination -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"style":{"typography":{"textAlign":"center"}}} -->
<p class="has-text-align-center"><?php esc_html_e('Aucun quiz ne correspond à votre recherche.', 'learnsphere-tt5-child');?></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query --></main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer"} /-->