<?php

namespace AchyutN\LaravelHelpers\Tests;

use AchyutN\LaravelHelpers\Tests\Models\Article;

class InactiveTest extends BaseTestCase
{
    public function test_change_to_inactive()
    {
        $article = Article::factory()->create();
        $article->setInactive();
        $this->assertFalse($article->inactive_at == null);
    }

    public function test_change_to_active()
    {
        $article = Article::factory()->create(['inactive_at' => now()]);
        $article->setActive();
        $this->assertTrue($article->inactive_at == null);
    }

    public function test_count_active()
    {
        Article::factory()->count(5)->create();
        Article::factory()->count(3)->create(['inactive_at' => now()]);
        $this->assertEquals(3, Article::onlyInactive()->count());
        $this->assertEquals(5, Article::count());
        $this->assertEquals(8, Article::withInactive()->count());
        $this->assertEquals(5, Article::withoutInactive()->count());
    }
}