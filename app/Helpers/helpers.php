<?php

if (!function_exists('getInitials')) {
    function getInitials($name){
        $nameParts = explode(' ' , trim($name));
        $initials = strtoupper(substr($nameParts[0] , 0 , 1));

        if (count($nameParts) > 1) {
            $initials .= strtoupper(substr($nameParts[count($nameParts) - 1] , 0 , 1));
        }
        else{
            $initials .= strtoupper(substr($nameParts[0] , 1 , 1) ?? '');
        }

        return $initials;
    }
}