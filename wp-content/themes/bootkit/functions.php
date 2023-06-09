<?php
// Setup
define('BOOTSTRAPTOPIC_DEV_MODE', true);
// Includes
include get_theme_file_path('includes/enqueue.php');
include get_theme_file_path('includes/setup.php');
include get_theme_file_path('includes/custom-nav-walker.php');
include get_theme_file_path('includes/widgets.php');
include get_theme_file_path('includes/custom-pagination-links.php');
include get_theme_file_path('includes/theme-customizer.php');
include get_theme_file_path('includes/custom-post-types.php');
include get_theme_file_path('includes/taxonomies.php');
// Hooks
add_action('init', 'bootkit_register_post_type_init');
add_action('init', 'bootkit_taxonomies');
add_action('wp_enqueue_scripts', 'bootkit_enqueue');
add_action('after_setup_theme', 'bootkit_setup_theme');
add_action('widgets_init', 'bootkit_widgets');
add_action('customize_register', 'bootkit_customize_register');
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');
// Shortcodes

// Test Widgets
class bootkit_widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            // widget ID
            'bootkit_widget',
            // widget name
            __('Simple widget', 'bootkit_widget_domain'),
            // widget description
            array('description' => __('Simple widget bootkit', 'bootkit_widget_domain'))
        );
    }

    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);
        $blog_title = get_bloginfo('name');
        $tagline = get_bloginfo('description');
        echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title']; ?>
        <p><strong>Site Name:</strong>
            <?php echo $blog_title ?>
        </p>
        <p><strong>Tagline:</strong>
            <?php echo $tagline ?>
        </p>
        <?php echo $args['after_widget'];
    }

    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('Default header', 'bootkit_widget_domain');
        }
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
}

function bootkit_register_widget()
{
    register_widget('bootkit_widget');
}

add_action('widgets_init', 'bootkit_register_widget');