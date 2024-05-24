<?php

use Random\RandomException;

if (!function_exists('generateUniqueTicketNumber')) {
    /**
     * @throws RandomException
     */
    function generateUniqueTicketNumber(): string
    {
        return 'TICKET' . date('YmdHis') . random_int(1000, 999999);

    }
}
