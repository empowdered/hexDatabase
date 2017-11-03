<?php
function to_int32($value) {

    $intval = bin2hex($value);

    // If 64 bit
    if (PHP_INT_SIZE === 8) {
        return ($intval - 0x100000000);
    }

    // 32 bit
    return $intval;
}
?>