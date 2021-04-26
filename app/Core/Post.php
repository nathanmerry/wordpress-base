<?php

namespace WordpressBase\Core;

trait Post
{
    public static $exclude = [];

    public function getPosts($limit = -1, $categories = false)
    {
        $args = [
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $limit,
            'post__not_in' => $this::$exclude,
            'ignore_sticky_posts' => true,
        ];

        if ($categories) {
            $args['category__in'] = $categories;
        }

        $query = new \WP_Query($args);

        $posts = [];

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $this::$exclude[] = get_the_ID();

                $post = get_post();
                $posts[] = $this->getPostAttribute($post, true);
            }
        }

        wp_reset_postdata();
        return $posts;
    }

    public function getPostAttribute($post = null, $loop = false)
    {
        $post = $post ? $post->to_array() : get_post()->to_array();
        $post = self::replacePostKeys($post);

        return [
            "id" => get_the_ID(),
            "author" => $post['author'],
            "date" => self::date(),
            "content" => self::content($post),
            "title" => self::title($loop),
            "excerpt" => self::excerpt($post),
            "status" => $post['status'],
            "name" => $post['name'],
            "parent" => $post['parent'],
            "type" => $post['parent'],
            "datetime" => self::datetime(),
            "image" => self::image($post),
            "categories" => self::categories($post),
            "nextPrevious" => [
                'previous' => self::transformNextPrevious(get_next_post()),
                'next' => self::transformNextPrevious(get_previous_post()),
            ],
            "comments" => self::comments($post),
            "permalink" => get_the_permalink(),
            "tags" => self::tags($post)    
        ];
    }

    private static function getPostWithChangedKeys($post)
    {
        $post = $post->to_array();
        return self::replacePostKeys($post);
    }

    private static function replacePostKeys($post)
    {
        foreach ($post as $key => $item) {
            unset($post[$key]);
            $key = str_replace('post_', '', strtolower($key));
            $post[$key] = $item;
        }

        return $post;
    }

    private static function title($loop = false)
    {
        if ($loop) {
            return get_the_title();
        }

        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            } else {
                return 'Latest Posts';
            }
        }

        if (is_archive()) {
            return get_the_archive_title();
        }

        if (is_search()) {
            return sprintf('Search Results for %s', get_search_query());
        }

        if (is_404()) {
            return 'Not Found';
        }

        return get_the_title();
    }

    private static function content($post)
    {
        return apply_filters('the_content', $post['content']);
    }

    private static function excerpt($post)
    {
        $limit = 15;

        $excerpt = explode(' ', $post['excerpt'], $limit);
        
        if (count($excerpt) >= $limit) {
            array_pop($excerpt);
            $excerpt = implode(' ', $excerpt) . '...';
            return preg_replace('`[[^]]*]`', '', $excerpt);
        } else {
            $excerpt = implode(' ', $excerpt);
            return preg_replace('`[[^]]*]`', '', $excerpt);
        }
    }

    private static function date()
    {
        return apply_filters('date-post', get_the_date());
    }

    private static function datetime()
    {
        return get_the_date('Y-m-d H:i:s');
    }

    private static function categories()
    {
        $categories = get_the_category();

        return array_map(fn ($category) => [
            'id' => $category->term_id,
            'name' => $category->name,
            'slug' => $category->slug,
            'permalink' => get_term_link($category)
        ], $categories ?? []);
    }

    private static function tags($post)
    {
        $tags = get_the_tags($post['id']);

        if (!$tags) {
            return;
        }

        $this->post['tags'] = array_map(fn ($tag) => [
            'id' => $tag->term_id,
            'name' => $tag->name,
            'slug' => $tag->slug,
            'permalink' => get_term_link($tag)
        ], $tags);
    }

    private static function transformNextPrevious($post)
    {
        if ($post) {
            return [
                'title' => get_the_title($post->ID),
                'permalink' => get_the_permalink($post->ID),
                'thumbnail' => get_the_post_thumbnail_url($post->ID, 'thumbnail'),
            ];
        } else {
            return null;
        }
    }

    private static function comments($post)
    {
        if (!$post) return null;
        
        return [
            'count' => $post['comment_count'],
            'status' => $post['comment_status'],
        ];
    }

    private static function image()
    {
        return get_the_post_thumbnail_url(null, 'full');
    }
}
