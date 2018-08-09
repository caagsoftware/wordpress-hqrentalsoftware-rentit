<?php

/*
 * Setting Options on Init
 * @return void
 */
function hq_rentit_options_registration()
{
    if(! get_option(HQ_RENTIT_RATE_DISPLAY_OPTION)){
        add_option(HQ_RENTIT_RATE_DISPLAY_OPTION,'1');
    }
}