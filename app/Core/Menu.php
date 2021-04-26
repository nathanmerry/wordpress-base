<?php

namespace WordpressBase\Core;

trait Menu
{
    public function getMenuAttribute()
    {
        $locations = get_nav_menu_locations();
        $data = [];

        foreach ($locations as $key => $menu) {
            $items = $this->formatMenu(wp_get_nav_menu_items($menu));
            $items = $this->setActiveState($items);
            $items = $this->buildTree($items);
            $data[$key] = $items;
        }

        return $data;
    }


    private function formatMenu($items)
    {
        $data = [];

        if ($items) {
            foreach ($items as $item) {
                $menu = [
                    'id' => $item->ID,
                    'url' => !empty($item->url) ? $item->url : null,
                    'title' => !empty($item->title) ? $item->title : null,
                    'target' => !empty($item->target) ? $item->target : null,
                    'attr' => !empty($item->attr_title) ? $item->attr_title : null,
                    'classes' => array_filter($item->classes),
                    'type' => $item->type,
                    'parent_id' => (int) $item->menu_item_parent,
                    'post_id' => (int) $item->object_id,
                ];

                $data[] = $menu;
            }
        }


        return $data;
    }

    private function setActiveState($items)
    {
        $id = (is_home() === true) ? get_option('page_for_posts') : get_the_ID();

        $menu = $items;
        
        if (is_category()) {
            $type = 'taxonomy';
            $id = get_query_var('cat');
        } else {
            $type = 'post_type';
        }

        foreach ($items as $key => $item) {
            if ($item['post_id'] == $id and $item['type'] == $type) {
                $menu[$key]['classes'] = ['active'];
            }
            
            if ($item['parent_id'] !== 0 and $item['type'] == $type) {
                $index      = $item['parent_id'];
                $post_id    = $item['post_id'];
            }

            if (isset($post_id)) {
                if ($post_id == $id) {
                    foreach ($items as $key =>  $item) {
                        if ($item['id'] === $index) {
                            $menu[$key]['classes'] = ['active'];
                            $index = $item['parent_id'];
                        }
                    }
                    foreach ($items as $key =>  $item) {
                        if ($item['id'] === $index) {
                            $menu[$key]['classes'] = ['active'];
                        }
                    }
                }
            }
        }

        return $menu;
    }

    private function buildTree(array $flatList)
    {
        $grouped = [];

        foreach ($flatList as $node) {
            $grouped[$node['parent_id']][] = $node;
        }


        $fnBuilder = function ($siblings) use (&$fnBuilder, $grouped) {
            if ($siblings) {
                foreach ($siblings as $k => $sibling) {
                    $id = $sibling['id'];
                    if (isset($grouped[$id])) {
                        $sibling['children'] = $fnBuilder($grouped[$id]);
                    }
                    $siblings[$k] = $sibling;
                }
            }
            return $siblings;
        };

        $tree = isset($grouped[0]) ? $fnBuilder($grouped[0]) : [];

        return $tree;
    }
}
