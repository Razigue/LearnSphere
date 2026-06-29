<?php
/**
 * Seed script — données de test.
 * Usage :
 *   npm run wp-env run cli wp eval-file wp-content/plugins/learnsphere-plugin/includes/seed-data.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
	return;
}

require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

/* ================================================================== */
/* Internal API                                                         */
/* ================================================================== */

/**
 * Create a course post.
 *
 * @param array{
 *   title:      string,
 *   excerpt:    string,
 *   content:    string,
 *   category:   string,   // ls_category slug
 *   difficulty: string,   // ls_difficulty slug
 *   image:      string,   // URL
 *   duration:   string,
 *   video_url:  string,
 *   objectives: string,
 * } $data
 */
function ls_create_course( array $data ): void {
	$post_id = ls_seed_post( 'course', $data );
	if ( ! $post_id ) {
		return;
	}

	update_post_meta( $post_id, 'ls_course_duration', $data['duration'] ?? '' );
	update_post_meta( $post_id, 'ls_course_video_url', $data['video_url'] ?? '' );
	update_post_meta( $post_id, 'ls_course_objectives', $data['objectives'] ?? '' );
}

/**
 * Create a quiz post.
 *
 * @param array{
 *   title:      string,
 *   excerpt:    string,
 *   category:   string,
 *   difficulty: string,
 *   image:      string,
 *   questions:  array<array{
 *     text:    string,
 *     answers: array<array{ text: string, correct: bool }>,
 *   }>,
 * } $data
 */
function ls_create_quiz( array $data ): void {
	$post_id = ls_seed_post( 'quiz', $data );
	if ( ! $post_id ) {
		return;
	}

	$questions = $data['questions'] ?? [];
	update_post_meta( $post_id, 'ls_quiz_questions', count( $questions ) );

	foreach ( $questions as $qi => $question ) {
		update_post_meta( $post_id, "ls_quiz_questions_{$qi}_question_text", $question['text'] );
		update_post_meta( $post_id, "ls_quiz_questions_{$qi}_question_image", 0 );
		update_post_meta( $post_id, "ls_quiz_questions_{$qi}_question_answers", count( $question['answers'] ) );

		foreach ( $question['answers'] as $ai => $answer ) {
			update_post_meta( $post_id, "ls_quiz_questions_{$qi}_question_answers_{$ai}_answer_text", $answer['text'] );
			update_post_meta( $post_id,
				"ls_quiz_questions_{$qi}_question_answers_{$ai}_answer_is_correct",
				$answer['correct'] ? 1 : 0 );
		}
	}
}

/* ------------------------------------------------------------------ */
/* Shared helpers                                                       */
/* ------------------------------------------------------------------ */

function ls_sideload_image( string $url, int $post_id, string $title ): int {
	$tmp = download_url( $url );
	if ( is_wp_error( $tmp ) ) {
		WP_CLI::warning( "Image download failed: " . $tmp->get_error_message() );

		return 0;
	}

	$file_array = [
		'name'     => sanitize_title( $title ) . '.jpg',
		'tmp_name' => $tmp,
	];

	$attachment_id = media_handle_sideload( $file_array, $post_id, $title );

	if ( is_wp_error( $attachment_id ) ) {
		@unlink( $tmp );
		WP_CLI::warning( "Image sideload failed: " . $attachment_id->get_error_message() );

		return 0;
	}

	return $attachment_id;
}

function ls_seed_post( string $post_type, array $data ): int {
	$title = $data['title'];
	$query = new WP_Query( [
		'post_type'      => $post_type,
		'title'          => $title,
		'posts_per_page' => 1,
		'post_status'    => 'any',
		'fields'         => 'ids',
	] );

	if ( $query->have_posts() ) {
		WP_CLI::line( "Skip (exists): {$title}" );

		return 0;
	}

	$post_id = wp_insert_post( [
		'post_type'    => $post_type,
		'post_status'  => 'publish',
		'post_title'   => $title,
		'post_excerpt' => $data['excerpt'] ?? '',
		'post_content' => $data['content'] ?? '',
	], true );

	if ( is_wp_error( $post_id ) ) {
		WP_CLI::warning( "Failed: {$title} — " . $post_id->get_error_message() );

		return 0;
	}

	if ( ! empty( $data['category'] ) ) {
		$term = get_term_by( 'slug', $data['category'], 'ls_category' );
		if ( $term ) {
			wp_set_post_terms( $post_id, [ $term->term_id ], 'ls_category' );
		}
	}

	if ( ! empty( $data['difficulty'] ) ) {
		$term = get_term_by( 'slug', $data['difficulty'], 'ls_difficulty' );
		if ( $term ) {
			wp_set_post_terms( $post_id, [ $term->term_id ], 'ls_difficulty' );
		}
	}

	if ( ! empty( $data['image'] ) ) {
		$attachment_id = ls_sideload_image( $data['image'], $post_id, $title );
		if ( $attachment_id ) {
			set_post_thumbnail( $post_id, $attachment_id );
		}
	}

	WP_CLI::success( "Created [{$post_type}] {$title} (ID {$post_id})" );

	return $post_id;
}

