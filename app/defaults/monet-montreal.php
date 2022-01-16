<?php

return [
    [
        "name" => "Screen 01",
        "filename" => "screen-01",
        "unit" => "meter", // can be meter, ft or pixel (in this case density is not applied)
        "width" => 17.98,
        "height" => 7,
        "density" => 184.61,
        "origin" => [
            "x" => 50,// From left to right (like Blender top view)
            "y" => 0, // From bottom to top (like Blender top view)
            "unit" => "percent" // can be pixels, percents, meters or feet
        ],
        "projectors" => [
            "alignment" => "bottom",
            "list" => [
                [
                    "ip" => "192.168.2.124",
                    "name" => "01a",
                    "output" => "Server 1:1",
                    "width" => 1200,
                    "height" => 1920
                ],
                [
                    "ip" => "192.168.2.123",
                    "name" => "01b",
                    "output" => "Server 1:2",
                    "width" => 1200,
                    "height" => 1920
                ],
                [
                    "ip" => "192.168.2.122",
                    "name" => "01c",
                    "output" => "Server 1:3",
                    "width" => 1200,
                    "height" => 1920
                ],
            ]
        ]
    ],
    [
        "name" => "Screen 02",
        "filename" => "screen-02",
        "unit" => "meter", // can be meter, ft or pixel (in this case density is not applied)
        "width" => 11.58,
        "height" => 7,
        "density" => 184.61,
        "origin" => [
            "x" => 50,// From left to right (like Blender top view)
            "y" => 0, // From bottom to top (like Blender top view)
            "unit" => "percent" // can be pixels, percents, meters or feet
        ],
        "projectors" => [
            "alignment" => "bottom",
            "list" => [
                [
                    "ip" => "192.168.2.101",
                    "name" => "02a",
                    "output" => "Server 2:1",
                    "width" => 1200,
                    "height" => 1920
                ],
                [
                    "ip" => "192.168.2.123",
                    "name" => "02b",
                    "output" => "Server 2:2",
                    "width" => 1200,
                    "height" => 1920
                ]
            ]
        ]
    ],
    [
        "name" => "Screen 03",
        "filename" => "screen-03",
        "unit" => "meter", // can be meter, ft or pixel (in this case density is not applied)
        "width" => 4.57,
        "height" => 7,
        "density" => 184.61,
        "origin" => [
            "x" => 50,// From left to right (like Blender top view)
            "y" => 0, // From bottom to top (like Blender top view)
            "unit" => "percent" // can be pixels, percents, meters or feet
        ],
        "projectors" => [
            "alignment" => "bottom",
            "list" => [
                [
                    "ip" => "192.168.2.149",
                    "name" => "03",
                    "output" => "Server 2:3",
                    "width" => 1200,
                    "height" => 1920
                ]
        ]
    ]

    ],
    [
        "name" => "Screen 04",
        "filename" => "screen-04",
        "unit" => "meter", // can be meter, ft or pixel (in this case density is not applied)
        "width" => 17.37,
        "height" => 7,
        "density" => 184.61,
        "origin" => [
            "x" => 50,// From left to right (like Blender top view)
            "y" => 0, // From bottom to top (like Blender top view)
            "unit" => "percent" // can be pixels, percents, meters or feet
        ],
        "projectors" => [
            "alignment" => "bottom",
            "list" => [
                [
                    "ip" => "192.168.2.103",
                    "name" => "04a",
                    "output" => "Server 3:1",
                    "width" => 1200,
                    "height" => 1920
                ],
                [
                    "ip" => "192.168.2.104",
                    "name" => "04b",
                    "output" => "Server 3:2",
                    "width" => 1200,
                    "height" => 1920
                ],
                [
                    "ip" => "192.168.2.105",
                    "name" => "04c",
                    "output" => "Server 3:3",
                    "width" => 1200,
                    "height" => 1920
                ]
            ]
        ]
    ],
    [
        "name" => "Screen 05",
        "filename" => "screen-05",
        "unit" => "meter", // can be meter, ft or pixel (in this case density is not applied)
        "width" => 4.57,
        "height" => 7,
        "density" => 184.61,
        "origin" => [
            "x" => 50,// From left to right (like Blender top view)
            "y" => 0, // From bottom to top (like Blender top view)
            "unit" => "percent" // can be pixels, percents, meters or feet
        ],
        "projectors" => [
            "alignment" => "bottom",
            "list" => [
                [
                    "ip" => "192.168.2.116",
                    "name" => "05",
                    "output" => "Server 2:4",
                    "width" => 1200,
                    "height" => 1920
                ]
            ]
        ]
    ],
    [
        "name" => "Screen 06",
        "filename" => "screen-06",
        "unit" => "meter", // can be meter, ft or pixel (in this case density is not applied)
        "width" => 17.68,
        "height" => 7,
        "density" => 184.61,
        "origin" => [
            "x" => 50,// From left to right (like Blender top view)
            "y" => 0, // From bottom to top (like Blender top view)
            "unit" => "percent" // can be pixels, percents, meters or feet
        ],
        "projectors" => [
            "alignment" => "bottom",
            "list" => [
                [
                    "ip" => "192.168.2.107",
                    "name" => "06a",
                    "output" => "Server 3:4",
                    "width" => 1200,
                    "height" => 1920
                ],
                [
                    "ip" => "192.168.2.108",
                    "name" => "06b",
                    "output" => "Server 3:5",
                    "width" => 1200,
                    "height" => 1920
                ],
                [
                    "ip" => "192.168.2.109",
                    "name" => "06c",
                    "output" => "Server 3:6",
                    "width" => 1200,
                    "height" => 1920
                ]
            ]
        ]
    ],
    [
        "name" => "Screen 07",
        "filename" => "screen-07",
        "unit" => "meter", // can be meter, ft or pixel (in this case density is not applied)
        "width" => 17.98,
        "height" => 7,
        "density" => 184.61,
        "origin" => [
            "x" => 50,// From left to right (like Blender top view)
            "y" => 0, // From bottom to top (like Blender top view)
            "unit" => "percent" // can be pixels, percents, meters or feet
        ],
        "projectors" => [
            "alignment" => "bottom",
            "list" => [
                [
                    "ip" => "192.168.2.112",
                    "name" => "07a",
                    "output" => "Server 1:4",
                    "width" => 1200,
                    "height" => 1920
                ],
                [
                    "ip" => "192.168.2.111",
                    "name" => "07b",
                    "output" => "Server 1:5",
                    "width" => 1200,
                    "height" => 1920
                ],
                [
                    "ip" => "192.168.2.110",
                    "name" => "07c",
                    "output" => "Server 1:6",
                    "width" => 1200,
                    "height" => 1920
                ]
            ]
        ]
    ],
    [
        "name" => "Screen 08",
        "filename" => "screen-08",
        "unit" => "meter", // can be meter, ft or pixel (in this case density is not applied)
        "width" => 17.68,
        "height" => 7,
        "density" => 184.61,
        "origin" => [
            "x" => 50,// From left to right (like Blender top view)
            "y" => 0, // From bottom to top (like Blender top view)
            "unit" => "percent" // can be pixels, percents, meters or feet
        ],
        "projectors" => [
            "alignment" => "bottom",
            "list" => [
                [
                    "ip" => "192.168.2.113",
                    "name" => "08a",
                    "output" => "Server 4:1",
                    "width" => 1200,
                    "height" => 1920
                ],
                [
                    "ip" => "192.168.2.114",
                    "name" => "08b",
                    "output" => "Server 4:2",
                    "width" => 1200,
                    "height" => 1920
                ],
                [
                    "ip" => "192.168.2.115",
                    "name" => "08c",
                    "output" => "Server 4:3",
                    "width" => 1200,
                    "height" => 1920
                ]
            ]
        ]
    ],
    [
        "name" => "Screen 09",
        "filename" => "screen-09",
        "unit" => "meter", // can be meter, ft or pixel (in this case density is not applied)
        "width" => 4.57,
        "height" => 7,
        "density" => 184.61,
        "origin" => [
            "x" => 50,// From left to right (like Blender top view)
            "y" => 0, // From bottom to top (like Blender top view)
            "unit" => "percent" // can be pixels, percents, meters or feet
        ],
        "projectors" => [
            "alignment" => "bottom",
            "list" => [
                [
                    "ip" => "192.168.2.106",
                    "name" => "09",
                    "output" => "Server 2:5",
                    "width" => 1200,
                    "height" => 1920
                ]
            ]
        ]
    ],
    [
        "name" => "Screen 10",
        "filename" => "screen-10",
        "unit" => "meter", // can be meter, ft or pixel (in this case density is not applied)
        "width" => 11.28,
        "height" => 7,
        "density" => 184.61,
        "origin" => [
            "x" => 50,// From left to right (like Blender top view)
            "y" => 0, // From bottom to top (like Blender top view)
            "unit" => "percent" // can be pixels, percents, meters or feet
        ],
        "projectors" => [
            "alignment" => "bottom",
            "list" => [
                [
                    "ip" => "192.168.2.117",
                    "name" => "10a",
                    "output" => "Server 5:1",
                    "width" => 1200,
                    "height" => 1920
                ],
                [
                    "ip" => "192.168.2.118",
                    "name" => "10b",
                    "output" => "Server 5:2",
                    "width" => 1200,
                    "height" => 1920
                ]
            ]
        ]
    ],
    [
        "name" => "Screen 11",
        "filename" => "screen-11",
        "unit" => "meter", // can be meter, ft or pixel (in this case density is not applied)
        "width" => 4.57,
        "height" => 7,
        "density" => 184.61,
        "origin" => [
            "x" => 50,// From left to right (like Blender top view)
            "y" => 0, // From bottom to top (like Blender top view)
            "unit" => "percent" // can be pixels, percents, meters or feet
        ],
        "projectors" => [
            "alignment" => "bottom",
            "list" => [
                [
                    "ip" => "192.168.2.150",
                    "name" => "11",
                    "output" => "Server 2:6",
                    "width" => 1200,
                    "height" => 1920
                ]
            ]
        ]
    ],
    [
        "name" => "Screen 12",
        "filename" => "screen-12",
        "unit" => "meter", // can be meter, ft or pixel (in this case density is not applied)
        "width" => 17.68,
        "height" => 7,
        "density" => 184.61,
        "origin" => [
            "x" => 50,// From left to right (like Blender top view)
            "y" => 0, // From bottom to top (like Blender top view)
            "unit" => "percent" // can be pixels, percents, meters or feet
        ],
        "projectors" => [
            "alignment" => "bottom",
            "list" => [
                [
                    "ip" => "192.168.2.119",
                    "name" => "12a",
                    "output" => "Server 4:4",
                    "width" => 1200,
                    "height" => 1920
                ],
                [
                    "ip" => "192.168.2.120",
                    "name" => "12b",
                    "output" => "Server 4:5",
                    "width" => 1200,
                    "height" => 1920
                ],
                [
                    "ip" => "192.168.2.121",
                    "name" => "12c",
                    "output" => "Server 4:6",
                    "width" => 1200,
                    "height" => 1920
                ],
            ]
        ]
    ],
    [
        "name" => "Curvy 01",
        "filename" => "curvy-01",
        "unit" => "meter", // can be meter, ft or pixel (in this case density is not applied)
        "width" => 22.90,
        "height" => 3,
        "density" => 184.61,
        "origin" => [
            "x" => 0,// From left to right (like Blender top view)
            "y" => 0, // From bottom to top (like Blender top view)
            "unit" => "percent" // can be pixels, percents, meters or feet
        ],
        "projectors" => [
            "alignment" => "bottom",
            "list" => [
                [
                    "ip" => "192.168.2.127",
                    "name" => "C 01a",
                    "output" => "Server 9:1",
                    "width" => 1200,
                    "height" => 1920
                ],
                [
                    "ip" => "192.168.2.126",
                    "name" => "C 01b",
                    "output" => "Server 9:2",
                    "width" => 1200,
                    "height" => 1920
                ],
                [
                    "ip" => "192.168.2.125",
                    "name" => "C 01c",
                    "output" => "Server 9:3",
                    "width" => 1200,
                    "height" => 1920
                ]
            ]
        ]
    ],
    [
        "name" => "Curvy 02",
        "filename" => "curvy-02",
        "unit" => "meter", // can be meter, ft or pixel (in this case density is not applied)
        "width" => 22.90,
        "height" => 3,
        "density" => 184.61,
        "origin" => [
            "x" => 100,// From left to right (like Blender top view)
            "y" => 0, // From bottom to top (like Blender top view)
            "unit" => "percent" // can be pixels, percents, meters or feet
        ],
        "projectors" => [
            "alignment" => "bottom",
            "list" => [
                [
                    "ip" => "192.168.2.130",
                    "name" => "C 02a",
                    "output" => "Server 9:4",
                    "width" => 1200,
                    "height" => 1920
                ],
                [
                    "ip" => "192.168.2.129",
                    "name" => "C 02b",
                    "output" => "Server 9:5",
                    "width" => 1200,
                    "height" => 1920
                ],
                [
                    "ip" => "192.168.2.128",
                    "name" => "C 02c",
                    "output" => "Server 9:6",
                    "width" => 1200,
                    "height" => 1920
                ]
            ]
        ]
    ],
    [
        "name" => "Floor",
        "filename" => "floor",
        "unit" => "meter", // can be meter, ft or pixel (in this case density is not applied)
        "width" => 17.98,
        "height" => 55.77,
        "density" => 184.61,
        "origin" => [
            "x" => 50,// From left to right (like Blender top view)
            "y" => 50, // From bottom to top (like Blender top view)
            "unit" => "percent" // can be pixels, percents, meters or feet
        ]
    ]
];
