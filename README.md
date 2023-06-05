#Blog Posts Package

A simple blog posts package in PHP used for teaching package development in PHP on my [free youtube course](https://youtu.be/SAmvsOIFaec).

##installation

To install this package, use composer
 
 ```bash
composer require ekoh/blog-posts
```

##Usage

```php
$blog = Blog::getInstance();

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
