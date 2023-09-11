<?php
/**
 * LearnDash LD30 Displays a topic.
 *
 * Available Variables:
 *
 * $course_id                 : (int) ID of the course
 * $course                    : (object) Post object of the course
 * $course_settings           : (array) Settings specific to current course
 * $course_status             : Course Status
 * $has_access                : User has access to course or is enrolled.
 *
 * $courses_options            : Options/Settings as configured on Course Options page
 * $lessons_options            : Options/Settings as configured on Lessons Options page
 * $quizzes_options            : Options/Settings as configured on Quiz Options page
 *
 * $user_id                    : (object) Current User ID
 * $logged_in                  : (true/false) User is logged in
 * $current_user               : (object) Currently logged in user object
 * $quizzes                    : (array) Quizzes Array
 * $post                       : (object) The topic post object
 * $lesson_post                : (object) Lesson post object in which the topic exists
 * $topics                     : (array) Array of Topics in the current lesson
 * $all_quizzes_completed      : (true/false) User has completed all quizzes on the lesson Or, there are no quizzes.
 * $lesson_progression_enabled : (true/false)
 * $show_content               : (true/false) true if lesson progression is disabled or if previous lesson and topic is completed.
 * $previous_lesson_completed  : (true/false) true if previous lesson is completed
 * $previous_topic_completed   : (true/false) true if previous topic is completed
 *
 * @since 3.0.0
 *
 * @package LearnDash\Templates\LD30
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="<?php echo esc_attr( learndash_the_wrapper_class() ); ?>">
	<?php
	/**
	 * Fires before the topic
	 *
	 * @since 3.0.0
	 * @param int $course_id Course ID.
	 * @param int $user_id   User ID.
	 */
	do_action( 'learndash-topic-before', get_the_ID(), $course_id, $user_id );

	if ( ( defined( 'LEARNDASH_TEMPLATE_CONTENT_METHOD' ) ) && ( 'shortcode' === LEARNDASH_TEMPLATE_CONTENT_METHOD ) ) {
		$shown_content_key = 'learndash-shortcode-wrap-ld_infobar-' . absint( $course_id ) . '_' . (int) get_the_ID() . '_' . absint( $user_id );
		if ( false === strstr( $content, $shown_content_key ) ) {
			$shortcode_out = do_shortcode( '[ld_infobar course_id="' . $course_id . '" user_id="' . $user_id . '" post_id="' . get_the_ID() . '"]' );
			if ( ! empty( $shortcode_out ) ) {
				echo $shortcode_out;
			}
		}
	} else {
		learndash_get_template_part(
			'modules/infobar.php',
			array(
				'context'   => 'topic',
				'course_id' => $course_id,
				'user_id'   => $user_id,
			),
			true
		);
	}

	/**
	 * If the user needs to complete the previous lesson AND topic display an alert
	 */

	$sub_context = '';
	if ( ( $lesson_progression_enabled ) && ( ! learndash_user_progress_is_step_complete( $user_id, $course_id, $post->ID ) ) ) {
		$previous_item = learndash_get_previous( $post );
		if ( ( ! $previous_topic_completed ) || ( empty( $previous_item ) ) ) {
			if ( 'on' === learndash_get_setting( $lesson_post->ID, 'lesson_video_enabled' ) ) {
				if ( ! empty( learndash_get_setting( $lesson_post->ID, 'lesson_video_url' ) ) ) {
					if ( 'BEFORE' === learndash_get_setting( $lesson_post->ID, 'lesson_video_shown' ) ) {
						if ( ! learndash_video_complete_for_step( $lesson_post->ID, $course_id, $user_id ) ) {
							$sub_context = 'video_progression';
						}
					}
				}
			}
		}
	}

	if ( ( $lesson_progression_enabled ) && ( ! empty( $sub_context ) || ! $previous_topic_completed || ! $previous_lesson_completed ) ) {

		if ( ( ! learndash_is_sample( $post ) ) /* || ( learndash_is_sample( $post ) && true === (bool) $has_access ) */ ) {

			if ( 'video_progression' === $sub_context ) {
				$previous_item = $lesson_post;
			} else {
				$previous_item_id = learndash_user_progress_get_previous_incomplete_step( $user_id, $course_id, $post->ID );
				if ( ( ! empty( $previous_item_id ) ) && ( $previous_item_id !== $post->ID ) ) {	
					$previous_item = get_post( $previous_item_id );
				}
			}

			if ( ( isset( $previous_item ) ) && ( ! empty( $previous_item ) ) ) {
				$show_content = false;
				learndash_get_template_part(
					'modules/messages/lesson-progression.php',
					array(
						'previous_item' => $previous_item,
						'course_id'     => $course_id,
						'context'       => 'topic',
						'sub_context'   => $sub_context,
					),
					true
				);
			}
		}
	}
	
	if ( $show_content ) :
		

		learndash_get_template_part(
			'modules/tabs.php',
			array(
				'course_id' => $course_id,
				'post_id'   => get_the_ID(),
				'user_id'   => $user_id,
				'content'   => $content,
				'materials' => $materials,
				'context'   => 'topic',
			),
			true
		);
		
