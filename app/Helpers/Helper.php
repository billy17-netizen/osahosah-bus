<?php

if (!function_exists('generateUniqueTicketNumber')) {
    function generateUniqueTicketNumber()
    {
        // Generate a random string with 6 characters
        $random = strtoupper(Str::random(6));

        // Return the unique ticket number
        return $random;
    }
}