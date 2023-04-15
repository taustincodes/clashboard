<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
    /**
     * @Route("/demo")
     */
    public function index(): Response
    {
        $player = [
            "name" => "ClashRoyaleKing24",
            'expLevel' => 53,
            'trophies' => 3570,
            'bestTrophies' => 3700,
            'currentDeck' => [
                0 => [
                    "name" => "Electro Wizard",
                    "iconUrls" => [
                        "medium" => "https://api-assets.clashroyale.com/cards/300/RsFaHgB3w6vXsTjXdPr3x8l_GbV9TbOUCvIx07prbrQ.png"
                    ]
                ],
                1 => [
                    "name" => "P.E.K.K.A",
                    "iconUrls" => [
                        "medium" => "https://api-assets.clashroyale.com/cards/300/MlArURKhn_zWAZY-Xj1qIRKLVKquarG25BXDjUQajNs.png"
                    ]
                ],
                2 => [
                    "name" => "Zap",
                    "iconUrls" => [
                        "medium" => "https://api-assets.clashroyale.com/cards/300/7dxh2-yCBy1x44GrBaL29vjqnEEeJXHEAlsi5g6D1eY.png"
                    ]
                ],
                3 => [
                    "name" => "Poison",
                    "iconUrls" => [
                        "medium" => "https://api-assets.clashroyale.com/cards/300/98HDkG2189yOULcVG9jz2QbJKtfuhH21DIrIjkOjxI8.png"
                    ]
                ],
                4 => [
                    "name" => "Bandit",
                    "iconUrls" => [
                        "medium" => "https://api-assets.clashroyale.com/cards/300/QWDdXMKJNpv0go-HYaWQWP6p8uIOHjqn-zX7G0p3DyM.png"
                    ]
                ],
                5 => [
                    "name" => "Minions",
                    "iconUrls" => [
                        "medium" => "https://api-assets.clashroyale.com/cards/300/yHGpoEnmUWPGV_hBbhn-Kk-Bs838OjGzWzJJlQpQKQA.png"
                    ]
                ],
                6 => [
                    "name" => "Battle Ram",
                    "iconUrls" => [
                        "medium" => "https://api-assets.clashroyale.com/cards/300/dyc50V2cplKi4H7pq1B3I36pl_sEH5DQrNHboS_dbbM.png"
                    ]
                ],
                7 => [
                    "name" => "Royal Ghost",
                    "iconUrls" => [
                        "medium" => "https://api-assets.clashroyale.com/cards/300/3En2cz0ISQAaMTHY3hj3rTveFN2kJYq-H4VxvdJNvCM.png"
                    ]
                ]
            ]
        ];
        $mostLostCards = [
            0 => [
                "name" => "The Log",
                "value" => 21,
                "details" => [
                    "iconUrls" => [
                        "medium" => "https://api-assets.clashroyale.com/cards/300/_iDwuDLexHPFZ_x4_a0eP-rxCS6vwWgTs6DLauwwoaY.png"
                    ]
                ]
            ],
            1 => [
                "name" => "Arrows",
                "value" => 8,
                "details" =>  [
                    "iconUrls" =>  [
                        "medium" => "https://api-assets.clashroyale.com/cards/300/Flsoci-Y6y8ZFVi5uRFTmgkPnCmMyMVrU7YmmuPvSBo.png"
                    ]
                ]
            ],
            2 => [
                "name" => "Phoenix",
                "value" => 7,
                "details" => [
                    "iconUrls" => [
                        "medium" => "https://api-assets.clashroyale.com/cards/300/i0RoY1fs6ay7VAxyFEfZGIPnD002nAKcne9FtJsWBHM.png"
                    ]
                ]
            ]
        ];
        $accountProgress = [
            14 => 85,
            13 => 10,
            12 => 5
        ];
        $trophyProgressionGraph = [
            "x" => "0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20",
            "y" => "3700, 3670, 3645, 3675, 3640, 3610, 3580, 3611, 3575, 3550, 3520, 3500, 3525, 3556, 3530, 3502, 3526, 3550, 3570, 3595, 3570"
        ];
        $crownLog = "9, 4, 1";

        return $this->render('player.html.twig', [
            'page' => 'Player profile',
            'player' => $player,
            'mostLostCards' => $mostLostCards,
            'accountProgress' => $accountProgress,
            'graph' => $trophyProgressionGraph,
            'crownLog' =>   $crownLog
        ]);
    }
}
