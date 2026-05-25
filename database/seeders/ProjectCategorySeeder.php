<?php

namespace Database\Seeders;

use App\Models\ProjectCategory;
use Illuminate\Database\Seeder;

class ProjectCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Web Applications',
                'slug' => 'web-app',
                'icon' => '💻',
                'color' => '#3B82F6',
                'description' => 'Full-stack web applications, websites, and tools',
            ],
            [
                'name' => 'Machine Learning',
                'slug' => 'ml',
                'icon' => '🤖',
                'color' => '#8B5CF6',
                'description' => 'ML models, neural networks, and AI projects',
            ],
            [
                'name' => 'Cybersecurity',
                'slug' => 'cybersecurity',
                'icon' => '🔒',
                'color' => '#EF4444',
                'description' => 'Security research, penetration testing, and security tools',
            ],
            [
                'name' => 'Design / Branding',
                'slug' => 'design',
                'icon' => '🎨',
                'color' => '#EC4899',
                'description' => 'UI/UX design, branding, and visual design projects',
            ],
            [
                'name' => 'Data Analysis',
                'slug' => 'data-analysis',
                'icon' => '📊',
                'color' => '#06B6D4',
                'description' => 'Data visualization, analytics, and insights',
            ],
            [
                'name' => 'APIs / Backend',
                'slug' => 'api',
                'icon' => '⚙️',
                'color' => '#F97316',
                'description' => 'Backend systems, microservices, and API development',
            ],
        ];

        foreach ($categories as $category) {
            ProjectCategory::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
