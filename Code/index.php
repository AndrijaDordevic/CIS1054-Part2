<?php
    require_once __DIR__ . '/bootstrap.php';

    $menuitems=[

        [
            'id'            => 1,
            'image'         => 'assets/images/chickensandwich.jpg',
            'name'          => 'Chicken Sandwich',
            'ingredients'   => 'Chicken, Cheese, Tomato, Lettuce'
        ],
        [
            'id'            => 2,
            'image'         => 'assets/images/hamandcheese.jpg',
            'name'          => 'Ham and Cheese Sandwich',
            'ingredients'   => 'Ham, Cheese, Lettuce.'
        ],
        [
            'id'            => 3,
            'image'         => 'assets/images/veggiesandwich.jpg',
            'name'          => 'Veggie Sandwich',
            'ingredients'   => 'Green pepper, Mushrooms, Potato, Tomato'
        ],
        [
            'id'            => 4,
            'image'         => 'assets/images/appliepie.jpg',
            'name'          => 'Apple Pie',
            'ingredients'   => ''
        ],
        [
            'id'            => 5,
            'image'         => 'assets/images/doughnut.jpg',
            'name'          => 'Doughnut With Strawberry Filling',
            'ingredients'   => ''
        ],
        [
            'id'            => 6,
            'image'         => 'assets/images/carrotcake.jpg',
            'name'          => 'Slice Of Carrot Cake',
            'ingredients'   => ''
        ],
        [
            'id'            => 7,
            'image'         => 'assets/images/burgerbuns.jpg',
            'name'          => 'Burger Buns',
            'ingredients'   => ''
        ],
        [
            'id'            => 8,
            'image'         => 'assets/images/baguette.jpg',
            'name'          => 'Baugette',
            'ingredients'   => ''
        ],
        [
            'id'            => 9,
            'image'         => 'assets/images/hotdogbuns.jpg',
            'name'          => 'Hotdog Buns',
            'ingredients'   => ''
        ],
        [
            'id'            => 10,
            'image'         => 'assets/images/pizzadough.jpg',
            'name'          => 'Pizza Dough',
            'ingredients'   => 'Flour, Yeast, Water, Olive Oil',
            'Note'          => 'The price is shown is calculated per KG'
        ],
        [
            'id'            => 11,
            'image'         => 'assets/images/breaddough.jpg',
            'name'          => 'Bread Dough',
            'ingredients'   => 'Flour, Yeast, Water',
            'Note'          => 'The price is shown is calculated per KG'
        ],
        [
            'id'            => 12,
            'image'         => 'assets/images/pastrydough.jpg',
            'name'          => 'Pastry Dough',
            'ingredients'   => 'Flour, Yeast, Shugar, Milk, Egg, Water, Butter',
            'Note'          => 'The price is shown is calculated per KG'
        ]
        
    ];

echo $twig-> render('index.html',['menuitems' => $menuitems]);
