<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    private static $invoiceNumber = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        self::$invoiceNumber++;

        return [
            'number' => sprintf("F/%s", self::$invoiceNumber),
            'taxIdBuyer' => fake()->numberBetween(1000000000, 9999999999),
            'taxIdSeller' => fake()->numberBetween(1000000000, 9999999999),
            'productName' => Str::upper(Str::random(3)),
            'priceNet' => fake()->randomNumber(5),
            'created' => fake()->date('Y-m-d', now())
        ];
    }
}
