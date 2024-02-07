<?php

namespace AchyutN\LaravelHelpers\Tests;

use AchyutN\LaravelHelpers\Tests\Models\Active;

class ActiveTest extends BaseTestCase
{

    public function test_change_to_approved()
    {
        $active = Active::factory()->create();
        $active->setApproved();
        $this->assertFalse($active->approved_at == null);
        $this->assertTrue($active->rejected_at == null);
    }

    public function test_change_to_rejected()
    {
        $active = Active::factory()->create(['approved_at' => now()]);
        $active->setRejected();
        $this->assertTrue($active->rejected_at != null);
        $this->assertTrue($active->approved_at == null);
    }

    public function test_change_to_pending()
    {
        $active = Active::factory()->create(['approved_at' => now()]);
        $active->setPending();
        $this->assertTrue($active->approved_at == null);
        $this->assertTrue($active->rejected_at == null);
    }

    public function test_count_pending()
    {
        Active::factory()->create(['approved_at' => now()]);
        $this->assertEquals(1, Active::withPending()->count());
    }

    public function test_count_approved()
    {
        Active::factory()->create(['approved_at' => now()]);
        $this->assertEquals(1, Active::count());
    }



}
