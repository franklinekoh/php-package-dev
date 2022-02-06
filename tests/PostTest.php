<?php

use Practice\BlogPost\Blog;
use Practice\BlogPost\Post;
use Faker\Factory;

test('it adds comment to post', function (){
    $postParam = [
        'id' => 1,
        'Title' => 'Post title',
        'image' => 'Path/to/image (optional)',
        'body' => 'post body',
        'author' => 'author',
        'hidden' => 0,
        'comments' => []
    ];

    $blog = new Blog();
    $blog->addPost($postParam);

    $faker = Factory::create();
    $commentBody = $faker->realText();
    $commentAuthor = $faker->name;
    $comment = [
        'body' => $commentBody,
        'author' => $commentAuthor
    ];

    $post = new Post(1, $blog);
    $post->addComment($comment);
    expect($post->allComments)->toContain($comment);
});


it('gets comments', function (){

    $postParam = [
        'id' => 1,
        'Title' => 'Post title',
        'image' => 'Path/to/image (optional)',
        'body' => 'post body',
        'author' => 'author',
        'hidden' => 0,
        'comments' => []
    ];

    $blog = new Blog();
    $blog->addPost($postParam);

    $post = new Post(1, $blog);
    for ($i = 0; $i < 10; $i++){

        $faker = Factory::create();
        $commentBody = $faker->realText();
        $commentAuthor = $faker->name;
        $comment = [
            'id' => $i + 1,
            'body' => $commentBody,
            'author' => $commentAuthor
        ];

        $post->addComment($comment);
    }

    expect($post->getComments(0, 80))->toHaveCount(10);
});

it('edits comments', function (){

    $postParam = [
        'id' => 1,
        'Title' => 'Post title',
        'image' => 'Path/to/image (optional)',
        'body' => 'post body',
        'author' => 'author',
        'hidden' => 0,
        'comments' => []
    ];

    $blog = new Blog();
    $blog->addPost($postParam);

    $comment = [
        'id' =>  1,
        'body' => 'comment body',
        'author' => 'comment author'
    ];

    $post = new Post(1, $blog);
    $post->addComment($comment);

    $comment['body'] = 'Comment body edit';

    $post->editComment($comment);

    expect($post->allComments)->toContain($comment);
});
