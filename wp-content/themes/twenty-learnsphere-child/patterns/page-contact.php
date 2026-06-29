<?php
/**
 * Title: page-contact
 * Slug: learnsphere-tt5-child/page-contact
 * Inserter: no
 */
?>
<!-- wp:template-part {"slug":"header"} /-->

<!-- wp:group {"tagName":"main","align":"full","className":"ls-main ls-contact-page","layout":{"type":"constrained"}} -->
<main class="wp-block-group alignfull ls-main ls-contact-page"><!-- wp:group {"align":"wide","className":"ls-archive-hero","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide ls-archive-hero"><!-- wp:paragraph {"className":"ls-eyebrow"} -->
<p class="ls-eyebrow"><?php esc_html_e('Contact', 'learnsphere-tt5-child');?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php esc_html_e('Une question sur LearnSphere ?', 'learnsphere-tt5-child');?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"ls-archive-hero__lede"} -->
<p class="ls-archive-hero__lede"><?php esc_html_e('Envoyez un message à l’équipe ou retrouvez le siège de l’organisme de formation.', 'learnsphere-tt5-child');?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","className":"ls-contact-grid","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide ls-contact-grid"><!-- wp:group {"className":"ls-map-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group ls-map-card"><!-- wp:html -->
<style data-wp-block-html="css">
/* --- Variables & Reset (à conserver) --- */
:root {
    --primary-color: #524C8D;
    --primary-hover: #524C8D;
    --text-main: #282828;
    --text-muted: #6B7280;
    --card-bg: #FFFFFF;
    --border-color: #E5E7EB;
    --error-color: #A2363D;
    --success-color: #FCED50;
    --border-radius: 8px;
}

/* On s'assure que le padding ne casse pas la largeur 100% */
.contact-container, 
.contact-container * {
    box-sizing: border-box;
}

/* --- Container (s'adapte au parent) --- */
.contact-container {
    width: 100%; /* Prend toute la largeur du conteneur parent */
    padding: 2rem; /* Espace intérieur fluide */
    border-radius: 16px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    color: var(--text-main);
}

.contact-header {
    text-align: center;
    margin-bottom: 30px;
}

.contact-header h2 {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 10px;
    margin-top: 0;
}

.contact-header p {
    color: var(--text-muted);
    font-size: 15px;
    line-height: 1.5;
    margin: 0;
}

/* --- Form Layout (Fluide & Auto-adaptatif) --- */
.contact-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

/* Gère les colonnes côte à côte */
.form-row {
    display: flex;
    flex-wrap: wrap; /* Permet de passer à la ligne si pas assez de place */
    gap: 20px;
}

.form-row .form-group {
    /* Grandit et rétrécit. Occupe 50% moins l'espace du gap, avec un minimum de 200px */
    flex: 1 1 calc(50% - 10px);
    min-width: 200px; /* Point de bascule automatique basé sur le parent */
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

label {
    font-size: 14px;
    font-weight: 600;
    color: var(--text-main);
}

/* --- Inputs & Textarea --- */
.contact-form input, 
.contact-form textarea {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    font-size: 15px;
    font-family: inherit;
    transition: all 0.3s ease;
    outline: none;
    margin: 0;
}

.contact-form input::placeholder, 
.contact-form textarea::placeholder {

}

.contact-form input:focus, 
.contact-form textarea:focus {

    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
}

.contact-form textarea {
    resize: vertical;
    min-height: 120px;
}

/* --- Button --- */
.submit-btn {
    background-color: var(--primary-color);
    color: white;
    border: none;
    border-radius: var(--border-radius);
    padding: 14px 20px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.1s ease;
    margin-top: 10px;
    width: 100%; /* S'étend sur toute la largeur */
}

.submit-btn:hover {
    background-color: var(--primary-hover);
}

.submit-btn:active {
    transform: scale(0.98);
}

.submit-btn.loading {
    opacity: 0.8;
    cursor: not-allowed;
}

/* --- Status Message --- */
.form-status {
    margin-top: 15px;
    padding: 12px;
    border-radius: var(--border-radius);
    font-size: 14px;
    text-align: center;
    display: none;
    font-weight: 500;
}

.form-status.success {
    display: block;
    color: var(--success-color);
    border: 1px solid #A7F3D0;
}

.form-status.error {
    display: block;
    background-color: #FEE2E2;
    color: var(--error-color);
    border: 1px solid #FECACA;
}
</style>

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous</title>
    <link rel="stylesheet" href="style.css">



    <div class="contact-container">
        <div class="contact-header">
            <h2>Contactez-nous</h2>
            <p>Une question ? N'hésitez pas à nous écrire, nous vous répondrons dans les plus brefs délais.</p>
        </div>

        <form id="contactForm" class="contact-form">
            <div class="form-row">
                <div class="form-group">
                    <label for="firstname">Prénom</label>
                    <input type="text" id="firstname" name="firstname" placeholder="Jean" required="">
                </div>
                <div class="form-group">
                    <label for="lastname">Nom</label>
                    <input type="text" id="lastname" name="lastname" placeholder="Dupont" required="">
                </div>
            </div>

            <div class="form-group">
                <label for="email">Adresse Email</label>
                <input type="email" id="email" name="email" placeholder="jean.dupont@email.com" required="">
            </div>

            <div class="form-group">
                <label for="subject">Sujet</label>
                <input type="text" id="subject" name="subject" placeholder="De quoi s'agit-il ?" required="">
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" placeholder="Écrivez votre message ici..." required=""></textarea>
            </div>

            <button type="submit" id="submitBtn" class="submit-btn">
                <span class="btn-text">Envoyer le message</span>
            </button>

            <div id="formStatus" class="form-status"></div>
        </form>
    </div>

    <script src="script.js"></script>
<!-- /wp:html --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"ls-map-card","style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","orientation":"vertical","flexWrap":"wrap","justifyContent":"stretch"}} -->
<div class="wp-block-group ls-map-card" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"className":"ls-eyebrow"} -->
<p class="ls-eyebrow"><?php esc_html_e('Siège social', 'learnsphere-tt5-child');?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e('LearnSphere', 'learnsphere-tt5-child');?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"layout":{"selfStretch":"fill","flexSize":null}}} -->
<p><?php esc_html_e('59 Rue de Ponthieu, 75008 Paris', 'learnsphere-tt5-child');?></p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11794799.413270772!2d-79.62288867884713!3d59.65466338946153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ca422105b67290b%3A0xee2776481d9c79f2!2sLearnSphere%20%2F%20SavoirSph%C3%A8re!5e0!3m2!1sen!2sfr!4v1777494886319!5m2!1sen!2sfr" width="100%" height="250" style="border: none; border-radius: 8px; display: block;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" scrolling="no">
</iframe>
<!-- /wp:html --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer"} /-->