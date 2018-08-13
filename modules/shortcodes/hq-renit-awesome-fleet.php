<?php
vc_map(array(
    'name' => esc_html__('HQ Awesome Rental Fleet', 'motors'),
    'base' => 'hq_awesome_rental_fleet',
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
            'heading' => esc_html__('Sub Title', 'motors'),
            'param_name' => 's1',
            'value' => '',
            'description' => esc_html__('Enter the Silder Sub Title', 'motors')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Sub Title', 'motors'),
            'param_name' => 's2',
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
            'heading' => esc_html__('Button Text', 'motors'),
            'param_name' => 'button_text',
            'description' => esc_html__('Reserve Button Text', 'motors'),
            'value' => '',
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Day Tag', 'motors'),
            'param_name' => 'day_tag',
            'description' => esc_html__('Enter Day Tag', 'motors'),
            'value' => '',
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Reservation Link', 'motors'),
            'param_name' => 'reservation_link',
            'description' => esc_html__('Enter Day Tag', 'motors')
        ),
    )
));
class WPBakeryShortCode_hq_awesome_rental_fleet extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        global $Rent_IT_class, $post;
        extract(shortcode_atts(array(
            'h_s'               => esc_html__("Select What You Want", "rentit"),
            'h'                 => esc_html__('Our awesome Rental Fleet cars', "rentit"),
            's1'                => 2,
            's2'                => 3,
            'reservation_link'  =>  ''
        ), $atts));

        if (in_array($atts['taxonomy'], array('product_cat', 'product_group'))) {
            $taxonomy = $atts['taxonomy'];
        } else {
            $taxonomy = 'product_cat';
        }
        ob_start();
        ?>
        <section class="page-section">
            <div class="container">
                <h2 class="section-title wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
                    <small><?php echo wp_kses_post($atts['h_s']); ?></small>
                    <span><?php echo wp_kses_post($atts['h']); ?></span>
                </h2>
                <!--<div class="tabs awesome wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
                    <ul id="tabs1" class="nav">

                        <?php

                        $cats = get_categories("taxonomy={$taxonomy}&hide_empty=0&orderby=name&order=ASC");
                        $i = 1;
                        foreach ($cats as $cat) {
                            if (!isset($cat->name)) {
                                continue;
                            }
                            $class = ($i == 1) ? 'active' : "";
                            ?>
                            <li data-q="<?php echo esc_attr($i); ?>"
                                class="<?php echo esc_attr(sanitize_html_class($class)); ?>"><a
                                        href="#tab-x<?php echo esc_attr($i); ?>" data-toggle="tab"><?php
                                    echo wp_kses_post($cat->name); ?>  </a></li>
                            <?php
                            $i++;
                        } ?>
                    </ul>
                </div> -->

                <div class="tab-content wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
                    <?php
                        $i = 1;
                    //show tabs
                    foreach ($cats as $cat) {
                        if (!isset($cat->name)) {
                            continue;
                        }
                        $class = ($i == 1) ? ' active in ' : "";
                        ?>
                        <style>
                            .car-big-card .car-details .price{
                                padding-right: 15px;
                                padding-left: 15px;
                            }
                        </style>
                        <div class="mutabsss tab-pane fade panel1 <?php echo esc_attr($class); ?>"
                             id="tab-x<?php echo (int)esc_html($i); ?>">
                            <div class="car-big-card">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="tabs awesome-sub">
                                            <ul id="tabs4" class="nav"><!--
                                            --><?php
                                                $rentit_new_arr = array(
                                                    'showposts'         => 5,
                                                    'post_status'       => 'publish',
                                                    'post_type'         => 'product',
                                                    'orderby'           => 'date',
                                                    'post_per_page'     =>  -1,
                                                    'post_type'         =>  'product'
                                                );
                                                $rentit_custom_query = new WP_Query($rentit_new_arr);
                                                $j = 1;
                                                if ($rentit_custom_query->have_posts()):
                                                    while ($rentit_custom_query->have_posts()):
                                                        $rentit_custom_query->the_post();
                                                        $class = ($j == 1) ? ' active' : "";
                                                        ?>
                                                        <li class="<?php echo esc_attr($class); ?> linkswiperSlider<?php echo (int)$i; ?>x<?php echo (int)$j; ?>">
                                                            <a
                                                                    href="#tab-x<?php echo (int)$i; ?>x<?php echo (int)$j; ?>"
                                                                    data-swiper="swiperSlider<?php echo (int)$i; ?>x<?php echo (int)$j; ?>"
                                                                    data-toggle="tab"><span><?php the_title(); ?></span></a>
                                                        </li>
                                                        <?php
                                                        $j++;
                                                    endwhile;
                                                    wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <!-- Sub tabs content -->
                                        <div class="tab-content">
                                            <div class="tab-content">
                                                <?php
                                                $j = 1;
                                                if ($rentit_custom_query->have_posts()):
                                                    while ($rentit_custom_query->have_posts()):
                                                        $rentit_custom_query->the_post();
                                                        $class = ($j == 1) ? ' active in' : "";
                                                        ?>
                                                        <div
                                                                class="tab-pane mytab_car fade custumclass <?php echo esc_attr($class); ?>"
                                                                id="tab-x<?php echo (int)$i; ?>x<?php echo (int)$j; ?>">
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <!-- Swiper -->
                                                                    <?php
                                                                    $image_title = esc_attr(get_the_title(get_post_thumbnail_id()));
                                                                    $image_caption = get_post(get_post_thumbnail_id())->post_excerpt;
                                                                    $image_link = wp_get_attachment_url(get_post_thumbnail_id());
                                                                    $image = get_the_post_thumbnail($post->ID, apply_filters('single_product_large_thumbnail_size', 'shop_single'), array(
                                                                        'title' => $image_title,
                                                                        'alt' => $image_title
                                                                    ));
                                                                    ?>
                                                                    <div class="swiper-container"

                                                                         id="swiperSlider<?php echo (int)$i; ?>x<?php echo (int)$j; ?>"

                                                                         data-img0="<?php echo esc_url($Rent_IT_class->trim_img_by_url($image_link, 70, 70)); ?>"


                                                                        <?php


                                                                        $arr_image_gallery = explode(',', get_post_meta($post->ID, '_product_image_gallery', true));

                                                                        $n = 1;

                                                                        foreach ($arr_image_gallery as $img_id) {

                                                                            $image_attributes = wp_get_attachment_image_src($img_id, 'full');


                                                                            ?>

                                                                            data-img<?php echo (int)$n ?>="<?php echo esc_url($Rent_IT_class->trim_img_by_url($image_attributes[0], 70, 70)); ?>"


                                                                            <?php

                                                                            $n++;

                                                                        }


                                                                        ?>

                                                                    >
                                                                        <div class="swiper-wrapper">
                                                                            <div class="swiper-slide">
                                                                                <a class="btn btn-zoom"
                                                                                   href="<?php echo esc_url($image_link); ?>"
                                                                                   data-gal="prettyPhoto"><i
                                                                                            class="fa fa-arrows-h"></i></a>
                                                                                <a href="<?php echo esc_url($image_link); ?>"
                                                                                   data-gal="prettyPhoto">
                                                                                    <img class="img-responsive"
                                                                                         src="<?php echo esc_url(
                                                                                             $Rent_IT_class->trim_img_by_url($image_link, 600, 426)
                                                                                         ); ?>"
                                                                                         alt=""/></a>
                                                                            </div>
                                                                            <?php
                                                                            $arr_image_gallery = explode(',', get_post_meta($post->ID, '_product_image_gallery', true));
                                                                            foreach ($arr_image_gallery as $img_id) {
                                                                                $image_attributes = wp_get_attachment_image_src($img_id, 'full');
                                                                               ?>
                                                                                <div class="swiper-slide">
                                                                                    <a class="btn btn-zoom"

                                                                                       href="<?php echo esc_url($image_attributes[0]); ?>"

                                                                                       data-gal="prettyPhoto"><i

                                                                                                class="fa fa-arrows-h"></i></a>

                                                                                    <a href="<?php echo esc_url($image_attributes[0]); ?>"

                                                                                       data-gal="prettyPhoto">


                                                                                        <img class="img-responsive"

                                                                                             src="<?php echo esc_url(

                                                                                                 $Rent_IT_class->trim_img_by_url($image_attributes[0], 600, 426)

                                                                                             ); ?>"

                                                                                             alt=""/></a>
                                                                                </div>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                        <!-- Add Pagination -->
                                                                        <div class="row car-thumbnails"></div>
                                                                    </div>
                                                                </div>
                                                                <script>
                                                                    jQuery(document).ready(function ($) {
                                                                        swiperSlider<?php echo (int)$i; ?>x<?php echo (int)$j; ?> = new Swiper(swiperSlider<?php echo (int)$i; ?>x<?php echo (int)$j; ?>, {
                                                                            pagination: '#swiperSlider<?php echo (int)$i; ?>x<?php echo (int)$j; ?> .row.car-thumbnails',
                                                                            paginationClickable: true,
                                                                            initialSlide: 0, //slide number which you want to show-- 0 by default
                                                                            paginationBulletRender: function (index, className) {
                                                                                var img = jQuery('#swiperSlider<?php echo (int)$i; ?>x<?php echo (int)$j; ?>').data("img" + index);
                                                                                return '<div class="col-xs-2 col-sm-2 col-md-3 ' + className + '">' +
                                                                                    '<a href="#"><img width="70" height="70" class="responsive" src="' + img + ' "' +
                                                                                    ' alt=""/></a></div>';
                                                                            }
                                                                        });
                                                                        setTimeout(function () {
                                                                            swiperSlider<?php echo (int)$i; ?>x<?php echo (int)$j; ?>.update();
                                                                            swiperSlider<?php echo (int)$i; ?>x<?php echo (int)$j; ?>.onResize();
                                                                            swiperSlider<?php echo (int)$i; ?>x<?php echo (int)$j; ?>.slideTo(0);
                                                                        }, 500);

                                                                        jQuery('.linkswiperSlider<?php echo (int)$i; ?>x<?php echo (int)$j; ?>').click(function () {
                                                                            console.log('.linkswiperSlider<?php echo (int)$i; ?>x<?php echo (int)$j; ?>');
                                                                            setTimeout(function () {
                                                                                swiperSlider<?php echo (int)$i; ?>x<?php echo (int)$j; ?>.update();
                                                                                swiperSlider<?php echo (int)$i; ?>x<?php echo (int)$j; ?>.onResize();
                                                                                swiperSlider<?php echo (int)$i; ?>x<?php echo (int)$j; ?>.slideTo(0)
                                                                            }, 250);
                                                                        });


                                                                    });

                                                                </script>
                                                                <div class="col-md-4">
                                                                    <div class="car-details">
                                                                        <div class="price">
                                                                            <?php
                                                                            global $product;
                                                                            ?>
                                                                            <strong> <?php echo get_woocommerce_currency_symbol() ; ?> <?php echo $product->get_price(); ?></strong>
                                                                            <?php echo esc_html_e(' /per a day', 'rentit'); ?>
                                                                            <i class="fa fa-info-circle"></i>
                                                                        </div>
                                                                        <div class="list">
                                                                            <ul>
                                                                                <?php
                                                                                $vehicle_class = caag_hq_get_vehicle_classes_for_display_by_caag_id( get_post_meta( $product->get_id(), CAAG_HQ_RENTAL_VEHICLE_CLASS_CAAG_ID_ON_WOOCOMMERCE_PRODUCT_META, true ) );
                                                                                $features = caag_hq_get_features_for_display_by_caag_id( $vehicle_class->id );
                                                                                ?>
                                                                                <?php foreach ($features as $feature): ?>
                                                                                    <li><?php echo $feature->label; ?></li>
                                                                                <?php endforeach; ?>
                                                                            </ul>
                                                                        </div>
                                                                        <div class="button">
                                                                            <a href="<?php echo $reservation_link . '?vehicle_class_id=' . $vehicle_class->id; ?>"
                                                                               class="btn btn-theme ripple-effect btn-theme-dark btn-block">
                                                                                <?php esc_html_e('Reservation Now', 'rentit'); ?>
                                                                            </a>
                                                                        </div>
                                                                    </div>
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
                                        <!-- /Sub tabs content -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $i++;
                    } ?>
                    <!-- tab 1 -->
                    <!-- tab 2 -->
                </div>
            </div>
        </section>
        <script>
            jQuery(document).ready(function ($) {
                jQuery('#tabs1 li a').eq(<?php echo((int)$atts['s1'] - 1); ?>).click();
                jQuery('.tab-content .panel1.mutabsss').removeClass('active');
                jQuery('.tab-content .panel1.mutabsss').eq(<?php echo((int)$atts['s1'] - 1);?>).find('.mytab_car').removeClass('active');
                //jQuery('.tab-content .panel1.mutabsss').eq(<?php echo((int)$atts['s1'] - 1);?>).find('.mytab_car').eq(<?php echo((int)$atts['s2'] - 1); ?>).addClass('active in');
                jQuery('.tab-content .panel1').eq(<?php echo((int)$atts['s1'] - 1); ?>).addClass('active in');
                jQuery('.tab-content .panel1').eq(<?php echo((int)$atts['s1'] - 1); ?>).find('.tabs a').eq(<?php echo((int)$atts['s2'] - 1); ?>).click();
                jQuery('.tab-content .panel1').eq(<?php echo((int)$atts['s1'] - 1); ?>).find('.mytab_car').eq(<?php echo((int)$atts['s2'] - 1); ?>).addClass('active in');
                jQuery('#tabs1 li').click(function (e) {
                    var id = $(this).data('q');
                    setTimeout(function () {
                        console.log('swiperSlider' + id + 'x1.update()');
                        eval('swiperSlider' + id + 'x1.update()');
                        eval('swiperSlider' + id + 'x1.onResize()');

                    }, 250);
                });
            });
        </script>
        <?php
        return ob_get_clean();
    }
}
