<?php

/**
 * Created by PhpStorm.
 * User: Miguel Faggioni
 * Date: 12/07/2018
 */

vc_map(array(
    'name' => esc_html__('HQ Great Offers Slider', 'motors'),
    'base' => 'hq_great_offers_slider',
    'icon' => HQ_MOTORS_VC_SHORTCODES_ICON,
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Title', 'motors'),
            'param_name' => 'h',
            'value' => '',
            'description' => esc_html__('Enter the Silder Title', 'motors')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Sub Title', 'motors'),
            'param_name' => 'h_s',
            'value' => '',
            'description' => esc_html__('Enter the Silder Sub Title', 'motors')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Categories', 'motors'),
            'param_name' => 'id',
            'value' => '',
            'description' => esc_html__('Enter the category Ids', 'motors')
        ),
        array(
            'type' => 'textfield',
            'param_name' => 'button_text',
            'description' => esc_html__('Reserve Button Text', 'motors'),
            'value' => '',
        ),
        array(
            'type' => 'textfield',
            'param_name' => 'day_tag',
            'description' => esc_html__('Enter Day Tag', 'motors'),
            'value' => '',
        ),
    )
));
class WPBakeryShortCode_hq_great_offers_slider extends WPBakeryShortCode
{
    protected function content( $atts, $content = null )
    {
        global $Rent_IT_class, $post;
        extract(shortcode_atts(array(
            'h_s' => esc_html__("What a Kind of Car You Want", "rentit"),
            'h' => esc_html__('Great Rental Offers for You', "rentit"),
            'id' => '',
            'button_text'   =>  '',
            'day_tag'       =>  ''
        ), $atts));
        ob_start();
        ?>
        <section class="page-section">
            <div class="container">
                <h2 class="section-title wow fadeInUp" data-wow-offset="70" data-wow-delay="100ms">
                    <small><?php echo wp_kses_post($atts['h_s']); ?></small>
                    <span><?php echo wp_kses_post($atts['h']); ?></span>
                </h2>
                <div class="tabs wow fadeInUp" data-wow-offset="70" data-wow-delay="300ms">
                    <ul id="tabs" class="nav"><!--
                        -->
                        <?php
                        $args = array(
                            'taxonomy' => 'product_cat',
                            'hide_empty' => 0,
                        );
                        if (isset($atts['id']{2})) {
                            $args['include'] = $atts['id'];
                        }
                        $cats = get_categories($args);
                        $i = 1;
                        foreach ($cats as $cat) {
                            if (!isset($cat->name)) continue;
                            $class = ($i == 1) ? 'active' : "";
                            ?>
                            <li class="<?php echo sanitize_html_class($class); ?>"><a
                                        href="#tab-<?php echo esc_attr($i); ?>"
                                        data-toggle="tab"><?php
                                    echo wp_kses_post($cat->name); ?></a></li>
                            <?php
                            $i++;
                        } ?>
                        <!--
                            -->
                    </ul>
                </div>
                <div class="tab-content wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
                    <?php $i = 1;
                    //show tabs
                    foreach ($cats as $cat) {
                        if (!isset($cat->name)) continue;
                        $class = ($i == 1) ? ' active in ' : "";
                        ?>
                        <!-- tab 1 -->
                        <div class="sladersss tab-pane fade  <?php echo esc_attr($class); ?>"
                             id="tab-<?php echo esc_attr((int)$i); ?>">
                            <div class="swiper swiper--<?php echo esc_attr(str_ireplace(' ', '-', $cat->name)); ?>">
                                <div class="swiper-container-GREAT-RENTAL swiper-container">

                                    <div class="swiper-wrapper">
                                        <!-- Slides -->
                                        <?php
                                        $rentit_new_arr = array(
                                            'paged'         => 1,
                                            'showposts'     => 10,
                                            'post_status'   => 'publish',
                                            'post_type'     => 'product',
                                            'orderby'       => 'meta_value_num',
                                            'meta_key'      =>  '_price',
                                            'order'         =>  'ASC'
                                        );

                                        /*
                                        $rentit_new_arr['tax_query'] =
                                            array(
                                                array(
                                                    'taxonomy' => 'product_cat',
                                                    'field' => 'id',
                                                    'terms' => array(sanitize_text_field($cat->term_id))
                                                )
                                            );*/
                                        $rentit_custom_query = new WP_Query($rentit_new_arr);
                                        $j = 1;
                                        if ($rentit_custom_query->have_posts()):

                                            while ($rentit_custom_query->have_posts()):
                                                $rentit_custom_query->the_post();
                                                $class = ($j == 1) ? ' active' : "";
                                                ?>
                                                <div class="swiper-slide">
                                                    <div class="thumbnail no-border no-padding thumbnail-car-card">
                                                        <div class="media">
                                                            <a class="media-link" data-gal="prettyPhoto"
                                                               href="<?php $Rent_IT_class->get_post_thumbnail($post->ID, 370, 220, true); ?>">
                                                                <?php
                                                                /**
                                                                 * woocommerce_before_shop_loop_item_title hook
                                                                 *
                                                                 * @hooked woocommerce_show_product_loop_sale_flash - 10
                                                                 * @hooked woocommerce_template_loop_product_thumbnail - 10
                                                                 */
                                                                ?>
                                                                <img src="<?php $Rent_IT_class->get_post_thumbnail($post->ID, 370, 230); ?>" alt="">
                                                                <span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>
                                                            </a>
                                                        </div>
                                                        <div class="caption text-center">
                                                            <h4 class="caption-title"><a
                                                                        href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a>
                                                            </h4>
                                                            <div class="caption-text">
                                                                <?php
                                                                    $woo_product = wc_get_product( get_the_ID() );
                                                                    $vehicle_class = caag_hq_get_vehicle_classes_for_display_by_caag_id( get_post_meta( get_the_ID(), CAAG_HQ_RENTAL_VEHICLE_CLASS_CAAG_ID_ON_WOOCOMMERCE_PRODUCT_META, true ) );
                                                                    $features = caag_hq_get_features_for_display_by_caag_id( $vehicle_class->id );
                                                                ?>
                                                                <?php echo get_woocommerce_currency_symbol() ; ?> <?php echo $woo_product->get_price() . ' / ' . $day_tag;  ?>
                                                            </div>
                                                            <div class="buttons">
                                                                <a class="btn btn-theme ripple-effect"
                                                                   href="<?php echo esc_url(get_the_permalink()) ?>">
                                                                    <?php echo esc_html__($button_text, 'rentit'); ?>
                                                                </a>
                                                            </div>
                                                            <table class="table">
                                                                <?php $features = array_slice( $features, 0, 3 ); ?>
                                                                <tr>
                                                                    <?php foreach ($features as $feature): ?>
                                                                        <td>
                                                                            <i class="fa fa-<?php echo $feature->icon; ?>"></i>
                                                                            <?php echo $feature->label; ?>
                                                                        </td>
                                                                    <?php endforeach; ?>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                $j++;
                                            endwhile;
                                            wp_reset_postdata();
                                        endif;
                                        ?>
                                    </div>
                                </div>
                                <div class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
                                <div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>
                            </div>
                        </div>
                        <?php
                        $i++;
                    } ?>
                </div>
            </div>
        </section>
        <?php
        return ob_get_clean();
    }
}