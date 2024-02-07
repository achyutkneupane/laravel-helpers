<?php

namespace AchyutN\LaravelHelpers\Tests;


use AchyutN\LaravelHelpers\Tests\Models\ApproveActive;

class ApproveActiveTest extends BaseTestCase
{

    public function test_change_to_approved()
    {
        $approve_active = ApproveActive::factory()->create();
        $approve_active->setApproved();
        $this->assertFalse($approve_active->approved_at == null);
        $this->assertTrue($approve_active->rejected_at == null);
    }

    public function test_active_count()
    {
        ApproveActive::factory(10)->create(['rejected_at' => now()]);
        $this->assertEquals(0, ApproveActive::count());
    }

    public function test_active_and_approved_count()
    {
        ApproveActive::factory(10)->create(['approved_at' => now()]);
        $this->assertEquals(10, ApproveActive::count());
    }

    public function test_active_and_pending_count()
    {
        ApproveActive::factory(10)->create();
        $this->assertEquals(0, ApproveActive::count());
    }

    public function test_active_and_rejected_count()
    {
        ApproveActive::factory(10)->create(['rejected_at' => now()]);
        $this->assertEquals(0, ApproveActive::count());
    }

    public function test_inactive_and_approved_count()
    {
        ApproveActive::factory(10)->create(['approved_at' => now(), 'inactive_at' => now()]);
        $this->assertEquals(0, ApproveActive::count());
    }

    public function test_active_and_change_to_approved()
    {
        $approve_active = ApproveActive::factory()->create();
        $approve_active->setApproved();
        $this->assertEquals(1, ApproveActive::count());
    }

    public function test_inactive_and_change_to_approved()
    {
        $approve_active = ApproveActive::factory()->create(['inactive_at'=>now()]);
        $approve_active->setApproved();
        $this->assertEquals(0, ApproveActive::count());
    }

    public function test_approved_and_change_to_active()
    {
        $approve_active = ApproveActive::factory()->create(['approved_at'=>now(),'inactive_at'=>now()]);
        $approve_active->setActive();
        $this->assertEquals(1, ApproveActive::count());
    }

}
