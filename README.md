#Blog Posts Package

A simple blog posts package in PHP

##installation

To install this package, use composer
 
 ```bash
composer require ekoh/blog-posts
```

##Usage

```php
$blog = new Blog();

$postArray = [
                 'id' => 1,
                 'Title' => 'Post title',
                 'image' => 'Path/to/image (optional)',
                 'body' => 'post body',
                 'author' => 'author',
                 'hidden' => 0,
                 'comments' => []
             ];

$blog->addPost($postArray);


$blog->getPosts($offset, $limit);

$blog->editPost($postId, $postArray);

$blog->getPost($postId);

$post = new Post($postId);

$commentArray = [
                   'body' => 'post comment',
                   'author' => 'optional'
               ];

$post->addComment($commentArray);

$post->getComments($offset, $limit);

$post->editComment($commentId, $commentArray);
```