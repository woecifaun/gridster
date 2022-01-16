<?php

// Name entry was added for tmp UI allowing him/her to disable some layers
// The day settings will all be made in the UI and sortable, "name" may be removed

return [
    "background" => [
        "name" => "Background (black)",
        "color" => "black"
    ],
    "circles" => [
        "name" => "Circles (white, thin)",
        "thickness" => 0.5,
        "color" => "white"
    ],
    "diagonal" => [
        "name" => "Diagonals (white, thin)",
        "thickness" => 0.5,
        "color" => "white"
    ],
    "vertical lines" => [
        "name" => "Vertical Lines (every 1 m, thick, golden)",
        "unit" => "meter",
        "step" => 1,
        "color" => "gold",
        "thickness" => 2,
        "subdivision" => 5
    ],
     "horizontal lines" => [
        "name" => "Horizontal Lines (every 1 m, thick, golden)",
        "unit" => "meter",
        "step" => 1,
        "color" => "gold",
        "thickness" => 2,
        "subdivision" => 5
    ],
    "border" => [
        "name" => "Border (very thick, golden)",
        "thickness" => 4,
        "color" => "gold"
    ],
    "name" => [
        "name" => "Screen Name",
        "size" => 200,
        "color" => "magenta"
    ],
    "projectors" => [
        "name" => "Projectors Info",
        "ip" => [
            "color" => "red",
            "size" => 80
        ],
        "vp-name" => [
            "color" => "gold",
            "size" => 150
        ],
        "output" => [
            "color" => "red",
            "size" => "80"
        ]
    ]
];
