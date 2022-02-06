<?php
declare(strict_types=1);

namespace Practice\BlogPost\Contracts;


interface BlogContract
{

    /**
     * Add posts
     *
     * @param array $postParams
     * @return array
     */
    public function addPost(array $postParams): array;

    /**
     * Get All posts in the blog
     *
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function getPosts(int $offset, int $limit): array;

    /**
     * Get a single post in the blog
     *
     * @param int $postId
     * @return array
     */
    public function getPost(int $postId): array;

    /**
     * Edit a post in the blog
     *
     * @param int $postId
     * @param array $postParam
     * @return array
     */
    public function editPost(int $postId, array $postParam): array;
}