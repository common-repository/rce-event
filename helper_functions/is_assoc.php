<?php

function isAssoc( array $arr ) {
    if ( $arr === array() ) return false;
    return array_keys($arr) !== range(0, count($arr) - 1);
}
