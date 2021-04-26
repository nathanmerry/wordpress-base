<?php

namespace WordpressBase\Core;

trait Author
{
    public function getAuthorAttribute()
    {
        global $post;

        $id = get_the_author_meta('ID') ? (int) get_the_author_meta('ID') : (int) $post->post_author;
        $image = get_field('profile_picture', 'user_'. $id);

        return [
            'firstName' => get_the_author_meta('first_name', $id),
            'lastName' => get_the_author_meta('last_name', $id),
            'displayName' => get_the_author_meta('display_name', $id),
            'email' => get_the_author_meta('email', $id),
            'description' => wpautop(get_the_author_meta('description', $id)),
            'permalink' => get_author_posts_url($id),
            'avatar' => [
                'large' => is_null($image) ? null : \InvImage\Image::make($image)->smartcrop(208, 208),
                'small' => is_null($image) ? null : \InvImage\Image::make($image)->smartcrop(96, 96),
            ],
            'social' => [
                'facebook' => get_the_author_meta('facebook', $id),
                'twitter' => get_the_author_meta('twitter', $id),
                'instagram' => get_the_author_meta('instagram', $id),
                'linkedin' => get_the_author_meta('linkedin', $id),
                'myspace' => get_the_author_meta('myspace', $id),
                'pinterest' => get_the_author_meta('pinterest', $id),
                'soundcloud' => get_the_author_meta('soundcloud', $id),
                'tumblr' => get_the_author_meta('tumblr', $id),
                'youtube' => get_the_author_meta('youtube', $id),
                'wikipedia' => get_the_author_meta('wikipedia', $id),
            ]
        ];
    }
}
