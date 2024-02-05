<?php

namespace AchyutN\LaravelHelpers\Tests;

use AchyutN\LaravelHelpers\Tests\BaseTestCase;
use AchyutN\LaravelHelpers\Tests\Models\Article;

class SlugTest extends BaseTestCase
{

    public function test_title_can_be_slugified()
    {
        $article = Article::factory()->create(['title' => 'This is a test title']);
        $this->assertEquals('this-is-a-test-title', $article->slug);
    }

    public function test_title_stays_same_after_update()
    {
        $article = Article::factory()->create(['title' => 'This is a test title']);
        $this->assertEquals('this-is-a-test-title', $article->slug);
        $article->update(['title' => 'This is a new title']);
        $this->assertEquals('this-is-a-test-title', $article->slug);
    }

    public function test_slugs_with_same_title()
    {
        $article1 = Article::factory()->create(['title' => 'This is a test title']);
        $article2 = Article::factory()->create(['title' => 'This is a test title']);
        $this->assertEquals('this-is-a-test-title', $article1->slug);
        $this->assertEquals('this-is-a-test-title-2', $article2->slug);
    }

    public function test_slugs_with_same_title_and_soft_deleted()
    {
        $article1 = Article::factory()->create(['title' => 'This is a test title']);
        $this->assertEquals('this-is-a-test-title', $article1->slug);
        $article1->delete();
        $article2 = Article::factory()->create(['title' => 'This is a test title']);
        $this->assertEquals('this-is-a-test-title', $article2->slug);
        $article3 = Article::factory()->create(['title' => 'This is a test title']);
        $this->assertEquals('this-is-a-test-title-2', $article3->slug);
    }
}