/* ================================================================== */
/* Data                                                                 */
/* ================================================================== */

ls_create_course( [
	'title'      => 'Introduction à Python',
	'excerpt'    => 'Partez de zéro et écrivez vos premiers programmes Python en quelques heures.',
	'content'    => '<p>Python est l\'un des langages les plus accessibles et les plus puissants du marché. Ce cours vous guide pas à pas : installation de l\'environnement, syntaxe de base, structures de données (listes, dictionnaires, tuples), fonctions, gestion des exceptions et manipulation de fichiers. À la fin, vous serez capable d\'automatiser des tâches concrètes et de poser les bases d\'un projet plus ambitieux.</p>',
	'category'   => 'it',
	'difficulty' => 'easy',
	'image'      => 'https://picsum.photos/seed/python/800/450',
	'duration'   => '8h',
	'video_url'  => '',
	'objectives' => "Maîtriser la syntaxe de base de Python\nManipuler les types de données natifs\nÉcrire des fonctions réutilisables\nLire et écrire des fichiers",
] );

ls_create_course( [
	'title'      => 'Développement web avec React',
	'excerpt'    => 'Créez des interfaces modernes et réactives avec la bibliothèque JavaScript de Meta.',
	'content'    => '<p>React s\'est imposé comme le standard pour le développement front-end. Ce cours couvre l\'ensemble du socle : JSX, composants fonctionnels, props, state, hooks essentiels (useState, useEffect, useContext) et appels API. Chaque chapitre est accompagné d\'un mini-projet pour ancrer les concepts. Vous repartirez avec une application complète et des bases solides pour aborder des sujets avancés comme Redux ou Next.js.</p>',
	'category'   => 'it',
	'difficulty' => 'medium',
	'image'      => 'https://picsum.photos/seed/react/800/450',
	'duration'   => '15h',
	'video_url'  => '',
	'objectives' => "Créer des composants React fonctionnels\nGérer le state avec useState et useEffect\nConsommer une API REST\nStructurer une application React",
] );

ls_create_course( [
	'title'      => 'Bases du design graphique',
	'excerpt'    => 'Maîtrisez typographie, couleur et composition pour créer des visuels percutants.',
	'content'    => '<p>Le design est une discipline qui repose sur des règles précises. Ce cours vous enseigne les fondamentaux : grilles et mise en page, hiérarchie typographique, théorie des couleurs, principes de Gestalt et bonnes pratiques pour le digital. Les exercices pratiques sont réalisés sur Figma (gratuit). Aucune expérience préalable requise.</p>',
	'category'   => 'design',
	'difficulty' => 'easy',
	'image'      => 'https://picsum.photos/seed/design/800/450',
	'duration'   => '6h',
	'video_url'  => '',
	'objectives' => "Comprendre la grille et la composition\nAppliquer les règles typographiques\nUtiliser la couleur avec intention\nRéaliser des maquettes simples sur Figma",
] );

ls_create_course( [
	'title'      => 'Marketing digital — Stratégie & SEO',
	'excerpt'    => 'Construisez une présence en ligne efficace et attirez du trafic qualifié.',
	'content'    => '<p>Ce cours vous donne toutes les clés pour développer une stratégie de contenu rentable : définition des personas, audit SEO, rédaction optimisée, netlinking et mesure des performances. Vous apprendrez à utiliser Google Search Console, Semrush et Google Analytics 4 pour piloter votre croissance. Des études de cas réels illustrent chaque concept.</p>',
	'category'   => 'marketing',
	'difficulty' => 'medium',
	'image'      => 'https://picsum.photos/seed/seo/800/450',
	'duration'   => '10h',
	'video_url'  => '',
	'objectives' => "Réaliser un audit SEO complet\nRédiger du contenu optimisé pour le référencement\nConstruire une stratégie de netlinking\nAnalyser les KPIs avec Google Analytics 4",
] );

