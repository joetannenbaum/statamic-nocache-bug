<?php

use Illuminate\Support\Facades\Route;

app()->instance('example_count', mt_rand(0, 10));

(new class extends \Statamic\Tags\Tags
{
    public static $handle = 'example_count';

    public function wildcard($method)
    {
        $count = app('example_count');
        $count++;
        app()->instance('example_count', $count);

        return $this->context->get($method).$count;
    }
})::register();

Route::group(
    [
        'middleware' => ['statamic.web'],
    ],
    function() {
        Route::statamic('/', 'pages.home', ['layout' => 'layouts.default'   ])->name('home');
        Route::statamic('login', 'pages.login', ['layout' => 'layouts.default',
            'array' => [
                ['value' => 'One'],
                ['value' => 'Two'],
                ['value' => 'Three'],
            ],
        ])->name('login');
    }
);