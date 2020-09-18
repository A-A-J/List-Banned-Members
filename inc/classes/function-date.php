<?php

function nicetime( $date ) {

    if ( empty( $date ) ) {

        return Lang['There_is_no'];

    }

    $periods = array( 'ثانية', 'دقيقة', 'ساعات', 'يوم', 'أسبوع', 'شهر', 'سنة', 'عشر سنوات' );

    $lengths = array( '60', '60', '24', '7', '4.35', '12', '10' );

    $now            = time();

    $unix_date      = strtotime( $date );

    if ( empty( $unix_date ) ) {

        return 'تاريخ سيء';

    }

    if ( $now > $unix_date ) {

        $difference     = $now - $unix_date;

        $tense         = 'منذ';

    } else {

        $difference     = $unix_date - $now;

        $tense         = 'من الان';

    }

    for ( $j = 0; $difference >= $lengths[$j] && $j < count( $lengths )-1;

    $j++ ) {

        $difference /= $lengths[$j];

    }

    $difference = round( $difference );

    return "{$tense} $difference $periods[$j]";
    
}