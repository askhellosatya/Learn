<?php
/**
 * Template part for displaying the idea submission form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WPBBP
 */

$idea_submitted = false;
if ( isset( $_POST['idea-submitted'] ) && 'submitted' == $_POST['idea-submitted'] ) {
	$idea_submitted = wporg_process_submitted_idea( $_POST );
}

if ( is_single() ) {
	$form_action = get_permalink();
} else {
	$form_action = get_post_type_archive_link( 'wporg_idea' );
}

if ( isset( $_GET['status'] ) ) {
	 $form_action .= '?status=' . esc_attr( $_GET['status'] );
}

if ( isset( $_GET['idea-type'] ) ) {
	 $form_action .= '&idea-type=' . esc_attr( $_GET['idea-type'] );
}

if ( isset( $_GET['ordering'] ) ) {
	 $form_action .= '&ordering=' . esc_attr( $_GET['ordering'] );
}

if ( $idea_submitted ) { ?>
	<div class="notice notice-success notice-alt notice-idea-submitted">
		<p><?php esc_html_e( 'Thank you for submitting your content idea!', 'wporg-learn' ); ?></p>
	</div>
	<script>
		if ( window.history.replaceState ) {
			window.history.replaceState( null, '', window.location.href );
		}
	</script>
<?php } ?>

<div class="card">

	<h3 class="h4"><?php esc_html_e( 'Submit an idea', 'wporg-learn' ); ?></h3>

	<?php if ( is_user_logged_in() ) { ?>

		<form class="contact-form" method="post" action="<?php echo esc_url( $form_action ); ?>">

			<p>
				<?php esc_html_e( 'Is there a topic that you would like to see covered on Learn WordPress? Submit your idea here:', 'wporg-learn' ); ?>
			</p>

			<p>
				<textarea name="idea_description" class="textarea" rows="6" maxlength="500" placeholder="<?php esc_attr_e( 'Describe your content idea...', 'wporg-learn' ); ?>"></textarea><br/>
			</p>

			<p>
				<?php esc_html_e( 'Type: ', 'wporg-learn' ); ?>
				<select name="idea_type">
					<option value="tutorial"><?php esc_html_e( 'Tutorial', 'wporg-learn' ); ?></option>
					<option value="online-workshop"><?php esc_html_e( 'Online Workshop', 'wporg-learn' ); ?></option>
					<option value="course"><?php esc_html_e( 'Course', 'wporg-learn' ); ?></option>
					<option value="lesson-plan"><?php esc_html_e( 'Lesson Plan', 'wporg-learn' ); ?></option>
				</select>
			</p>

			<?php wp_nonce_field( 'submit_idea' ); ?>

			<input type="hidden" name="idea-submitted" value="submitted" />
			<input type="submit" value="<?php esc_attr_e( 'Submit', 'wporg-learn' ); ?>" class="button button-primary button-large" />

		</form>

	<?php } else {
		esc_html_e( 'You must be logged in to submit content ideas.', 'wporg-learn' );
	} ?>

</div>
