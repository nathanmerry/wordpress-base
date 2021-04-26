<?php

namespace WordpressBase\Enqueue;

class Enqueue
{
    public function __construct()
    {
        add_action('init', [$this, 'navigation']);
        add_action('wp_enqueue_scripts', [$this, 'enqueueStyle']);
        add_action('admin_enqueue_scripts', [$this, 'enqueueAdminStyle']);
        add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);
        add_theme_support('post-thumbnails');
        add_action('init', [$this, 'removeEditor'], 100);
    }

    public function navigation()
    {
        register_nav_menus([
            'primary' => 'Primary Menu',
            'footer' => 'Footer Menu'
        ]);
    }

    public function getAsset($asset)
    {
        return get_template_directory_uri() . '/dist' . $asset;
    }

    public function enqueueStyle()
    {
        wp_enqueue_style('MonefizeApp', $this->getAsset('/css/app.css'), false);
    }

    public function enqueueAdminStyle()
    {
        wp_enqueue_style('MonefizeAdmin', $this->getAsset('/css/admin.css'), false);
    }

    public function enqueueScripts()
    {
        wp_enqueue_script('jquery');
        wp_enqueue_script('MonefizeScripts', $this->getAsset('/js/app.js'), [], false, true);
    }

    public function removeEditor()
    {
        $post_type = 'your post type';
        remove_post_type_support($post_type, 'editor');
    }
}
