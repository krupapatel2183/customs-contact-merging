<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\ContactCustomFieldValue;
use App\Models\CustomField;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ContactWithCustomFieldsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        // Create some custom fields if they don't exist
        $customFields = CustomField::count() ? CustomField::all() : collect();

        // if ($customFields->isEmpty()) {
            $types = ['text'];
            for ($i = 1; $i <= 50; $i++) {
                $field = CustomField::create([
                    'id' => (string) Str::uuid(),
                    'field_name' => "Custom Field $i",
                    'field_name_slug' => 'custom_field_' . $i,
                    'field_type' => $faker->randomElement($types),
                ]);
                $customFields->push($field);
            }
        // }

        // Create 20 contacts
        for ($i = 0; $i < 30; $i++) {
            $contact = Contact::create([
                'id' => (string) Str::uuid(),
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'phone' => '+1' . $faker->numerify('##########'),
                'gender' => $faker->randomElement(['Male', 'Female', 'Other']),
                'profile_image' => null,
                'additional_file' => null,
            ]);

            // Assign random custom field values
            foreach ($customFields->random(rand(2, 5)) as $customField) {
                ContactCustomFieldValue::create([
                    'id' => (string) Str::uuid(),
                    'contact_id' => $contact->id,
                    'custom_field_id' => $customField->id,
                    'value' => match($customField->field_type) {
                        'text' => $faker->word(),
                        'number' => $faker->randomNumber(),
                        'date' => $faker->date(),
                        default => $faker->word(),
                    },
                ]);
            }
        }
    }
}
