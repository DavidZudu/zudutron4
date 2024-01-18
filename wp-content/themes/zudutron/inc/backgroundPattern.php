<?php

function getBackgroundPattern($type)
{
    switch ($type) {
        case 'one':
            return '<img src="https://placehold.co/800x300/444444/ffffff?text=PatternOne" alt="">';
            break;
        case 'two':
            return '<img src="https://placehold.co/800x300/444444/ffffff?text=PatternTwo" alt="">';
            break;

        default:
            return '';
    }
}
