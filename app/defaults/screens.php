<?php

return [
    [
        "name" => "Screen 01",
        "filename" => "screen-01",
        "unit" => "pixel", // can be meter, ft or pixel (in this case density is not applied)
        "width" => "1920",
        "height" => "1200",
        "density" => null,
        "origin" => [
            "x" => "50",// From left to right (like Blender top view)
            "y" => "0", // From bottom to top (like Blender top view)
            "unit" => "percent" // can be pixels, percents, meters or feet
        ]
    ],
    [
        "name" => "Screen 02",
        "filename" => "screen-02",
        "unit" => "meter", // can be meter, ft or pixel (in this case density is not applied)
        "width" => 11.89,
        "height" => 8,
        "density" => 184.61,
        "origin" => [
            "x" => "2",// From left to right (like Blender top view)
            "y" => "2", // From bottom to top (like Blender top view)
            "unit" => "meter" // can be pixels, percents, meters or feet
        ],
        "projectors" => [
            "alignment" => "bottom",
            "list" => [
                [
                    "ip" => "192.168.2.101",
                    "name" => "01a",
                    "output" => "Server 2:1",
                    "width" => 1200,
                    "height" => 1920
                ],
                [
                    "ip" => "192.168.2.102",
                    "name" => "01b",
                    "output" => "Server 2:2",
                    "width" => 1200,
                    "height" => 1920
                ],
                [
                    "ip" => "192.168.2.103",
                    "name" => "01c",
                    "output" => "Server 2:3",
                    "width" => 1200,
                    "height" => 1920
                ]
            ]
        ]
    ]
];
