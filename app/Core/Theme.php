<?php

namespace WordpressBase\Core;

trait Theme
{
    public function getThemeAttribute()
    {
        return [
            'logo' => get_theme_mod('theme_logo'),
            'color' => [
                'primary' => get_theme_mod('theme_primary', '#5e24ef'),
                'secondary' => get_theme_mod('theme_secondary', '#b33cfc'),
                'tertiary' => get_theme_mod('theme_tertiary', '#1ed794'),
            ],
            'disclaimer' => get_theme_mod('theme_disclaimer'),
            'social' => [
                'facebook' => get_theme_mod('facebook'),
                'twitter' => get_theme_mod('twitter'),
                'linkedin' => get_theme_mod('linkedin')
            ],
            'company' => [
                'email' => get_theme_mod('email'),
                'phoneNumber' => get_theme_mod('phone_number'),
                'address' => get_theme_mod('address')
            ]
        ];
    }
}
