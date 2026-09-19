<?php

namespace Tests\Feature;

use Tests\TestCase;

class PhaseOneTest extends TestCase
{
    public function test_api_root_is_available(): void
    {
        $this->getJson('/api/v1/public/destinations')->assertStatus(200);
    }
}
