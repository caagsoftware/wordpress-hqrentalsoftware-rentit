<?php

if (! function_exists('hq_rentit_get_translations')) {
    function hq_rentit_get_translate($english, $greek)
    {
        return (get_locale() == 'el') ? $greek : $english;
    }
}

if (! function_exists('hq_rentit_get_translations')) {
    function hq_rentit_get_translations()
    {
        return array(
            'reservation_form_action'                       => hq_rentit_get_translate('/en/reservations', '/reservations'),
            'reservation_form_title'                        => hq_rentit_get_translate('Rent A Car in Athens', 'Ενοικιαση αυτοκινητου'),
            'reservation_form_subtitle'                     => hq_rentit_get_translate('All Discounts Just For You', 'Όλες οι εκπτώσεις μόνο για εσάς'),
            'reservation_form_inner_title'                  => hq_rentit_get_translate('Find cheap car rental in Athens', 'Βρείτε φθηνά ενοικιαζόμενα αυτοκίνητα στην Αθήνα'),
            'pick_up_location_form_label'                   => hq_rentit_get_translate('Pickup location', 'Τοποθεσία παραλαβής'),
            'pick_up_location_placeholder'                  => hq_rentit_get_translate('Choose Location', 'Επιλέξτε Τοποθεσία'),
            'return_location_form_label'                    => hq_rentit_get_translate('Return location', 'Επιλέξτε Τοποθεσία'),
            'return_location_placeholder'                   => hq_rentit_get_translate('Choose Location', 'Επιλέξτε Τοποθεσία'),
            'pick_up_date_form_label'                       => hq_rentit_get_translate('Pickup Date', 'Ημερομηνία παραλαβής'),
            'pick_up_date_placeholder'                      => hq_rentit_get_translate('dd / mm / yyyy', 'ημ / μμ / εεεε'),
            'pick_up_time_form_label'                       => hq_rentit_get_translate('Pickup Time', 'Ημερομηνία παραλαβής'),
            'pick_up_time_placeholder'                      => hq_rentit_get_translate('HH:MM', 'HH:MM'),
            'return_date_form_label'                        => hq_rentit_get_translate('Return Date', 'Ημερομηνία παράδοσης'),
            'return_date_placeholder'                       => hq_rentit_get_translate('dd / mm / yyyy', 'ημ / μμ / εεεε'),
            'return_time_form_label'                        => hq_rentit_get_translate('Return Time', 'Ημερομηνία παράδοσης'),
            'return_time_placeholder'                       => hq_rentit_get_translate('HH:MM', 'HH:MM'),
        );
    }
}