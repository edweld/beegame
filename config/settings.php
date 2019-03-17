<?php
return [
    "copy" => [
	    "start"			=>"Type 'hit' to hit, type 'quit' to exit\n",
		"continue"		=>"Hit Me!...\n",
		"endquit"		=>"You quit the game\n",
		"end"			=>"All Bees are dead. It took %d hits to destroy the hive\n",
		"deadbee"		=>"You killed a %s bee\n",
		"errorinput"	=>"Type 'hit' to hit, type 'quit' to exit\n",
		"hitbee" 		=>"Direct Hit. You took %d points from a %s bee\n" 
		
	],
    "bees" => [
        "queen"	=>[
		    "total"	=> 1,
			"points"	=>100,
			"hit"		=>8
		],
        "worker" => [
		    "total"	=> 5,
			"points"	=>75,
			"hit"		=>10
		],
        "drone" => [
		    "total"	=> 8,
			"points"	=>50,
			"hit"		=>12
		],
    ]
];