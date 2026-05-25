<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Page;
use App\Models\Skill;
use App\Models\Technology;
use App\Models\Education;
use App\Models\ContactInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed project categories first
        $this->call(ProjectCategorySeeder::class);

        // Create admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@portfolio.test',
            'password' => Hash::make('password'),
        ]);

        // Seed default page content
        Page::create(['key' => 'home.title', 'value' => 'Hi, I\'m Stanley']);
        Page::create(['key' => 'home.subtitle', 'value' => 'AI-Powered Developer']);
        Page::create(['key' => 'home.description', 'value' => 'Discover my projects and profile in a refined warm royal interface. This is designed with clear cards, strong borders, and visible actions.']);

        Page::create(['key' => 'about.title', 'value' => 'About Me']);
        Page::create(['key' => 'about.intro', 'value' => 'I am a Computer Science graduate from Karatina University with strong interest in backend development, cybersecurity, automation and AI-driven systems.']);
        Page::create(['key' => 'about.bio', 'value' => 'My name is Stanley Mwangi. I focus on building reliable backend systems, automation workflows, and security-focused applications.']);
        Page::create(['key' => 'about.bio2', 'value' => 'I work with technologies such as Laravel, Linux systems, networking tools, and AI integrations to create efficient and scalable solutions.']);
        Page::create(['key' => 'about.bio3', 'value' => 'This portfolio includes projects demonstrating my experience in web development, system administration, and cybersecurity tools.']);

        Page::create(['key' => 'projects.description', 'value' => 'A selection of projects demonstrating my experience with backend development, automation, security tools, and modern web technologies.']);

        // Seed skills
        Skill::create(['name' => 'Laravel', 'level' => 90, 'category' => 'Backend Development']);
        Skill::create(['name' => 'PHP', 'level' => 85, 'category' => 'Backend Development']);
        Skill::create(['name' => 'JavaScript', 'level' => 80, 'category' => 'Frontend Development']);
        Skill::create(['name' => 'Python', 'level' => 75, 'category' => 'Programming']);
        Skill::create(['name' => 'Linux', 'level' => 85, 'category' => 'System Administration']);
        Skill::create(['name' => 'Network Security', 'level' => 80, 'category' => 'Cybersecurity']);

        // Seed technologies
        Technology::create(['name' => 'Laravel', 'category' => 'Backend', 'icon_class' => 'fab fa-laravel']);
        Technology::create(['name' => 'PHP', 'category' => 'Backend', 'icon_class' => 'fab fa-php']);
        Technology::create(['name' => 'JavaScript', 'category' => 'Frontend', 'icon_class' => 'fab fa-js']);
        Technology::create(['name' => 'Python', 'category' => 'Programming', 'icon_class' => 'fab fa-python']);
        Technology::create(['name' => 'Linux', 'category' => 'System', 'icon_class' => 'fab fa-linux']);
        Technology::create(['name' => 'Docker', 'category' => 'DevOps', 'icon_class' => 'fab fa-docker']);
        Technology::create(['name' => 'Git', 'category' => 'Version Control', 'icon_class' => 'fab fa-git']);
        Technology::create(['name' => 'MySQL', 'category' => 'Database', 'icon_class' => 'fas fa-database']);

        // Seed education
        Education::create([
            'institution' => 'Karatina University',
            'degree' => 'Bachelor of Science in Computer Science',
            'year_from' => 2020,
            'year_to' => 2024,
            'description' => 'Focused on software engineering, cybersecurity, and system administration.'
        ]);

        // Seed contact information
        ContactInfo::create(['key' => 'contact.intro', 'value' => 'If you would like to collaborate, discuss a project, or ask any questions, feel free to reach out using the form below.']);
        ContactInfo::create(['key' => 'contact.email', 'value' => 'stanomwangi2020@gmail.com']);
        ContactInfo::create(['key' => 'contact.phone', 'value' => '0768181843']);
        ContactInfo::create(['key' => 'contact.location', 'value' => 'Nairobi, Kenya']);
        ContactInfo::create(['key' => 'contact.get_in_touch', 'value' => 'Get in Touch']);
        ContactInfo::create(['key' => 'contact.connect_online', 'value' => 'Connect Online']);
        ContactInfo::create(['key' => 'contact.github_url', 'value' => '#']);
        ContactInfo::create(['key' => 'contact.linkedin_url', 'value' => '#']);
        ContactInfo::create(['key' => 'contact.twitter_url', 'value' => '#']);
    }
}
