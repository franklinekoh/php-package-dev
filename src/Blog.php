<?php
declare(strict_types=1);

namespace Practice\BlogPost;

use Practice\BlogPost\Contracts\BlogContract;
use Practice\BlogPost\Validators\AddPostValidator;
use Practice\BlogPost\Validators\EditPostValidator;


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
         $validator = new AddPostValidator($postParams);

         if ($validator->validate()){
             $this->posts[] = $postParams;
             return $this->posts;
         }
         return $validator->errors();
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
        $validator = new EditPostValidator($postParam);

        if ($validator->validate()){
            $posts = $this->posts;
            foreach ( $posts as $key => $post){
                if ($post['id'] == $postId){
                    $posts[$key] = $postParam;
                }
            }

            $this->posts = $posts;
            return $posts;
        }

        return $validator->errors();
    }
}