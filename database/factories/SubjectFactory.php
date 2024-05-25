<?php

namespace Database\Factories;

use Faker\Provider\Lorem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject_code' => $this->faker->regexify('[A-Z0-9]{10}'),
            'name' => array_rand([
                'FILIPINOY' => 'FILIPINOY',
                'ENGLISHER' => 'ENGLISHER',
                'MATH' => 'MATH',
                'COM. PROG' => 'COM. PROG',
                'DATA COM.' => 'DATA COM.'
            ]),
            'description' => array_rand([
                'history' => 'history',
                'number' => 'number'
            ]),
            'instructor' => $this->faker->name(),
            'schedule' => $this->faker->date('Y-m-d'),
            $prelim = 'prelims' => rand(1,4),
            $midterm = 'midterms' => rand(1,4),
            $pre_final = 'pre_finals' => rand(1,4),
            $final = 'finals' => rand(1,4),
            'average_grade' => rand(1,4),
            'remarks' => array_rand([
                'FAIL' => 'FAIL',
                'PASSED' => 'PASSED'
            ]),
            'date_taken'  => $this->faker->date('Y-m-d')
        ];
    }
}
