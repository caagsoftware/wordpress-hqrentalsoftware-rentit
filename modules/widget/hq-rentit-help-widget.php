<?php


class HQ_Rental_Helping_Center_Widget extends WP_Widget
{
    function __construct()
    {
        $args = array(
            'name'          => esc_html__('HQ Rental Help Center Widget', 'rentit'),
            'description'   => esc_html__('It displays a Helping Center', 'rentit')
        );
        parent::__construct('hq_rental_helping_center', esc_html__('HQ Rental Helping Center', 'rentit'), $args);
    }

    /**
     * method to display in the admin
     *
     * @param $instance
     */
    function form($instance)
    {

        $instance = wp_parse_args((array)$instance,
            array(
                'title'         => esc_html__(' HELPING CENTER', 'rentit'),
                'text'          => esc_html__('Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.', 'rentit'),
                'phone_number'  => '+90 555 444 66 33',
                'email'         => 'support@supportcenter.com',
                'url'           => '#',
                'button'        => 'Support Center'
            )
        );
        extract($instance);
        $title = sanitize_text_field($instance['title']);
        ?>
        <p><label
                    for="<?php echo esc_attr(esc_attr($this->get_field_id('title'))); ?>"><?php esc_html_e('Title:', 'rentit'); ?></label>
            <input class="widefat" id="<?php echo esc_attr(esc_attr($this->get_field_id('title'))); ?>"
                   name="<?php echo esc_attr(esc_attr($this->get_field_name('title'))); ?>"
                   type="text" value="<?php echo esc_attr(esc_attr($title)); ?>"/></p>
        <p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('text')); ?>"> <?php esc_html_e('Text:',
                    'rentit'); ?></label>
            <textarea cols="10" rows="10" class="widefat" id="<?php echo esc_attr($this->get_field_id('text')); ?>"
                      name="<?php echo esc_attr($this->get_field_name('text')); ?>"
            ><?php if (isset($text)) {
                    echo do_shortcode($text);
                } ?></textarea>
        </p>

        <p><label
                    for="<?php echo esc_attr($this->get_field_id('phone_number')); ?>"><?php esc_html_e('Phone number', 'rentit'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('phone_number')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('phone_number')); ?>"
                   type="tel" value="<?php echo esc_attr(esc_attr($phone_number)); ?>"/></p>
        <p>


        <p><label
                    for="<?php echo esc_attr(esc_attr($this->get_field_id('email'))); ?>"><?php esc_html_e('email:', 'rentit'); ?></label>
            <input class="widefat" id="<?php echo esc_attr(esc_attr($this->get_field_id('email'))); ?>"
                   name="<?php echo esc_attr(esc_attr($this->get_field_name('email'))); ?>"
                   type="text" value="<?php echo esc_attr(esc_attr($email)); ?>"/></p>
        <p>
        <p><label
                    for="<?php echo esc_attr(esc_attr($this->get_field_id('url'))); ?>"><?php esc_html_e('url:', 'rentit'); ?></label>
            <input class="widefat" id="<?php echo esc_attr(esc_attr($this->get_field_id('url'))); ?>"
                   name="<?php echo esc_attr(esc_attr($this->get_field_name('url'))); ?>"
                   type="text" value="<?php echo esc_attr(esc_attr($url)); ?>"/></p>
        <p>
        <p><label
                    for="<?php echo esc_attr(esc_attr($this->get_field_id('button'))); ?>"><?php esc_html_e('button:', 'rentit'); ?></label>
            <input class="widefat" id="<?php echo esc_attr(esc_attr($this->get_field_id('button'))); ?>"
                   name="<?php echo esc_attr(esc_attr($this->get_field_name('button'))); ?>"
                   type="text" value="<?php echo esc_attr(esc_attr($button)); ?>"/></p>
        <p>
        <?php

    }

    /**
     * frontend for the site
     *
     * @param $args
     * @param $instance
     */
    public function widget($args, $instance)
    {
        $instance = wp_parse_args((array)$instance,
            array(
                'title'         => esc_html__('HELPING CENTER', 'rentit'),
                'text'          => esc_html__('Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.', 'rentit'),
                'phone_number'  => '+90 555 444 66 33',
                'email'         => 'support@supportcenter.com',
                'url'           => '#',
                'button'        => 'Support Center'
            )
        );
        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        extract($args);
        extract($instance);
        $title = apply_filters('widget_title', empty($instance['title']) ? esc_html__('Archives', 'rentit') : $instance['title'], $instance, $this->id_base);


        echo wp_kses_post($before_widget);

        echo wp_kses_post($before_title) . esc_attr($title) . wp_kses_post($after_title);

        ?>
        <div class="widget-content">
        <p><?php echo do_shortcode($text); ?></p>
        <h5 class="widget-title-sub"><?php echo esc_html($phone_number); ?></h5>

        <p>
            <a href="mailto:<?php echo antispambot(esc_html($email)); ?>"><?php echo antispambot(esc_html($email)); ?></a>
        </p>

        <div class="button">
            <a href="<?php echo esc_url($url); ?>" class="btn btn-block btn-theme btn-theme-dark">
                <?php esc_html_e( $button, 'rentit'); ?>
            </a>
        </div>
        </div>
        <?php

        echo wp_kses_post($after_widget);
    }
}
add_action( 'widgets_init', function(){ register_widget( 'HQ_Rental_Helping_Center_Widget' ); });