/* 		if ( ( defined( 'LEARNDASH_TEMPLATE_CONTENT_METHOD' ) ) && ( 'shortcode' === LEARNDASH_TEMPLATE_CONTENT_METHOD ) ) {

			$shown_content_key = 'learndash-shortcode-wrap-course_content-' . absint( $course_id ) . '_' . (int) get_the_ID() . '_' . absint( $user_id );
			if ( false === strstr( $content, $shown_content_key ) ) {
				$shortcode_out = do_shortcode( '[course_content course_id="' . $course_id . '" user_id="' . $user_id . '" post_id="' . get_the_ID() . '"]' );
				if ( ! empty( $shortcode_out ) ) {
					echo $shortcode_out;
				}
			}
		} else {
 */
			/**
			 * Display Lesson Assignments
			 */
			if ( learndash_lesson_hasassignments( $post ) && ! empty( $user_id ) ) :
			
			
				$bypass_course_limits_admin_users = learndash_can_user_bypass( $user_id, 'learndash_lesson_assignment' );
				$course_children_steps_completed  = learndash_user_is_course_children_progress_complete( $user_id, $course_id, $post->ID );
				if ( ( learndash_lesson_progression_enabled() && $course_children_steps_completed ) || ! learndash_lesson_progression_enabled() || $bypass_course_limits_admin_users ) :

					/**
					 * Fires before the lesson assignment.
					 *
					 * @since 3.0.0
					 *
					 * @param int $post_id   Post ID.
					 * @param int $course_id Course ID.
					 * @param int $user_id   User ID.
					 */
					do_action( 'learndash-lesson-assignment-before', get_the_ID(), $course_id, $user_id );

					 
					//NBCS Hack - Load Assignment editor: 
					
					if( !nb_role_is( 'reader' ) && !nb_role_is( 'inactive' ) ):

						$grades = new Doula_Course\App\Clss\Grades\Grades( );
						$grades->build( $current_user->ID  ); 

						//This is the logic that allows for a grade to be submitted for a specific assignment, but not have "assignment" CPT attached to the grades, so that a trainer may override a required assignment submission. 
						if( !empty( $grades->get_grade_by_id( $post->ID ) ) && empty( $grades->assignment_exists( $post->ID ) ) ):
							
							$asmt_status_string = $grades->get_grade_status(  $post->ID  );

							echo "<hr>
							<div class='asmt_submitted'> 
								<h3>Assignment Submitted</h3>
								<p><em>This assignment is already marked as <strong>{$asmt_status_string}</strong>, but was submitted some other way, probably via email.</em></p>
							</div>";
						else: ?>

							<p><a class="button" href="#asmt-editor">Jump to Assignment Editor &darr;</a></p>
							<hr style="clear: both;">
							<div class="asmt-editor"> 
								<h2 id="asmt-editor">Assignment Editor</h2>
								<?php // We may want to insert comments on the assignment here? Toggle Visibility. ?>

								<?php  include_once( DOULA_COURSE_PATH.'app/tmpl/assignment-editor.php' ); ?>
								
							</div><!-- end asmt-editor --> 		

							<?php 
							// Restore original Post Data //
							wp_reset_postdata();

						endif;
					else:
					
						echo "<hr>
							<div class='asmt_submitted'> 
								<p><em>(Assignment editor is unavailable in reader-only mode.)</em></p>
							</div>";

					endif; //end if not reader or inactive user. 
						
					//END NBCS Hack - Assignment Editor; 	
					
					
					

					/**
					 * Fires after the lesson assignment.
					 *
					 * @since 3.0.0
					 *
					 * @param int $post_id   Post ID.
					 * @param int $course_id Course ID.
					 * @param int $user_id   User ID.
					 */
					do_action( 'learndash-lesson-assignment-after', get_the_ID(), $course_id, $user_id );

				endif;
			endif;

			if ( ! empty( $quizzes ) ) :

				learndash_get_template_part(
					'quiz/listing.php',
					array(
						'user_id'   => $user_id,
						'course_id' => $course_id,
						'lesson_id' => $lesson_id,
						'quizzes'   => $quizzes,
						'context'   => 'topic',
					),
					true
				);

			endif;
/* 		} */
	endif; // $show_content

	if ( ( defined( 'LEARNDASH_TEMPLATE_CONTENT_METHOD' ) ) && ( 'shortcode' === LEARNDASH_TEMPLATE_CONTENT_METHOD ) ) {
		$shown_content_key = 'learndash-shortcode-wrap-ld_navigation-' . absint( $course_id ) . '_' . (int) get_the_ID() . '_' . absint( $user_id );
		if ( false === strstr( $content, $shown_content_key ) ) {
			$shortcode_out = do_shortcode( '[ld_navigation course_id="' . $course_id . '" user_id="' . $user_id . '" post_id="' . get_the_ID() . '"]' );
			if ( ! empty( $shortcode_out ) ) {
				echo $shortcode_out;
			}
		}
		
	} else {

		$can_complete = false;
		
		if ( $all_quizzes_completed && $logged_in && ! empty( $course_id ) ) :
			/** This filter is documented in themes/ld40/templates/lesson.php */
			$can_complete = apply_filters( 'learndash-lesson-can-complete', true, get_the_ID(), $course_id, $user_id );
		endif;

		learndash_get_template_part(
			'modules/course-steps.php',
			array(
				'course_id'             => $course_id,
				'course_step_post'      => $post,
				'all_quizzes_completed' => $all_quizzes_completed,
				'user_id'               => $user_id,
				'course_settings'       => isset( $course_settings ) ? $course_settings : array(),
				'context'               => 'topic',
				'can_complete'          => $can_complete,
			),
			true
		);
	}

	/**
	 * Fires after the topic.
	 *
	 * @since 3.0.0
	 *
	 * @param int $post_id   Current Post ID.
	 * @param int $course_id Course ID.
	 * @param int $user_id   User ID.
	 */
	do_action( 'learndash-topic-after', get_the_ID(), $course_id, $user_id );
	learndash_load_login_modal_html();
	?>
</div> <!--/.learndash-wrapper-->
