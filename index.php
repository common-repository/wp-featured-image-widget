<?php
/**
 * Plugin Name: WP Featured image widget
 * Plugin URI: http://wordpress.org/extend/plugins/wp-featured-image-widget/
 * Description: This widget shows the featured image for posts and pages with jquery slider.
 * Version: 0.1
 * Author: Nanhe Kumar
 * Author URI: http://www.nanhe.in/
 */

class WPFeaturedImageWidget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'WPFeaturedImageWidget', // Base ID
			__( 'WP Featured Image Widget', 'wp_featured_image_widget' ), // Name
			array( 'description' => __( 'This widget shows the featured image for posts and pages, you can set post and page link', 'wp_featured_image_widget' ), ) // Args
		);
	}

	function form($instance) {
		$title = esc_attr($instance['title']);
		$instance['image-size']             = ( ! $instance['image-size'] || $instance['image-size'] == '' ) ? 'post-thumbnail' : $instance['image-size'];
		$instance['image-link']             = ( ! $instance['image-link'] || $instance['image-link'] == '' ) ? 'off' : $instance['image-link'];
		$instance['image-parent']           = ( ! $instance['image-parent'] || $instance['image-parent'] == '' ) ? 'off' : $instance['image-parent'];
		$instance['image-slider']           = ( ! $instance['image-parent'] || $instance['image-parent'] == '' ) ? 'off' : $instance['image-slider'];
		$instance['image-slider-autoplay']  = ( ! $instance['image-slider-autoplay'] || $instance['image-slider-autoplay'] == '' ) ? 'off' : $instance['image-slider-autoplay'];
		$instance['image-slider-infinite']  = ( ! $instance['image-slider-infinite'] || $instance['image-slider-infinite'] == '' ) ? 'off' : $instance['image-slider-infinite'];
		$instance['image-slider-arrows']    = ( ! $instance['image-slider-arrows'] || $instance['image-slider-arrows'] == '' ) ? 'off' : $instance['image-slider-arrows'];
		$instance['image-slider-animation'] = ( ! $instance['image-slider-animation'] || $instance['image-slider-animation'] == '' ) ? '' : $instance['image-slider-animation'];
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				<?php _e('Title:', 'featured_image_widget' ); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('image-size'); ?>"><?php _e( 'Image size to display:', 'featured_image_widget' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('image-size'); ?>" name="<?php echo $this->get_field_name('image-size'); ?>">
			<?php foreach (get_intermediate_image_sizes() as $intermediate_image_size) : ?>
			<?php $selected = ($instance['image-size'] == $intermediate_image_size) ? ' selected="selected"' : '';?>
				<option value="<?php echo $intermediate_image_size; ?>"<?php echo $selected; ?>><?php echo $intermediate_image_size; ?></option>
			<?php endforeach; ?>
			</select>
		</p>
		<p>
			<?php $checked = ($instance['image-link'] == 'on') ? ' checked="checked"' : ''; ?>
			<input class="checkbox" id="<?php echo $this->get_field_id('image-link'); ?>" name="<?php echo $this->get_field_name('image-link'); ?>" type="checkbox" value="on" <?php echo $checked; ?>>
			<label for="<?php echo $this->get_field_id('image-link'); ?>">Enable post/page link?</label>
		</p>
		<p>
			<?php $checked = ($instance['image-parent'] == 'on') ? ' checked="checked"' : ''; ?>
			<input class="checkbox" id="<?php echo $this->get_field_id('image-parent'); ?>" name="<?php echo $this->get_field_name('image-parent'); ?>" type="checkbox" value="on" <?php echo $checked; ?>>
			<label for="<?php echo $this->get_field_id('image-parent'); ?>">Enable parent featured image ?</label>
		</p>
		<p>
			<?php $checked = ($instance['image-slider'] == 'on') ? ' checked="checked"' : ''; ?>
			<input class="checkbox" id="<?php echo $this->get_field_id('image-slider'); ?>" name="<?php echo $this->get_field_name('image-slider'); ?>" type="checkbox" value="on" <?php echo $checked; ?>>
			<label for="<?php echo $this->get_field_id('image-slider'); ?>">Enable image slider ?</label>
		</p>
		<p>
			<?php $checked = ($instance['image-slider-autoplay'] == 'on') ? ' checked="checked"' : ''; ?>
			<input class="checkbox" id="<?php echo $this->get_field_id('image-slider-autoplay'); ?>" name="<?php echo $this->get_field_name('image-slider-autoplay'); ?>" type="checkbox" value="on" <?php echo $checked; ?>>
			<label for="<?php echo $this->get_field_id('image-slider-autoplay'); ?>">Enable slider autoplay ?</label>
		</p>
		<p>
			<?php $checked = ($instance['image-slider-infinite'] == 'on') ? ' checked="checked"' : ''; ?>
			<input class="checkbox" id="<?php echo $this->get_field_id('image-slider-infinite'); ?>" name="<?php echo $this->get_field_name('image-slider-infinite'); ?>" type="checkbox" value="on" <?php echo $checked; ?>>
			<label for="<?php echo $this->get_field_id('image-slider-infinite'); ?>">Enable slider autoplay infinite ?</label>
		</p>
		<p>
			<?php $checked = ($instance['image-slider-arrows'] == 'on') ? ' checked="checked"' : ''; ?>
			<input class="checkbox" id="<?php echo $this->get_field_id('image-slider-arrows'); ?>" name="<?php echo $this->get_field_name('image-slider-arrows'); ?>" type="checkbox" value="on" <?php echo $checked; ?>>
			<label for="<?php echo $this->get_field_id('image-slider-arrows'); ?>">Disable  slider arrows ?</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('image-slider-animation'); ?>"><?php _e( 'Image slider animation:', 'featured_image_widget' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('image-slider-animation'); ?>" name="<?php echo $this->get_field_name('image-slider-animation'); ?>">
				<option value="" <?php echo ($instance['image-slider-animation'] == '' ) ? ' selected="selected"' : '';?>>Default</option>
				<option value="1" <?php echo ($instance['image-slider-animation'] == 1 ) ? ' selected="selected"' : '';?> >vertical</option>
				<option value="2" <?php echo ($instance['image-slider-animation'] == 2 ) ? ' selected="selected"' : '';?>>Fade</option>

			</select>
		</p>

	<?php
	}

	function update($new_instance, $old_instance) {
		$new_instance['title'] = strip_tags($new_instance['title']);
		return $new_instance;
	}

	public function debug($a){
		echo "<pre>";
		print_r($a);
		echo "</pre>";
	}

	function widget($args, $instance) {    
		extract($args);
		$size       = $instance['image-size'];
		$link       = $instance['image-link'];
		$parent     = $instance['image-parent'];
		$slider     = $instance['image-slider'];
		$autoplay   = $instance['image-slider-autoplay'];
		$infinite   = $instance['image-slider-infinite'];
		$arrows     = $instance['image-slider-arrows'];
		$animation  = $instance['image-slider-animation'];
		$title      = apply_filters('widget_title', $instance['title']);
		$settings    = array ( );
		if( $autoplay) { 
			$settings[] = 'autoplay: true';
		}
		if( $infinite) { 
			$settings[] = 'infinite: true';
		}
		if( $arrows) { 
			$settings[] = 'arrows: false';
		}
		if ( $animation && 1 === intval($animation)   ) {
			$settings[]     = "animation: 'vertical'";
		} else if( $animation && 2 === intval($animation) ) {
			$settings[]     = "animation: 'fade'";
		}

		echo $before_widget;
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
		if ( $slider ) {
			echo '<div class="wp-featured-image-widget">';
			echo '<ul>';
		}
		
		while ( have_posts() ) : the_post();

			if ( has_post_thumbnail() ) {
				if ( $slider ) {
					echo '<li>';
				}
				if ( $link ) {
		 ?>
					<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
						<?php the_post_thumbnail( $size , array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
					</a>
		<?php
				} else { 
					the_post_thumbnail( $size );
				}
				if ( $slider ) {
					echo '</li>';
				}
			} else if ( $parent && has_post_thumbnail( wp_get_post_parent_id( get_the_ID() ) ) ) {
				if ( $slider ) {
					echo '<li>';
				}
				if ( $link ) { 
		?>
					<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
						<?php echo get_the_post_thumbnail(wp_get_post_parent_id( get_the_ID() ), $size, array( 'alt' => the_title_attribute( 'echo=0' ) )); ?>
					</a>
		<?php
				} else { 
					echo get_the_post_thumbnail(wp_get_post_parent_id( get_the_ID() ), $size);
				}
				if ( $slider ) {
					echo '</li>';
				}
			}

		endwhile;
		echo '</ul>';
		echo '</div>';
		echo $after_widget;
		if ( $slider ) {
		?>	
		<script>
			jQuery(document).ready(function($) {
				$('.wp-featured-image-widget').unslider({
					<?php 
					if( ! empty ($settings) ) { 
						echo implode(",", $settings);
					}
					?>
				});
			});
		</script>
		<?php
		}
	}

} // End class WPFeaturedImageWidget
function wp_featured_image_widge_enqueue_scripts() {
	wp_enqueue_style('wpfiw-unslider,css', plugins_url('/assets/css/unslider-min.css', __FILE__));
	wp_enqueue_style('wpfiw-unslider-dots,css', plugins_url('/assets/css/unslider-dots.css', __FILE__));
	wp_enqueue_script('wpfiw-unslider-min', plugins_url('/assets/js/unslider-min.js', __FILE__), array('jquery'), '1.0', true);

}

add_action('wp_enqueue_scripts', 'wp_featured_image_widge_enqueue_scripts');
add_action('widgets_init', create_function('', 'return register_widget("WPFeaturedImageWidget");'));
?>