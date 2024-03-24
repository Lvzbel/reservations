<?php

namespace Tests\Feature\AvailableTimes;
use App\Models\AvailableTime;
use App\Models\Provider;
use App\Modules\AvailableTimes\Queries\GetAvailableTimesQuery;
use Carbon\Carbon;
use Tests\TestCase;

class GetAvailableTimesQueryTest extends TestCase
{
    public GetAvailableTimesQuery $query;
    public function setUp(): void
    {
        parent::setUp();
        $this->query = new GetAvailableTimesQuery();
    }

    public function test_get_available_times_by_date()
    {
        $provider = Provider::factory()->create();
        $startTime = Carbon::tomorrow()->setHour(8);
        $endTime = Carbon::tomorrow()->setHour(9);

        $time = AvailableTime::factory()->create([
            'provider_id' => $provider->id,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ]);

        $availibilityDay = Carbon::tomorrow()->toDateString();

        $result = $this->query->execute($provider->id, $availibilityDay);

        $this->assertEquals($provider->id, $result->provider_id);
        $this->assertEquals($startTime, $result->start_time);
        $this->assertEquals($endTime, $result->end_time);
    }

    public function test_get_available_times_with_wrong_date()
    {
        $provider = Provider::factory()->create();

        $time = AvailableTime::factory()->create([
            'provider_id' => $provider->id,
            'start_time' => Carbon::tomorrow()->setHour(8),
            'end_time' => Carbon::tomorrow()->setHour(9),
        ]);

        $wrongDay = Carbon::now()->toDateString();

        $result = $this->query->execute($provider->id, $wrongDay);

        $this->assertNull($result);
    }

    public function test_get_available_times_with_wrong_provider()
    {
        $providerOne = Provider::factory()->create();
        $providerTwo = Provider::factory()->create();

        $time = AvailableTime::factory()->create([
            'provider_id' => $providerTwo,
            'start_time' => Carbon::tomorrow()->setHour(8),
            'end_time' => Carbon::tomorrow()->setHour(9),
        ]);

        $availibilityDay = Carbon::tomorrow()->toDateString();

        $result = $this->query->execute($providerOne->id, $availibilityDay);

        $this->assertNull($result);
    }
}
