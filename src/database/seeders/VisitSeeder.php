<?php

namespace Database\Seeders;

use App\Models\Visit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class VisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = ['Bishkek', 'Moscow', 'Almaty', 'Tbilisi', 'Unknown'];
        $browsers = ['Chrome', 'Firefox', 'Safari', 'Edge'];
        $platforms = ['Windows', 'macOS', 'Android', 'iOS'];

        for ($i = 0; $i < 40; $i++) {
            Visit::create([
                'visitor_hash' => sha1('visitor-' . random_int(1, 15) . '-' . now()->toDateString()),
                'ip' => '127.0.0.' . random_int(1, 255),
                'city' => $cities[array_rand($cities)],
                'country' => 'Test',
                'device' => random_int(0, 1) ? 'Desktop' : 'iPhone',
                'browser' => $browsers[array_rand($browsers)],
                'platform' => $platforms[array_rand($platforms)],
                'user_agent' => 'Seeder generated user agent',
                'page_url' => 'https://example.com/page-' . random_int(1, 5),
                'referer' => 'https://example.com',
                'visited_at' => Carbon::now()->subHours(random_int(0, 23)),
            ]);
        }
    }
}
