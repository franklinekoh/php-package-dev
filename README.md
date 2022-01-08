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

$blog->addPost([
    'Title' => 'Post title',
    'image' => 'Path/to/image (optional)',
    'body' => 'post body',
    'author' => 'author',
]);

$blog->getPost($postId);

$blog->getPosts($offset, $limit);

$post = new Post($postId);

$post->addComment([
    'body' => 'post comment',
    'author' => 'optional'
]);

$post->getComments();
```