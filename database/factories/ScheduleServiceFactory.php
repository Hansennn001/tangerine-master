<?php

namespace Database\Factories;

use App\Models\ScheduleService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ScheduleService>
 */
class ScheduleServiceFactory extends Factory
{
    protected $model = ScheduleService::class;

    public function definition(): array
    {
        static $sessions = ['morning', 'afternoon', 'evening'];
        static $index = 0;

        return [
            'session' => $sessions[$index++ % count($sessions)], // Mengulang morning, afternoon, evening
        ];
    }
}
