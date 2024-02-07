<?php

namespace AchyutN\LaravelHelpers\Tests;

use AchyutN\LaravelHelpers\Tests\Models\Article;

class ApproveTest extends BaseTestCase
{
    public function test_change_to_approved()
    {
        $article = Article::factory()->create();
        $article->setApproved();
        $this->assertTrue($article->approved_at != null);
        $this->assertTrue($article->rejected_at == null);
    }

    public function test_change_to_rejected()
    {
        $article = Article::factory()->create();
        $article->setRejected();
        $this->assertTrue($article->rejected_at != null);
        $this->assertTrue($article->approved_at == null);
    }

    public function test_change_to_pending()
    {
        $article = Article::factory()->create(['approved_at'=>now()]);
        $article->setPending();
        $this->assertTrue($article->approved_at == null);
        $this->assertTrue($article->rejected_at == null);
    }

    public function test_count_approved()
    {
        Article::factory()->count(5)->create();
        Article::factory()->count(4)->create(['approved_at' => now()]);
        Article::factory()->count(3)->create(['rejected_at' => now()]);
        $this->assertEquals(9, Article::withPending()->count());
        $this->assertEquals(5, Article::onlyPending()->count());
        $this->assertEquals(8, Article::withoutApproved()->count());
        $this->assertEquals(7, Article::withRejected()->count());
        $this->assertEquals(3, Article::onlyRejected()->count());
        $this->assertEquals(12, Article::withAll()->count());
        $this->assertEquals(12, Article::count());
    }


}
