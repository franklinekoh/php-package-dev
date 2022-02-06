<?php


namespace Practice\BlogPost\Contracts;


interface PostContract
{
    /**
     * Add comment
     *
     * @param array $comment
     * @return mixed
     */
    public function addComment(array $comment): array;

    /**
     * Get all comments
     *
     * @param int $offset
     * @param int $limit
     * @return mixed
     */
    public function getComments(int $offset, int $limit): array;

    /**
     * Edit a comment
     *
     * @param array $comment
     * @return array
     */
    public function editComment( array $comment): array;
}