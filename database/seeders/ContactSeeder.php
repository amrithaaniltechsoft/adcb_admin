<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        Contact::query()->truncate();

        $contacts = [
            [
                'slug' => 'kochi',
                'branch' => 'Kochi',
                'address' => '1st Floor, SKM TOWER, Aysha Rd, Anjumuri, Chalakkavattom, Vyttila, Kochi, Ernakulam, Kerala 682019',
                'phone' => '+91 6282700600',
                'email' => 'adcbedtech@gmail.com',
                'working_hours' => 'Mon - Sat: 9:30 AM - 6:30 PM',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.688195860361!2d76.28189871479361!3d9.972322392870026!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b080d3886f6a735%3A0xe54e6fa189c4ad3!2sMG%20Road%2C%20Kochi%2C%20Kerala!5e0!3m2!1sen!2sin!4v1658428800000!5m2!1sen!2sin',
            ],
            [
                'slug' => 'calicut',
                'branch' => 'Calicut',
                'address' => '3rd Floor, PK Tower, Rarichan Road, Near Pittapillil Agencies, Eranhipalam, Kozhikode - 673006',
                'phone' => '+91 6282700600',
                'email' => 'adcbedtech@gmail.com',
                'working_hours' => 'Mon - Sat: 9:30 AM - 6:30 PM',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3912.853044146197!2d75.78720191479934!3d11.258753091995166!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba6593bf1bb470f%3A0x6e9f16e451b6ad7f!2sMavoor%20Rd%2C%20Kozhikode%2C%20Kerala!5e0!3m2!1sen!2sin!4v1658428800000!5m2!1sen!2sin',
            ],
        ];

        foreach ($contacts as $contact) {
            Contact::create($contact);
        }
    }
}
