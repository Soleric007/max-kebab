<?php

$catalog = require __DIR__.'/maxkebab-catalog.php';

return [
    'brand' => [
        'name' => 'Max Kebab',
        'tagline' => 'Northampton\'s Premium Kebab Experience',
        'logo' => 'assets/images/maxkebab.png',
        'phone' => '+44 7708 449419',
        'phone_display' => '+44 7708 449419',
        'address' => '53 Harborough Rd, Kingsthorpe, Northampton NN2 7SH, United Kingdom',
        'short_address' => 'Kingsthorpe, Northampton',
        'map_url' => 'https://maps.app.goo.gl/8WGTkPchjdBUfpNg8',
        'description' => 'Premium kebab restaurant in Northampton serving authentic grilled favourites, wraps, burgers, sides, salads, dine-in meals, takeaway, and delivery.',
        'keywords' => 'Max Kebab, Northampton kebab, premium kebab restaurant, delivery Northampton, takeaway Northampton, dine-in kebab, fresh grilled food',
        'service_modes' => 'Dine-in, takeaway & delivery',
        'hours_note' => 'Latest opening times are shared on our socials and by phone.',
        'accent' => '#ff5a1f',
        'socials' => [
            ['label' => 'Facebook', 'icon' => 'flaticon-facebook', 'url' => 'https://www.facebook.com/people/Max-K%C3%A9bab/61581423252048/#'],
            ['label' => 'Instagram', 'icon' => 'flaticon-instagram-1', 'url' => 'https://www.instagram.com/max__kebab/'],
            ['label' => 'TikTok', 'text_icon' => 'TT', 'url' => 'https://www.tiktok.com/@max__kebab?_t=ZN-90wsMMdcUJ4&_r=1'],
        ],
        'highlights' => [
            'Premium street-food feel',
            'Fresh ingredients cooked to order',
            'Friendly dine-in, takeaway, and delivery service',
            'Clean preparation and quality-first flavour',
        ],
        'hours' => [
            ['day' => 'Opening updates', 'hours' => 'Latest service times are posted on Facebook, Instagram, and TikTok'],
            ['day' => 'Phone support', 'hours' => '+44 7708 449419'],
            ['day' => 'Delivery', 'hours' => 'Available during service hours'],
            ['day' => 'Collection', 'hours' => '53 Harborough Rd, Kingsthorpe, Northampton'],
        ],
    ],
    'hero_slides' => [
        [
            'headline' => 'Burgers, Wings & Box Meals',
            'subtext' => 'Grilled fresh with juicy fillings and bold flavour.',
            'price' => 'From £9.00',
            'compare_price' => 'Large £11.50',
            'image' => 'assets/images/header-3-carousel-2.png',
            'slug' => 'beef-burger',
        ],
        [
            'headline' => 'Northampton\'s Premium Kebabs',
            'subtext' => 'Fresh. Juicy. Authentic.',
            'price' => 'From £10.00',
            'compare_price' => 'Large £12.00',
            'image' => 'assets/images/shop/Chicken Kebab.png',
            'slug' => 'chicken-kebab',
        ],
        
        [
            'headline' => 'Meal Deals Done Properly',
            'subtext' => 'Big flavour, proper portions, easy ordering.',
            'price' => 'From £11.50',
            'compare_price' => 'Up to £14.50',
            'image' => 'assets/images/shop/Mixed Kebab Meal Deal.png',
            'slug' => 'mixed-kebab-meal-deal',
        ],
    ],
    'categories' => $catalog['categories'],
    'products' => $catalog['products'],
    'reviews' => [
        [
            'name' => 'Aisha Rahman',
            'designation' => 'Local diner',
            'image' => 'assets/images/reviews/client-1.jpg',
            'rating' => 5,
            'quote' => 'Fresh, authentic, and packed with flavour. The staff were genuinely friendly and the whole place felt clean and looked after.',
        ],
        [
            'name' => 'Daniel Moore',
            'designation' => 'Takeaway regular',
            'image' => 'assets/images/reviews/client-2.jpg',
            'rating' => 5,
            'quote' => 'The meat tasted properly grilled and the salad was crisp. It feels more premium than the usual late-night takeaway spots.',
        ],
        [
            'name' => 'Sophia Clarke',
            'designation' => 'Northampton foodie',
            'image' => 'assets/images/reviews/client-3.jpg',
            'rating' => 5,
            'quote' => 'Delicious food, clean presentation, and a friendly atmosphere. Max Kebab gets the balance right between street-food energy and quality.',
        ],
    ],
];
