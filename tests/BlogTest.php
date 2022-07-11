<?php

use Practice\BlogPost\Blog;
use Faker\Factory;

test('it adds post', function () {

    $postParam = [
        'id' => 1,
        'title' => 'Post title',
        'image' => 'Path/to/image (optional)',
        'body' => 'character ksjdksjdkjsk skjdksjdkjd',
        'author' => 'author',
        'hidden' => 1,
        'comments' => []
    ];

    $blog = Blog::getInstance();

    expect($blog)->toBeInstanceOf(\Practice\BlogPost\Contracts\BlogContract::class);
    expect($blog->addPost($postParam))->toContain($postParam);
});

test('it gets posts and pagination works', function (){

    $total_number_of_posts = 100;
    $faker = Factory::create();

    $blog = Blog::getInstance();
    for($i = 1; $i < $total_number_of_posts; $i++){
        $postParam = [
            'id' => $i,
            'title' => $faker->sentence(),
            'image' => $faker->imageUrl(),
            'body' => $faker->text(500),
            'author' => $faker->name,
            'hidden' => $faker->boolean,
            'comments' => []
        ];

        $blog->addPost($postParam);
    }

    expect($blog->getPosts(10, 80))->toHaveCount(80);
});


test('it edits post', function (){

    $postParam = [
        'id' => 101,
        'title' => 'Post title',
        'image' => 'Path/to/image (optional)',
        'body' => 'post body should exceed 20 characters',
        'author' => 'author',
        'hidden' => 0,
        'comments' => []
    ];

    $blog = Blog::getInstance();

    $blog->addPost($postParam);

    $postParam['title'] = 'edit post title';
    $blog->editPost(1, $postParam);

    expect($blog->getPosts())->toContain($postParam);

});

test('it gets post by id', function (){
    $postParam = [
        'id' => 1,
        'title' => 'Post title',
        'image' => 'Path/to/image (optional)',
        'body' => 'post body is a body of engineer',
        'author' => 'author',
        'hidden' => 0,
        'comments' => []
    ];

    $blog = Blog::getInstance();

    $blog->addPost($postParam);
//    var_dump($blog->getPosts());
////    var_dump($blog->getPost(1), $postParam);
    expect($blog->getPost(1))->toBe($postParam);
});
