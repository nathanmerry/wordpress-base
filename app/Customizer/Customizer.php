<?php

namespace WordpressBase\Customizer;

class Customizer
{
    public function __construct()
    {
        add_action('customize_register', [$this, 'section']);
        add_action('customize_register', [$this, 'logo']);
        add_action('customize_register', [$this, 'colors']);
        add_action('customize_register', [$this, 'disclaimer']);
        add_action('customize_register', [$this, 'social']);
        add_action('customize_register', [$this, 'company']);
        add_action('customize_preview_init', [$this, 'loadScript']);
    }

    public function loadScript()
    {
        wp_enqueue_script('themezila-customizer', get_template_directory_uri() . '/dist/js/customizer.js', ['jquery','customize-preview'], null, true);
    }

    public function section($customize)
    {
        $customize->add_section('theme', [
            'title' => 'Theme',
            'priority' => 30,
        ]);

        $customize->add_section('social', [
            'title' => 'Social',
            'priority' => 40,
        ]);

        $customize->add_section('company', [
            'title' => 'Company',
            'priority' => 50,
        ]);
    }

    public function logo($customize)
    {
        $customize->add_setting('theme_logo');

        $customize->add_control(new \WP_Customize_Image_Control(
            $customize,
            'theme_logo',
            [
                'label' => 'Logo',
                'section' => 'theme',
                'settings' => 'theme_logo',
            ]
        ));
    }

    public function colors($customize)
    {
        $customize->add_setting('theme_primary');
    
        $customize->add_control(new \WP_Customize_Color_Control(
            $customize,
            'theme_primary',
            [
                'label' => 'Primary',
                'section' => 'theme',
                'settings' => 'theme_primary',
            ]
        )); 
        
        $customize->add_setting('theme_secondary');

        $customize->add_control(new \WP_Customize_Color_Control(
            $customize,
            'theme_secondary',
            [
                'label' => 'Secondary',
                'section' => 'theme',
                'settings' => 'theme_secondary',
            ]
        ));

        $customize->add_setting('theme_tertiary');

        $customize->add_control(new \WP_Customize_Color_Control(
            $customize,
            'theme_tertiary',
            [
                'label' => 'Tertiary',
                'section' => 'theme',
                'settings' => 'theme_tertiary',
            ]
        ));
    }

    public function disclaimer($customize)
    {
        $customize->add_setting('theme_disclaimer');

        $customize->add_control(new \WP_Customize_Image_Control(
            $customize,
            'theme_disclaimer',
            [
                'type' => 'text',
                'label' => 'Disclaimer',
                'section' => 'theme',
                'settings' => 'theme_disclaimer',
            ]
        ));
    }

    public function social($customize)
    {
        $customize->add_setting('facebook');

        $customize->add_control('facebook', [
            'type' => 'url',
            'label' => 'Facebook',
            'section' => 'social',
        ]);

        $customize->add_setting('twitter');

        $customize->add_control('twitter', [
            'type' => 'url',
            'label' => 'Twitter',
            'section' => 'social',
        ]);

        $customize->add_setting('linkedin');

        $customize->add_control('linkedin', [
            'type' => 'url',
            'label' => 'Linkedin',
            'section' => 'social',
        ]);
    }

    public function company($customize)
    {
        $customize->add_setting('address');

        $customize->add_control('address', [
            'type' => 'text',
            'label' => 'Address',
            'section' => 'company',
        ]);

        $customize->add_setting('phone_number');

        $customize->add_control('phone_number', [
            'type' => 'text',
            'label' => 'Phone Number',
            'section' => 'company',
        ]);

        $customize->add_setting('email');

        $customize->add_control('email', [
            'type' => 'text',
            'label' => 'Email',
            'section' => 'company',
        ]);
    }
}