ls_create_course( [
	'title'      => 'Gestion de projet Agile',
	'excerpt'    => 'Pilotez vos projets avec Scrum et Kanban pour livrer plus vite, avec plus de valeur.',
	'content'    => '<p>L\'Agile n\'est pas qu\'une méthode, c\'est un état d\'esprit. Ce cours vous forme aux cérémonies Scrum (sprint planning, daily, review, retrospective), à la rédaction de user stories et à l\'utilisation de Jira et Trello. Vous apprendrez également à gérer les imprévus, à prioriser un backlog produit et à collaborer efficacement avec les parties prenantes.</p>',
	'category'   => 'business',
	'difficulty' => 'medium',
	'image'      => 'https://picsum.photos/seed/agile/800/450',
	'duration'   => '12h',
	'video_url'  => '',
	'objectives' => "Organiser et animer un sprint Scrum\nPrioriser un backlog produit\nRédiger des user stories exploitables\nAdapter la méthode à la réalité terrain",
] );

ls_create_course( [
	'title'      => 'Architecture logicielle avancée',
	'excerpt'    => 'SOLID, design patterns, microservices : concevez des systèmes robustes et évolutifs.',
	'content'    => '<p>Ce cours s\'adresse aux développeurs qui veulent franchir le cap de l\'architecture. Vous étudierez les cinq principes SOLID, les principaux design patterns (Factory, Observer, Strategy, Decorator…) et les décisions architecturales clés : monolithe vs microservices, event-driven architecture, CQRS. Chaque concept est illustré par des exemples de code en PHP et des revues d\'architecture commentées.</p>',
	'category'   => 'it',
	'difficulty' => 'hard',
	'image'      => 'https://picsum.photos/seed/architecture/800/450',
	'duration'   => '20h',
	'video_url'  => '',
	'objectives' => "Appliquer les principes SOLID\nImpémenter les design patterns courants\nChoisir entre monolithe et microservices\nConcevoir une architecture event-driven",
] );

/* ------------------------------------------------------------------ */

ls_create_quiz( [
	'title'      => 'Quiz Python — Les bases',
	'excerpt'    => 'Testez vos connaissances sur les fondamentaux de Python.',
	'category'   => 'it',
	'difficulty' => 'easy',
	'image'      => 'https://picsum.photos/seed/python-quiz/800/450',
	'questions'  => [
		[
			'text'    => 'Quelle fonction permet d\'afficher du texte en Python ?',
			'answers' => [
				[ 'text' => 'echo()', 'correct' => false ],
				[ 'text' => 'print()', 'correct' => true ],
				[ 'text' => 'console.log()', 'correct' => false ],
				[ 'text' => 'write()', 'correct' => false ],
			],
		],
		[
			'text'    => 'Quel opérateur est utilisé pour l\'exponentiation en Python ?',
			'answers' => [
				[ 'text' => '^', 'correct' => false ],
				[ 'text' => '**', 'correct' => true ],
				[ 'text' => 'exp()', 'correct' => false ],
				[ 'text' => '//', 'correct' => false ],
			],
		],
		[
			'text'    => 'Quel type de données est immuable en Python ?',
			'answers' => [
				[ 'text' => 'list', 'correct' => false ],
				[ 'text' => 'dict', 'correct' => false ],
				[ 'text' => 'tuple', 'correct' => true ],
				[ 'text' => 'set', 'correct' => false ],
			],
		],
	],
] );

ls_create_quiz( [
	'title'      => 'Quiz React — Composants & Hooks',
	'excerpt'    => 'Évaluez votre maîtrise des hooks et du cycle de vie des composants React.',
	'category'   => 'it',
	'difficulty' => 'medium',
	'image'      => 'https://picsum.photos/seed/react-quiz/800/450',
	'questions'  => [
		[
			'text'    => 'Quel hook permet de gérer un état local dans un composant fonctionnel ?',
			'answers' => [
				[ 'text' => 'useEffect', 'correct' => false ],
				[ 'text' => 'useState', 'correct' => true ],
				[ 'text' => 'useContext', 'correct' => false ],
				[ 'text' => 'useReducer', 'correct' => false ],
			],
		],
		[
			'text'    => 'Que retourne un composant React ?',
			'answers' => [
				[ 'text' => 'Du HTML brut', 'correct' => false ],
				[ 'text' => 'Du JSX', 'correct' => true ],
				[ 'text' => 'Un objet JavaScript', 'correct' => false ],
				[ 'text' => 'Une chaîne de caractères', 'correct' => false ],
			],
		],
		[
			'text'    => 'Quel hook effectue des effets de bord après le rendu ?',
			'answers' => [
				[ 'text' => 'useState', 'correct' => false ],
				[ 'text' => 'useMemo', 'correct' => false ],
				[ 'text' => 'useEffect', 'correct' => true ],
				[ 'text' => 'useRef', 'correct' => false ],
			],
		],
	],
] );

