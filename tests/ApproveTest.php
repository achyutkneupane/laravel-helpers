<?php

namespace AchyutN\LaravelHelpers\Tests;

use AchyutN\LaravelHelpers\Tests\Models\Approve;

class ApproveTest extends BaseTestCase
{

    public function test_change_to_approved()
    {
        $active = Approve::factory()->create();
        $active->setApproved();
        $this->assertFalse($active->approved_at == null);
        $this->assertTrue($active->rejected_at == null);
    }

    public function test_change_to_rejected()
    {
        $active = Approve::factory()->create(['approved_at' => now()]);
        $active->setRejected();
        $this->assertTrue($active->rejected_at != null);
        $this->assertTrue($active->approved_at == null);
    }

    public function test_change_to_pending()
    {
        $active = Approve::factory()->create(['approved_at' => now()]);
        $active->setPending();
        $this->assertTrue($active->approved_at == null);
        $this->assertTrue($active->rejected_at == null);
    }

    public function test_count_pending()
    {
        Approve::factory()->create(['approved_at' => now()]);
        $this->assertEquals(1, Approve::withPending()->count());
    }

    public function test_count_approved()
    {
        Approve::factory()->create(['approved_at' => now()]);
        Approve::factory()->count(10)->create();
        $this->assertEquals(1, Approve::count());
    }

    public function test_count_rejected()
    {
        Approve::factory()->count(10)->create();
        Approve::factory()->create(['rejected_at' => now()]);
        $this->assertEquals(1, Approve::withRejected()->count());
    }

    public function test_count_all()
    {
        Approve::factory()->count(10)->create();
        Approve::factory()->create(['rejected_at' => now()]);
        $this->assertEquals(11, Approve::withAll()->count());
    }

    public function test_count_only_pending()
    {
        Approve::factory()->count(10)->create();
        Approve::factory()->create(['approved_at' => now()]);
        $this->assertEquals(10, Approve::onlyPending()->count());
    }

    public function test_count_only_approved()
    {
        Approve::factory()->count(10)->create();
        Approve::factory()->create(['approved_at' => now()]);
        $this->assertEquals(1, Approve::count());
    }

    public function test_count_only_rejected()
    {
        Approve::factory()->count(10)->create();
        Approve::factory()->create(['rejected_at' => now()]);
        $this->assertEquals(1, Approve::onlyRejected()->count());
    }

}
