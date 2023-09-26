<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Status>
 */
class StatusFactory extends Factory
{
    protected $model = Status::class;

    public function definition()
    {
        return [
            'label' => $this->faker->randomElement(['Done', 'In Progress', 'Not Started']),
            'code' => $this->generateCodeFromLabel($this->getAttribute('label')),
            // Add other attributes and their respective values if needed
        ];
    }

    private function generateCodeFromLabel($label)
    {
        // Map labels to corresponding codes
        $codeMapping = [
            'Done' => 'DONE',
            'In Progress' => 'INPR',
            'Not Started' => 'NOTS',
        ];

        return $codeMapping[$label] ?? null;
    }
}
