<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version  3.0.0
 * */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$Rent_IT_class    = rentit_get_Rent_IT_class();
$product          = rentit_get_global_product();
$woocommerce_loop = rentit_get_global_woocommerce_loop();
// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
    $woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
    $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
    return;
}

// Increase loop count
$woocommerce_loop['loop'] ++;

// Extra post classes
$classes   = array();
$classes[] = 'product-list-item thumbnail no-border no-padding thumbnail-car-card clearfix';
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
    $classes[] = 'first';
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
    $classes[] = 'last';
}
$post_id = get_the_ID();
$vehicle_class = caag_hq_get_vehicle_classes_for_display_by_caag_id( get_post_meta( $post_id,  CAAG_HQ_RENTAL_VEHICLE_CLASS_CAAG_ID_ON_WOOCOMMERCE_PRODUCT_META, true) );
$features = caag_hq_get_features_for_display_by_caag_id( $vehicle_class->id );

?>
<!-- Car Listing -->

<div <?php post_class( $classes ); ?> class="thumbnail no-border no-padding thumbnail-car-card clearfix">
    <div class="media">
        <a class="media-link" data-gal="prettyPhoto"
           href="<?php $Rent_IT_class->get_post_thumbnail( $post->ID, 370, 220, true ); ?>">
            <?php
            /**
             * woocommerce_before_shop_loop_item_title hook
             *
             * @hooked woocommerce_show_product_loop_sale_flash - 10
             * @hooked woocommerce_template_loop_product_thumbnail - 10
             */
            //do_action('woocommerce_before_shop_loop_item_title');


            ?>
            <img src="<?php $Rent_IT_class->get_post_thumbnail( $post->ID, 370, 230 ); ?>" alt="">


            <span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>
        </a>
    </div>
    <div class="caption">
        <div class="rating">
            <?php echo caag_hq_show_rating_stars($vehicle_class->rating); ?>
        </div>
        <h4 class="caption-title"><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a></h4>
        <h5 class="caption-title-sub">
            <?php
            echo 'Start from € ' . $vehicle_class->daily_rate . ' / for 1 day(s)';
            ?>
        </h5>

        <div class="caption-text">

            <?php
            if(get_locale() == 'de_DE'){
                echo wp_trim_words($vehicle_class->short_description_de, 55);
            }elseif(get_locale() == 'nl_NL'){
                echo wp_trim_words($vehicle_class->short_description_nl, 55);
            }else{
                echo wp_trim_words($vehicle_class->short_description_en, 55);
            }

            ?>
        </div>
        <table class="table">
            <?php $features = array_slice( $features, 0, 3 ); ?>
            <tr>
                <?php foreach ($features as $feature): ?>
                    <td><i class="fa fa-<?php echo $feature->icon; ?>"></i>
                        <?php echo $feature->label; ?>
                    </td>
                <?php endforeach; ?>

                <td class="buttons">
                    <?php
                    $url = get_the_permalink();
                    if ( isset( $_COOKIE['rentit_order_id']{2} ) && isset( $_COOKIE['rentit_billing_last_name']{2} ) &&
                        isset( $_GET['edit_car'] )
                    ) {
                        $url = get_the_permalink();


                        $data = array();
                        if ( isset( $_GET['dropin'] ) ) {
                            $data['dropin'] = urldecode( $_GET['dropin'] );
                        }

                        if ( isset( $_GET['dropoff'] ) ) {
                            $data['dropoff'] = urldecode( $_GET['dropoff'] );
                        }

                        if ( isset( $_GET['start_date'] ) ) {
                            $data['start_date'] = urldecode( $_GET['start_date'] );
                        }

                        if ( isset( $_GET['end_date'] ) ) {
                            $data['end_date'] = urldecode( $_GET['end_date'] );
                        }


                        $url = rentit_get_permalink_by_template( 'template-order_edit.php' ) . '?order_id=' . $_COOKIE['rentit_order_id'] . '&last_name=' . $_COOKIE['rentit_billing_last_name'] . '&addcar_id=' . get_the_ID() . '&' . http_build_query( $data );
                    }
                    ?>
                    <a data-action="<?php echo esc_html( get_the_ID() ); ?>" class="btn btn-theme btn-theme-dark"
                       href="<?php echo esc_url( $url ); ?>"> <?php echo esc_html__( 'Reserve Now', 'rentit' ); ?></a>

                </td>
            </tr>
        </table>

        <?php

        /**
         * woocommerce_after_shop_loop_item hook
         *
         * @hooked woocommerce_template_loop_add_to_cart - 10
         */
        do_action( 'woocommerce_after_shop_loop_item' );

        ?>

    </div>
</div>
<!-- /Car Listing -->
