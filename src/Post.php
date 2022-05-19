<?php


namespace Practice\BlogPost;

use Practice\BlogPost\Contracts\PostContract;
use Practice\BlogPost\Contracts\BlogContract;
use Practice\BlogPost\Validators\AddCommentValidator;
use Practice\BlogPost\Validators\EditCommentValidator;

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
        $validator = new AddCommentValidator($comment);
        if ($validator->validate()){
            $postParam = $this->blog->getPost($this->postId);

            if (!empty($postParam)){
                $this->allComments[] = $comment;
                $postParam['comments'] = $this->allComments;
                $this->blog->editPost($this->postId, $postParam);
                return $this->allComments;
            }

            return $this->allComments;
        }
        return $validator->errors();
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
        $validator = new EditCommentValidator($comment);

        if ($validator->validate()){
            foreach ($this->allComments as $singleComment){
                if ($comment['id'] == $singleComment['id']){
                    $this->allComments[$comment['id']] = $comment;
                    continue;
                }
            }

            return $comment;
        }

       return $validator->errors();
    }
}