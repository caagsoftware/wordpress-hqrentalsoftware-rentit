<?php

add_action('admin_menu','hq_rentit_settings_menu');
function hq_rentit_settings_menu()
{
    add_options_page(
        HQ_RENTIT_SETTING_PAGE_TITLE,
        HQ_RENTIT_SETTING_MENU_TITLE,
        'manage_options',
        HQ_RENTIT_SETTING_SLUG,
        'hq_rentit_settings_html'
    );
}

function hq_rentit_settings_html()
{
    $settings = hq_rentit_get_user_settings();
    ?>

    <div class="wrap">
        <?php if(isset($success)): ?>
            <div class="message updated"><p><?php echo $success; ?></p></div>
        <?php endif; ?>
        <div id="wrap">
            <h1>HQ Rentit Theme Settings</h1>
            <form action="" method="post">
                <table class="form-table">
                    <tbody>
                    <tr>
                        <th><label class="wp-heading-inline" id="title-prompt-text" for="title">Enable Rates Display</label></th>
                        <td>
                            <input name="<?php echo HQ_RENTIT_RATE_DISPLAY_OPTION; ?>" type="checkbox" id="thumbnail_crop" value="1" <?php echo ($settings[HQ_RENTIT_RATE_DISPLAY_OPTION] == '1' ? 'checked=checked' : '')?>>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <?php //wp_nonce_field( CAAG_HQ_RENTAL_NONCE, 'caag_nonce' ); ?>
                <input type="submit" name="publish" id="publish" class="button button-primary button-large" value="Save">
            </form>
        </div>
            <style>
                .fw-brz-dismiss {
                    border-left-color: #d62c64 !important;
                }
                .fw-brz-dismiss p:last-of-type a {
                    color: #fff;
                    font-size: 13px;
                    line-height: 1;
                    background-color: #d62c64;
                    box-shadow: 0px 2px 0px 0px #981e46;
                    padding: 11px 27px 12px;
                    border: 1px solid #d62c64;
                    border-bottom: 0;
                    border-radius: 3px;
                    text-shadow: none;
                    height: auto;
                    text-decoration: none;
                    display:inline-block;
                    transition: all 200ms linear;
                }
                .fw-brz__btn-install:hover {
                    background-color: #141923;
                    color: #fff;
                    border-color: #141923;
                    box-shadow: 0px 2px 0px 0px #141923;
                }
            </style>
            <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
        </div>
    </div>
    <?php
    if(!empty($_POST)){
        hq_rentit_save_settings($_POST);
        $success = __('Settings were successfully saved!');
    }?>
    <?php if(isset($success)): ?>
    <div class="message updated"><p><?php echo $success; ?></p></div>
    <script>
        document.getElementById("wrap").remove();
    </script>
<?php endif; ?>
    <?php if(isset($error)): ?>
    <div class="message updated"><p><?php echo $error; ?></p>
    </div>
<?php endif; ?>
    <?php
}
/*
 * Save Caag Rental Settings Options
 * @param Array
 * @return void
 */
function hq_rentit_save_settings($settings)
{
    if(!empty($settings[HQ_RENTIT_RATE_DISPLAY_OPTION])){
        if($settings[HQ_RENTIT_RATE_DISPLAY_OPTION] == '1'){
            update_option(HQ_RENTIT_RATE_DISPLAY_OPTION, '1');
        }
    }else{
        update_option(HQ_RENTIT_RATE_DISPLAY_OPTION, '0');
    }
}

function hq_rentit_get_user_settings(){
    $rates = get_option(HQ_RENTIT_RATE_DISPLAY_OPTION, '0');
    return array(
            HQ_RENTIT_RATE_DISPLAY_OPTION   =>  $rates
    );
}