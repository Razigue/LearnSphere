<?php
/**
 * Quiz render — shortcode [ls_quiz].
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_shortcode( 'ls_quiz', 'learnsphere_render_quiz' );

function learnsphere_render_quiz( $atts ) {
	$post_id = get_the_ID();

	if ( get_post_type( $post_id ) !== 'quiz' ) {
		return '<p class="ls-quiz-error">Ce shortcode ne fonctionne que sur une page quiz.</p>';
	}

	$num_questions = (int) get_post_meta( $post_id, 'ls_quiz_questions', true );
	if ( $num_questions < 1 ) {
		return '<p class="ls-quiz-error">Aucune question pour ce quiz.</p>';
	}

	$questions = [];
	for ( $i = 0; $i < $num_questions; $i++ ) {
		$q            = [];
		$q['text']    = get_post_meta( $post_id, "ls_quiz_questions_{$i}_question_text", true );
		$q['image']   = (int) get_post_meta( $post_id, "ls_quiz_questions_{$i}_question_image", true );
		$num_answers  = (int) get_post_meta( $post_id, "ls_quiz_questions_{$i}_question_answers", true );
		$q['answers'] = [];
		for ( $j = 0; $j < $num_answers; $j++ ) {
			$q['answers'][] = [
				'text'    => get_post_meta( $post_id, "ls_quiz_questions_{$i}_question_answers_{$j}_answer_text", true ),
				'correct' => (int) get_post_meta( $post_id, "ls_quiz_questions_{$i}_question_answers_{$j}_answer_is_correct", true ),
			];
		}
		$questions[] = $q;
	}

	$submitted    = false;
	$score        = 0;
	$total        = count( $questions );
	$user_answers = [];

	if ( isset( $_POST['ls_quiz_submit'] ) && wp_verify_nonce( $_POST['ls_quiz_nonce'], 'ls_quiz_submit_' . $post_id ) ) {
		$submitted = true;
		foreach ( $questions as $i => $q ) {
			$user_answers[ $i ] = isset( $_POST['ls_q'][ $i ] ) ? (int) $_POST['ls_q'][ $i ] : -1;
			if ( $user_answers[ $i ] >= 0 && isset( $q['answers'][ $user_answers[ $i ] ] ) && $q['answers'][ $user_answers[ $i ] ]['correct'] === 1 ) {
				$score++;
			}
		}
	}

	ob_start();

	if ( $submitted ) :
		$percentage = $total > 0 ? round( ( $score / $total ) * 100 ) : 0;
		?>
		<div class="ls-quiz-result">
			<h2 class="ls-quiz-result__title">Votre score</h2>
			<p class="ls-quiz-result__score">
				<?php echo esc_html( $score ); ?> / <?php echo esc_html( $total ); ?>
				<span class="ls-quiz-result__pct"> (<?php echo esc_html( $percentage ); ?>%)</span>
			</p>
		</div>

		<h3 class="ls-quiz-correction-heading">Correction</h3>

		<?php foreach ( $questions as $i => $q ) : ?>
			<div class="ls-quiz-correction">
				<p class="ls-quiz-correction__question">
					<strong>Question <?php echo esc_html( $i + 1 ); ?> :</strong>
					<?php echo esc_html( $q['text'] ); ?>
				</p>

				<?php if ( $q['image'] > 0 ) : ?>
					<figure class="ls-quiz-correction__image">
						<?php echo wp_get_attachment_image( $q['image'], 'medium' ); ?>
					</figure>
				<?php endif; ?>

				<div class="ls-quiz-correction__answers">
					<?php foreach ( $q['answers'] as $j => $answer ) :
						$is_correct     = $answer['correct'] === 1;
						$is_user_choice = ( $user_answers[ $i ] === $j );
						$mod_class      = $is_correct ? 'ls-quiz-correct' : ( $is_user_choice ? 'ls-quiz-wrong' : '' );
						?>
						<div class="ls-quiz-answer <?php echo esc_attr( $mod_class ); ?>">
							<?php echo esc_html( $answer['text'] ); ?>
							<?php if ( $is_correct ) : ?>
								<span class="ls-quiz-answer__icon ls-quiz-answer__icon--check">&#10004;</span>
							<?php endif; ?>
							<?php if ( $is_user_choice && ! $is_correct ) : ?>
								<span class="ls-quiz-answer__icon ls-quiz-answer__icon--cross">&#10008;</span>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endforeach; ?>

		<p class="ls-quiz-retry-wrapper">
			<a class="ls-quiz-retry" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">Recommencer le quiz</a>
		</p>

	<?php else : ?>

		<form method="post" class="ls-quiz-form">
			<?php wp_nonce_field( 'ls_quiz_submit_' . $post_id, 'ls_quiz_nonce' ); ?>

			<?php foreach ( $questions as $i => $q ) : ?>
				<div class="ls-quiz-question">
					<p class="ls-quiz-question__num">
						<strong>Question <?php echo esc_html( $i + 1 ); ?> / <?php echo esc_html( $total ); ?></strong>
					</p>
					<p class="ls-quiz-question__text"><?php echo esc_html( $q['text'] ); ?></p>

					<?php if ( $q['image'] > 0 ) : ?>
						<figure class="ls-quiz-question__image">
							<?php echo wp_get_attachment_image( $q['image'], 'medium' ); ?>
						</figure>
					<?php endif; ?>

					<div class="ls-quiz-answers">
						<?php foreach ( $q['answers'] as $j => $answer ) : ?>
							<label class="ls-quiz-answer">
								<input type="radio" name="ls_q[<?php echo esc_attr( $i ); ?>]" value="<?php echo esc_attr( $j ); ?>" required>
								<span><?php echo esc_html( $answer['text'] ); ?></span>
							</label>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endforeach; ?>

			<p class="ls-quiz-submit-wrapper">
				<button type="submit" name="ls_quiz_submit" value="1" class="ls-quiz-submit">
					Valider mes réponses
				</button>
			</p>
		</form>
		<?php
	endif;

	return ob_get_clean();
}
