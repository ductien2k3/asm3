<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(LessonSeeder::class);
        $this->call(ReviewSeeder::class);
        $this->call(ClassModelSeeder::class);
        $this->call(PromotionSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(CartSeeder::class);
        $this->call(UserCourseSeeder::class);
        $this->call(CoursePromotionSeeder::class);
        $this->call(UserClassSeeder::class);
    }
}
