<?php

vc_map(array(
    'name' => esc_html__('HQ Home Slider', 'motors'),
    'base' => 'hq_home_slider',
    'icon' => HQ_MOTORS_VC_SHORTCODES_ICON,
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Enter the Silder Title', 'motors'),
            'param_name' => 'title',
            'value' => '',
            'description' => esc_html__('Enter the Silder Title', 'motors')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Enter the Silder Subtitle', 'motors'),
            'param_name' => 'subtitle',
            'value' => '',
            'description' => esc_html__('Enter the Silder Subtitle', 'motors')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Form Title', 'motors'),
            'param_name' => 'form_title',
            'value' => '',
            'description' => esc_html__('Enter the Silder Title', 'motors')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Search for Cheap Rental Cars Wherever Your Are', 'motors'),
            'param_name' => 'st',
            'value' => '',
            'description' => esc_html__('Enter the Silder Title', 'motors')
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__('Backgroung Image', 'motors'),
            'param_name' => 'img_src',
            'value' => '',
            'description' => esc_html__('Backgroung Image', 'motors')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Submit Button Text', 'motors'),
            'param_name' => 'button_text',
            'value' => '',
            'description' => esc_html__('Submit Button Text', 'motors')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Form Link', 'motors'),
            'param_name' => 'action',
            'value' => '',
            'description' => esc_html__('Submit Button Text', 'motors')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Youtube Video URl', 'motors'),
            'param_name' => 'video',
            'value' => '',
            'description' => esc_html__('Youtube Video URL', 'motors')
        )
    )
));
class WPBakeryShortCode_hq_home_slider extends WPBakeryShortCode{
    protected function content( $atts, $content = null ){
        global $Rent_IT_class;
        extract(shortcode_atts(array(
            'title'         => esc_html__( 'All Discounts Just For You', 'rentit' ),
            'subtitle'      => esc_html__( 'Find Best Rental Car', 'rentit' ),
            'form_title'    => esc_html__( 'Search for Cheap Rental Cars Wherever Your Are', 'rentit' ),
            'img_src'       => '',
            'button_text'   => esc_html__( ' Find Car', 'rentit' ),
            'video'         => '',
            'action'        =>  ''
        ), $atts));
        if ( empty( $img_src ) ) {
            $img_src = get_template_directory_uri() . '/img/preview/slider/slide-2.jpg';
        } else{
            $img = wp_get_attachment_image_src( $img_src, 'full' );
            $img = $img[0];
        }
        ob_start();
        $locations = caag_hq_get_locations_for_display();
        ?>
        <!--Begin-->
        <div class="item slide1 ver1" style="background-image: url('<?php echo esc_url( $img ); ?>');">
            <?php if ( ! empty( $video ) ): ?>
                <div class="videoID">
                    <iframe  src="<?php echo esc_url( get_youtube_embed_url( $video ) ) ?>" frameborder="0"></iframe>
                </div>
            <?php endif; ?>
            <div class="caption">
                <div class="container">
                    <div class="div-table">
                        <div class="div-cell">
                            <form id="hq-home-form" action="<?php echo $action; ?>" method="post" class="caption-content">
                                <h2 class="caption-title hq-home-form-title"><?php echo $title; ?></h2>
                                <h3 class="caption-subtitle hq-home-form-subtitle"><?php echo $subtitle; ?></h3>
                                <!-- Search form -->
                                <div class="row">
                                    <div class="col-sm-12 col-md-10 col-md-offset-1">
                                        <div class="form-search dark">
                                            <form action="#">
                                                <div class="form-title">
                                                    <i class="fa fa-globe"></i>
                                                    <h2><?php echo $form_title; ?></h2>
                                                </div>
                                                <div class="row row-inputs">
                                                    <div class="container-fluid">
                                                        <div class="col-sm-6">
                                                            <div class="form-group has-icon has-label">
                                                                <label for="formSearchUpLocation">
                                                                    <?php esc_html_e( 'Picking Up Location', 'rentit' ); ?>
                                                                </label>
                                                                <select name="pick_up_location" id="hq-pick-up-location" class="hq-locations-selects">
                                                                    <option>Select Location</option>
                                                                <?php foreach ($locations as $location): ?>
                                                                    <option value="<?php echo $location->id; ?>"><?php echo $location->name; ?></option>
                                                                <?php endforeach; ?>
                                                                </select>
                                                                <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group has-icon has-label">
                                                                <label for="formSearchUpDate">
                                                                    <?php esc_html_e( ' Picking Up Date', 'rentit' ); ?>
                                                                </label>
                                                                <input name="pick_up_date" type="text" class="form-control"
                                                                       id="formSearchUpDate"
                                                                       value="<?php
                                                                       if ( function_exists( 'rentit_get_date_s' ) ) {
                                                                           rentit_get_date_s( 'dropin_date' );
                                                                       }
                                                                       ?>"
                                                                       placeholder="<?php esc_html_e( 'dd/mm/yyyy', 'rentit' ); ?>">
                                                                <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row row-inputs">
                                                    <div class="container-fluid">
                                                        <div class="col-sm-6">
                                                            <div class="form-group has-icon has-label">
                                                                <label for="formSearchUpLocation">
                                                                    <?php esc_html_e( 'Dropping Off Location', 'rentit' ); ?>
                                                                </label>
                                                                <select name="return_location" id="hq-return-location" class="hq-locations-selects">
                                                                    <option>Select Location</option>
                                                                    <?php foreach ($locations as $location): ?>
                                                                        <option value="<?php echo $location->id; ?>"><?php echo $location->name; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group has-icon has-label">
                                                                <label for="formSearchOffDate">
                                                                    <?php esc_html_e( 'Dropping Off Date', 'rentit' ); ?>
                                                                </label>
                                                                <input name="return_date" type="text" class="form-control"
                                                                       id="formSearchOffDate"
                                                                       value="<?php
                                                                       if ( function_exists( 'rentit_get_date_s' ) ) {
                                                                           rentit_get_date_s( 'dropoff_date' );
                                                                       }
                                                                       ?>"
                                                                       placeholder="<?php esc_html_e( 'dd/mm/yyyy', 'rentit' ); ?>">
                                                                <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group has-icon has-label">
                                                                <label for="formSearchUpLocation">
                                                                    <?php esc_html_e( 'Number of Passenger', 'rentit' ); ?>
                                                                </label>
                                                                <select name="number_of_passenger" class="hq-locations-selects">
                                                                    <option>Select Number of Passenger</option>
                                                                    <?php for($i = 1; $i<=10; $i++): ?>
                                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                    <?php endfor; ?>
                                                                </select>
                                                                <span class="form-control-icon"><i class="fa fa-users"></i></span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>


                                                <div class="row row-submit">
                                                    <div class="container-fluid">
                                                        <div class="inner">
                                                            <i class="fa fa-plus-circle"></i>
                                                            <a href="<?php
                                                            if ( function_exists( 'wc_get_page_id' ) ) {
                                                                echo esc_url( get_permalink( wc_get_page_id( ( 'shop' ) ) ) );
                                                            }

                                                            ?>">
                                                                <?php esc_html_e( ' Advanced Search', 'rentit' ); ?>
                                                            </a>
                                                            <button type="submit" id="formSearchSubmit" class="btn btn-submit btn-theme pull-right">
                                                                <?php echo $button_text; ?>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Search form -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .div-table{
                margin: auto;
            }
            .hq-locations-selects{
                width: 100%;
                background: rgba(255, 255, 255, 0.2);
                border: 1px solid rgba(255, 255, 255, 0);
                color: rgba(255, 255, 255, 0.6);
                padding-right: 40px;
                height: 40px;
            }
            .hq-locations-selects option{
                color:#14181C;
            }
            .hq-home-form-title{
                text-align: center;
                font-family: roboto,sans-serif;
                font-size: 24px;
                font-weight: 100;
                line-height: 1;
                color: #fff;
                clear: both;
                text-transform: uppercase;
                margin: 0 0 15px;
            }
            .hq-home-form-subtitle{
                text-align: center;
                font-family: raleway,sans-serif;
                font-size: 72px;
                font-weight: 900;
                line-height: 1;
                text-transform: uppercase;
                color: #fff;
                margin: 0 0 40px;
            }
            #hq-home-form{
                margin-top: 70px;
            }
        </style>
        <!-- /Slide 1 -->
        <?php
        return ob_get_clean();
    }
}