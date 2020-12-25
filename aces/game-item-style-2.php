<?php
global $post;
$game_allowed_html = array(
	'a' => array(
		'href' => true,
		'title' => true,
		'target' => true,
		'rel' => true
	),
	'br' => array(),
	'em' => array(),
	'strong' => array(),
	'span' => array(
		'class' => true
	),
	'div' => array(
		'class' => true
	),
	'p' => array()
);

$game_external_link = esc_url( get_post_meta( get_the_ID(), 'game_external_link', true ) );
$game_button_title = esc_html( get_post_meta( get_the_ID(), 'game_button_title', true ) );
$game_button_notice = wp_kses( get_post_meta( get_the_ID(), 'game_button_notice', true ), $game_allowed_html );
$game_permalink_button_title = esc_html( get_post_meta( get_the_ID(), 'game_permalink_button_title', true ) );
$game_rating = esc_html( get_post_meta( get_the_ID(), 'game_rating_one', true ) );

if ($game_button_title) {
	$button_title = $game_button_title;
} else {
	if ( get_option( 'games_play_now_title') ) {
		$button_title = esc_html( get_option( 'games_play_now_title') );
	} else {
		$button_title = esc_html__( 'Play Now', 'mercury' );
	}
}

if ($game_external_link) {
	$external_link_url = $game_external_link;
} else {
	$external_link_url = get_the_permalink();
}

if ($game_permalink_button_title) {
	$permalink_button_title = $game_permalink_button_title;
} else {
	if ( get_option( 'games_read_review_title') ) {
		$permalink_button_title = esc_html( get_option( 'games_read_review_title') );
	} else {
		$permalink_button_title = esc_html__( 'Read Review', 'mercury' );
	}
}

$terms = get_the_terms( $post->ID, 'game-category' );
?>

<div class="space-games-3-archive-item box-25 relative">
	<div class="space-games-3-archive-item-ins relative">
		<div class="space-games-3-archive-item-img-wrap box-100 relative">
		<?php $image = get_field('game_cover_image'); if( $image ) { ?>
				<img src="<?php echo $image; ?>" alt="<?php the_title_attribute(); ?>">
			<?php } ?>
			
			<div class="space-games-3-archive-item-overlay space-overlay absolute">

				<?php if ($game_rating) {
					if( function_exists('wp_star_rating') ){
				?>

					<div class="space-games-3-archive-item-rating absolute">
						<span><i class="fas fa-star"></i></span><strong><?php echo esc_html( number_format( round( $game_rating, 1 ), 1, '.', ',') ); ?></strong><?php echo esc_html__( '/5', 'mercury' ); ?>
					</div>

				<?php
					}
				} ?>

				<div class="space-games-3-archive-item-central text-center relative">

					<?php if ($terms) { ?>
					<div class="space-games-3-archive-item-category relative">
						<?php foreach ( $terms as $term ) { ?>
					        <a href="<?php echo esc_url (get_term_link( (int)$term->term_id, $term->taxonomy )); ?>" title="<?php echo esc_attr($term->name); ?>"><?php echo esc_html($term->name); ?></a>
					    <?php } ?>
					</div>
					<?php } ?>

					<div class="space-games-3-archive-item-title relative">
						<?php the_title(); ?>
					</div>

					<?php if ($game_external_link) { ?>

					<div class="space-games-3-archive-item-button1 relative">
						<a href="<?php echo esc_url( $external_link_url ); ?>" title="<?php echo esc_attr( $button_title ); ?>" <?php if ($game_external_link) { ?>target="_blank" rel="nofollow"<?php } ?>><?php echo esc_html( $button_title ); ?></a>
					</div>

					<?php } ?>

					<div class="space-games-3-archive-item-button2 relative">
						<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( $permalink_button_title ); ?>"><?php echo esc_html( $permalink_button_title ); ?></a>
					</div>
				</div>

				<?php if ($game_button_notice) { ?>

				<div class="space-games-3-archive-item-tac absolute">
					
					<?php echo wp_kses( $game_button_notice, $game_allowed_html ); ?>

				</div>

				<?php } ?>

			</div>
		</div>
	</div>
</div>