ls_create_quiz( [
	'title'      => 'Quiz Design — Théorie des couleurs',
	'excerpt'    => 'Validez vos connaissances sur la palette, le contraste et l\'harmonie chromatique.',
	'category'   => 'design',
	'difficulty' => 'easy',
	'image'      => 'https://picsum.photos/seed/design-quiz/800/450',
	'questions'  => [
		[
			'text'    => 'Quelles sont les couleurs primaires en synthèse soustractive (impression) ?',
			'answers' => [
				[ 'text' => 'Rouge, vert, bleu', 'correct' => false ],
				[ 'text' => 'Cyan, magenta, jaune', 'correct' => true ],
				[ 'text' => 'Bleu, jaune, rouge', 'correct' => false ],
				[ 'text' => 'Orange, violet, vert', 'correct' => false ],
			],
		],
		[
			'text'    => 'Quel ratio de contraste minimum exige le standard WCAG AA pour du texte normal ?',
			'answers' => [
				[ 'text' => '2:1', 'correct' => false ],
				[ 'text' => '3:1', 'correct' => false ],
				[ 'text' => '4.5:1', 'correct' => true ],
				[ 'text' => '7:1', 'correct' => false ],
			],
		],
	],
] );

ls_create_quiz( [
	'title'      => 'Quiz SEO — Référencement naturel',
	'excerpt'    => 'Mesurez votre niveau sur les techniques de référencement on-page et off-page.',
	'category'   => 'marketing',
	'difficulty' => 'medium',
	'image'      => 'https://picsum.photos/seed/seo-quiz/800/450',
	'questions'  => [
		[
			'text'    => 'Quelle balise HTML est la plus importante pour le SEO on-page ?',
			'answers' => [
				[ 'text' => '<meta description>', 'correct' => false ],
				[ 'text' => '<title>', 'correct' => true ],
				[ 'text' => '<h2>', 'correct' => false ],
				[ 'text' => '<alt>', 'correct' => false ],
			],
		],
		[
			'text'    => 'Qu\'est-ce qu\'un backlink ?',
			'answers' => [
				[ 'text' => 'Un lien interne entre deux pages du même site', 'correct' => false ],
				[ 'text' => 'Un lien provenant d\'un site externe vers votre site', 'correct' => true ],
				[ 'text' => 'Un lien vers une ancre sur la même page', 'correct' => false ],
				[ 'text' => 'Un lien cassé (404)', 'correct' => false ],
			],
		],
		[
			'text'    => 'Quel outil Google permet d\'analyser les performances de recherche d\'un site ?',
			'answers' => [
				[ 'text' => 'Google Analytics', 'correct' => false ],
				[ 'text' => 'Google Ads', 'correct' => false ],
				[ 'text' => 'Google Search Console', 'correct' => true ],
				[ 'text' => 'Google Tag Manager', 'correct' => false ],
			],
		],
	],
] );

ls_create_quiz( [
	'title'      => 'Quiz Architecture — Patrons de conception',
	'excerpt'    => 'Défi avancé sur les design patterns et principes SOLID.',
	'category'   => 'it',
	'difficulty' => 'hard',
	'image'      => 'https://picsum.photos/seed/archi-quiz/800/450',
	'questions'  => [
		[
			'text'    => 'Que garantit le principe de responsabilité unique (SRP) ?',
			'answers' => [
				[ 'text' => 'Une classe ne dépend que de classes abstraites', 'correct' => false ],
				[ 'text' => 'Une classe n\'a qu\'une seule raison de changer', 'correct' => true ],
				[ 'text' => 'Une classe peut être étendue sans être modifiée', 'correct' => false ],
				[ 'text' => 'Les interfaces sont segmentées par responsabilité', 'correct' => false ],
			],
		],
		[
			'text'    => 'Quel pattern permet de créer des objets sans spécifier leur classe concrète ?',
			'answers' => [
				[ 'text' => 'Observer', 'correct' => false ],
				[ 'text' => 'Decorator', 'correct' => false ],
				[ 'text' => 'Factory Method', 'correct' => true ],
				[ 'text' => 'Singleton', 'correct' => false ],
			],
		],
		[
			'text'    => 'Dans une architecture microservices, comment les services communiquent-ils de façon asynchrone ?',
			'answers' => [
				[ 'text' => 'Via des appels HTTP REST directs', 'correct' => false ],
				[ 'text' => 'Via un message broker (RabbitMQ, Kafka…)', 'correct' => true ],
				[ 'text' => 'Via une base de données partagée', 'correct' => false ],
				[ 'text' => 'Via des WebSockets persistants', 'correct' => false ],
			],
		],
	],
] );

WP_CLI::line( 'Seed terminé.' );
