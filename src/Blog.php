<?php
declare(strict_types=1);

namespace Practice\BlogPost;

use Practice\BlogPost\Contracts\BlogContract;


class Blog implements BlogContract
{

    private array $posts = [];

    /**
     * @inheritDoc
     *
     *
     */
    public function addPost(array $postParams): array
    {
         $this->posts[] = $postParams;
         return $this->posts;
    }

    /**
     * @inheritDoc
     */
    public function getPosts(int $offset = 0, int $limit = 20): array
    {
        return array_slice($this->posts, $offset, $limit);
    }

    /**
     * @inheritDoc
     */
    public function getPost(int $postId): array
    {
        foreach ( $this->posts as $key => $post){
            if ($post['id'] == $postId){
                return $post;
            }
        }

        return [];
    }

    /**
     * @inheritDoc
     */
    public function editPost(int $postId, array $postParam): array
    {
        // TODO: Implement editPost() method.
        $posts = $this->posts;
        foreach ( $posts as $key => $post){
            if ($post['id'] == $postId){
                $posts[$key] = $postParam;
            }
        }

        $this->posts = $posts;
        return $posts;
    }
}