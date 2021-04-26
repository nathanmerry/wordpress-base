<?php

require 'vendor/autoload.php';

new WordpressBase\Enqueue\Enqueue;
new WordpressBase\Customizer\Customizer;
new WordpressBase\Route\Api\ContactForm;

function getimg($img)
{
    return get_bloginfo('template_url') . "/app/Resources/images/{$img}";
}

function add_file_types_to_uploads($file_types)
{
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg';
    $file_types = array_merge($file_types, $new_filetypes);
    return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');

add_theme_support('title-tag');
