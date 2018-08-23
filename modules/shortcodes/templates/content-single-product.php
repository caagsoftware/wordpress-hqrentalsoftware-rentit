<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version    4.6.4
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$product = rentit_get_global_product();
global $post;
$woocommerce_loop = rentit_get_global_woocommerce_loop();
/*Custom Post Created By Plugin - No Woocommerce */
$vehicle_class = caag_hq_get_vehicle_classes_for_display_by_caag_id( get_post_meta( $post->ID,  CAAG_HQ_RENTAL_VEHICLE_CLASS_CAAG_ID_ON_WOOCOMMERCE_PRODUCT_META, true) );
$features = caag_hq_get_features_for_display_by_caag_id( $vehicle_class->id );
$charges = caag_hq_get_additional_charges_for_display();
$_pf = new WC_Product_Factory();
$woo_product = $_pf->get_product($post->ID);
?>
<form action="/reservation/" class="cart" method="post" enctype='multipart/form-data'>
<<<<<<< Updated upstream:modules/shortcodes/templates/content-single-product.php
    <?php elseif (get_locale() == 'de_DE'): ?>
    <form action="/de/reservation/" class="cart" method="post" enctype='multipart/form-data'>
        <?php endif; ?>

        <div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php
            if (!$product->is_in_stock()) {
                ?>
                <div class="woocommerce-error">
                    <div class="alert alert-danger fade in">
                        <button class="close" data-dismiss="alert" type="button"><?php esc_html_e('×', 'rentit'); ?></button>
                        <strong> <?php esc_html_e('Product is Out of Stock', 'rentit'); ?></strong>
                    </div>
                </div>
                <?php
            }
            /**
             * woocommerce_before_single_product hook
             *
             * @hooked wc_print_notices - 10
             *
             */
            do_action('woocommerce_before_single_product');
