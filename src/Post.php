<?php


namespace Practice\BlogPost;
use Practice\BlogPost\Contracts\PostContract;
use Practice\BlogPost\Blog;
use Practice\BlogPost\Contracts\BlogContract;

class Post implements PostContract
{

    private BlogContract $blog;
    public int $postId;
    public array $allComments;
    /**
     * Post constructor.
     *
     * @param int $postId
     * @param BlogContract $blog
     */
    public function __construct(int $postId, BlogContract $blog)
    {
        $this->postId = $postId;
        $this->blog = $blog;
        $this->getAllComments();
    }

    /**
     * @inheritDoc
     */
    public function addComment(array $comment): array
    {

       $postParam = $this->blog->getPost($this->postId);

       if (!empty($postParam)){
           $this->allComments[] = $comment;
           $postParam['comments'] = $this->allComments;
           $this->blog->editPost($this->postId, $postParam);
           return $this->allComments;
       }

       return $this->allComments;
    }

    /**
     * @inheritDoc
     */
    public function getComments(int $offset, int $limit): array
    {
        return array_slice($this->allComments, $offset, $limit);
    }

    public function getAllComments(): bool {
        $post = $this->blog->getPost($this->postId);

        if (array_key_exists('comments', $post)){
            $this->allComments = $post['comments'];
            return true;
        }
        return false;
    }
    /**
     * @inheritDoc
     */
    public function editComment(array $comment): array
    {
        foreach ($this->allComments as $singleComment){
            if ($comment['id'] == $singleComment['id']){
                $this->allComments[$comment['id']] = $comment;
                continue;
            }
        }

        return $comment;
    }
}