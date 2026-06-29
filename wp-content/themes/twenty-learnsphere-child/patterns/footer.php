<?php
/**
 * Title: footer
 * Slug: learnsphere-tt5-child/footer
 * Inserter: no
 */
?>
<!-- wp:group {"tagName":"footer","metadata":{"patternName":"learnsphere-tt5-child/footer","name":"footer"},"align":"full","className":"ls-footer is-style-default","style":{"border":{"width":"0px","style":"none"},"spacing":{"padding":{"right":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50"}}},"backgroundColor":"base","textColor":"contrast","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center","orientation":"horizontal"}} -->
<footer class="wp-block-group alignfull ls-footer is-style-default has-contrast-color has-base-background-color has-text-color has-background" style="border-style:none;border-width:0px;padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"metadata":{"name":"Mobile Footer"},"align":"wide","className":"ls-footer__bar is-style-default","style":{"border":{"color":"var:preset|color|accent-6","width":"1px","radius":"12px"},"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|50","bottom":"var:preset|spacing|40","left":"var:preset|spacing|50"}},"shadow":"var:preset|shadow|card","layout":{"selfStretch":"fill","flexSize":null}},"backgroundColor":"base","layout":{"type":"grid","minimumColumnWidth":"0rem","columnCount":3}} -->
<div class="wp-block-group alignwide ls-footer__bar is-style-default has-border-color has-base-background-color has-background" style="border-color:var(--wp--preset--color--accent-6);border-width:1px;border-radius:12px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--50);box-shadow:var(--wp--preset--shadow--card)"><!-- wp:paragraph {"metadata":{"name":"Copyrights"},"className":"ls-footer__copy","style":{"typography":{"fontWeight":"700","letterSpacing":"0.04em","textAlign":"left"}},"fontSize":"small"} -->
<p class="has-text-align-left ls-footer__copy has-small-font-size" style="font-weight:700;letter-spacing:0.04em"><?php esc_html_e('© 2026 LearnSphere — Conçu avec Koro', 'learnsphere-tt5-child');?></p>
<!-- /wp:paragraph -->

<!-- wp:navigation {"overlayMenu":"never","className":"ls-footer__legal","style":{"spacing":{"blockGap":"var:preset|spacing|30"},"typography":{"fontSize":"var:preset|font-size|small","fontWeight":"800"},"layout":{"columnSpan":1,"rowSpan":1}},"fontFamily":"nunito","layout":{"type":"flex","justifyContent":"center","flexWrap":"wrap"}} /-->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"right"}} -->
<div class="wp-block-group"><!-- wp:image {"lightbox":{"enabled":false},"width":"24px","linkDestination":"custom","metadata":{"name":"Insta"}} -->
<figure class="wp-block-image is-resized"><a href="https://instagram.com"><img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/PlatformInstagram-ColorOriginal.png" alt="" class="" style="width:24px"/></a></figure>
<!-- /wp:image -->

<!-- wp:image {"lightbox":{"enabled":false},"width":"24px","sizeSlug":"full","linkDestination":"custom","metadata":{"name":"Facebook"}} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/PlatformFacebook-ColorNegative.png" alt="" class="" style="width:24px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></footer>
<!-- /wp:group -->