=======

    <div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php
        if (!$product->is_in_stock()) {
>>>>>>> Stashed changes:modules/templates/content-single-product.php
            ?>
            <div class="woocommerce-error">
                <div class="alert alert-danger fade in">
                    <button class="close" data-dismiss="alert" type="button"><?php esc_html_e('×', 'rentit'); ?></button>
                    <strong> <?php esc_html_e('Product is Out of Stock', 'rentit'); ?></strong>
                </div>
            </div>
            <?php
        }
        /**
         * woocommerce_before_single_product hook
         *
         * @hooked wc_print_notices - 10
         *
         */
        do_action('woocommerce_before_single_product');
        ?>
        <!--
        <h3 class="block-title alt"><i class="fa fa-angle-down"></i>
            <?php //echo esc_html__('Car Information', 'rentit');
            ?>
        </h3>-->
        <div class="car-big-card alt">
            <div class="row">
                <?php
                if (has_post_thumbnail()) {
                    //get gallery
                    get_template_part('partials/car', 'gallery');
                    //Begin Car Details
                } ?>
                <div class="col-md-4">
                    <div class="car-details">
                        <div class="list">
                            <ul>
                                <!--Vehicle Name-->
                                <li class="title">
                                    <h2>
                                        <span><?php echo $vehicle_class->name; ?></span>
                                    </h2>
                                    <?php
                                    $subtitle = get_post_meta(get_the_ID(), '_rentit_subtitle', true);
                                    if (!empty($subtitle)) {
                                        echo esc_html($subtitle);
                                    }
                                    ?>
                                </li>
                                <?php foreach ($features as $feature): ?>
                                    <li><?php echo $feature->label; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="price">
                            <div id="hq-price-product-page" class="price">
                                €<strong><?php echo $woo_product->get_price(); ?></strong> / for 1 day(s)
                                <i class="fa fa-info-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-inputs">
            <div class="col-sm-12">
                <?php if(get_locale() == 'de_DE'): ?>
                    <h3 class="block-title alt"><i class="fa fa-angle-down"></i>Description</h3>
                    <?php echo $vehicle_class->description_de; ?>
                <?php elseif(get_locale() == 'nl_NL'): ?>
                    <h3 class="block-title alt"><i class="fa fa-angle-down"></i>Description</h3>
                    <?php echo $vehicle_class->description_nl; ?>
                <?php endif; ?>

            </div>
        </div>
        <div class="row row-inputs">
            <div class="container-fluid hq-date-pickers-wrapper">
                <div class="col-sm-3">
                    <div class="form-group has-icon has-label">
                        <label for="formSearchUpDate3"><?php esc_html_e('Picking Up Date', 'rentit') ?></label>
                        <input id="pick_up_datetime" name="pick_up_date" type="text" class="form-control"
                               placeholder="<?php esc_html_e('yyyy-mm-dd', 'rentit'); ?>"
                               value="<?php
                               if (function_exists('rentit_get_date_s')) {
                                   rentit_get_date_s('dropin_date');
                               }
                               ?>"
                        >
                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group has-icon has-label">
                        <label for="formSearchUpDate3"><?php esc_html_e('Picking Up Time', 'rentit') ?></label>
                        <select name="pick_up_time" class="hq-locations-selects">
                            <?php echo caag_hq_rental_get_times('07:00', '20:00'); ?>
                        </select>

                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
                <style>
                    .hq-locations-selects{
                        width: 100%;
                        border: 1px solid rgba(255, 255, 255, 0);
                        padding-right: 40px;
                        height: 50px;
                        border: 1px solid #e9e9e9;
                    }
                </style>
                <div class="col-sm-3">
                    <div class="form-group has-icon has-label">
                        <label for="formSearchOffDate3"><?php esc_html_e('Dropping Off Date', 'rentit') ?></label>
                        <input name="return_date" type="text" class="form-control" id="return_datetime" placeholder="<?php esc_html_e('yyyy-mm-dd', 'rentit'); ?>"
                               value="<?php
                               if (function_exists('rentit_get_date_s')) {
                                   rentit_get_date_s('dropoff_date');
                               }
                               ?>"
                        >
                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group has-icon has-label">
                        <label for="formSearchUpDate3"><?php esc_html_e('Return Time', 'rentit') ?></label>
                        <select name="return_time" class="hq-locations-selects">
                            <?php echo caag_hq_rental_get_times('07:00', '20:00'); ?>
                        </select>

                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
            </div>
            <div class="overflowed reservation-now">
                <div class="checkbox pull-left">
                </div>
                <input type="hidden" name="vehicle_class_id" value="<?php echo $vehicle_class->id; ?>" >
                <button id="reservation_car_btn" type="submit" class="btn btn-theme pull-right">Reserve Now </button>
            </div>
        </div>
        <div class="images">
        </div>
        <hr class="page-divider half transparent"/>
        <h3 class="block-title alt"><i class="fa fa-angle-down"></i><?php esc_html_e('Additional Charges', 'rentit') ?> </h3>
        <div role="form" class="form-extras">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6 car-big-card">

                        <div class="left car-details">
                            <ul>
                                <?php $column_size = (int)count( $charges ) / 2; ?>
                                <?php for( $i = 0; $i < $column_size ; $i++ ): ?>
                                    <li><?php echo $charges[$i]->name; ?></li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 car-big-card">
                        <div class="right car-details">
                            <ul>
                                <?php for( $i = $column_size; $i < count( $charges ) ; $i++ ): ?>
                                    <li><?php echo $charges[$i]->name; ?></li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $eable_car_seless = get_post_meta(get_the_ID(), '_rentit_disable_rent', 1); ?>
            <div class="row">
                <div class="row row-inputs">
                    <div class="container-fluid">
                        <div class="col-sm-12">

                        </div>
                        <div class="col-sm-12">

                        </div>
                    </div>
                </div>

            </div>
        <?php
        /**
         * Loop Add to Cart
         */
        $product = rentit_get_global_product();
        ?>
    </div>
    <!-- #product-<?php the_ID(); ?> -->
</form>

<div class="row">
    <div class="col-md-12">
        <h3 class="block-title alt"><i class="fa fa-angle-down"></i><?php esc_html_e('Camper Availability', 'rentit') ?></h3>
        <?php
            $shortcode  = '[hq_rental_forms_calendar id=1 ';
            $shortcode .= 'vehicle_class_id=' . $vehicle_class->id;
            $shortcode .= ']';
        ?>
        <?php echo do_shortcode($shortcode); ?>
    </div>
</div>
<style>
    .reservation-now{
        border-top: 0px !important;
    }
    .hq-date-pickers-wrapper{
        padding-top: 25px ;
        padding-bottom: 25px ;
    }
    #hq-price-product-page{
        padding: 15px 20px;
    }
    .car-big-card .car-details .price{
        padding:15px 5px;
    }
</style>
<?php do_action('woocommerce_after_single_product'); ?>
