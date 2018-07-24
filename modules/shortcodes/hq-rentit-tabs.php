<?php
function hq_rental_tabs($atts)
{
    $vehicle = caag_hq_get_vehicle_classes_for_display_by_caag_id($atts['vehicle_id']);
    ?>
    <div class="wpb_column vc_column_container vc_col-sm-12">
        <div class="vc_column-inner ">
            <div class="wpb_wrapper">
                <div>
                    <div class="tabs-wrapper content-tabs">
                        <ul class="nav nav-tabs">
                            <?php if (get_locale() == 'nl_NL'): ?>
                                <?php if (!empty($vehicle->inb_nl)): ?>
                                    <li class="active">
                                        <a href="#inge" data-toggle="tab">
                                            <span class="vc_tta-title-text">Inbegrepen NL</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (!empty($vehicle->tech_nl)): ?>
                                    <li class="">
                                        <a href="#tech" data-toggle="tab">
                                            <span class="vc_tta-title-text">Technisch NL</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php elseif (get_locale() == 'de_DE'): ?>
                                <?php if (!empty($vehicle->inb_de)): ?>
                                    <li class="active">
                                        <a href="#inge" data-toggle="tab">
                                            <span class="vc_tta-title-text">Inbegrepen DE</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (!empty($vehicle->tech_de)): ?>
                                    <li class="">
                                        <a href="#tech" data-toggle="tab">
                                            <span class="vc_tta-title-text">Technisch DE</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>
                        </ul>
                        <div class="tab-content">
                            <?php if (get_locale() == 'nl_NL'): ?>
                                <?php if (!empty($vehicle->inb_nl)): ?>
                                    <div class="tab-pane active" id="inge">
                                        <div class="wpb_text_column wpb_content_element ">
                                            <div class="wpb_wrapper">
                                                <p><?php echo $vehicle->inb_nl; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($vehicle->tech_nl)): ?>
                                    <div class="tab-pane" id="tech">
                                        <div class="wpb_text_column wpb_content_element ">
                                            <div class="wpb_wrapper">
                                                <p><?php echo $vehicle->tech_nl; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php elseif (get_locale() == 'de_DE'): ?>
                                <?php if (!empty($vehicle->inb_de)): ?>
                                    <div class="tab-pane active" id="inge">
                                        <div class="wpb_text_column wpb_content_element ">
                                            <div class="wpb_wrapper">
                                                <p><?php echo $vehicle->inb_de; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($vehicle->tech_de)): ?>
                                    <div class="tab-pane" id="tech">
                                        <div class="wpb_text_column wpb_content_element ">
                                            <div class="wpb_wrapper">
                                                <p><?php echo $vehicle->tech_de; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}

add_shortcode('hq_rental_tabs', 'hq_rental_tabs');