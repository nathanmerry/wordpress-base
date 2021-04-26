<?php

namespace WordpressBase\Route\Api;

class ContactForm extends \WP_REST_Controller
{
    public $namespace = 'wordpressbase/v1';

    public function __construct()
    {
        add_action('rest_api_init', [$this, 'registerRoutes']);
    }

    public function registerRoutes()
    {
        register_rest_route(
			$this->namespace,
			'/contact/',
			['methods' => 'GET', 'callback' => [$this, 'emailForm']]
		);
    }

    public function emailForm(\WP_REST_Request $request)
    {
        $body = $request->get_params();

        $headers = [
            "From: {$body['firstName']} {$body['lastName']} <{$body['email']}>", 
            "Phone Number: {$body['phone']}", 
            "Company: {$body['company']}", 
        ];

        $mail = wp_mail( 'contact@test.com', 'Contact Form', $body['message'], $headers );

        if ($mail) {
            return ['ok' => true];
        } else {
            return ['ok' => false];
        }
    }
}