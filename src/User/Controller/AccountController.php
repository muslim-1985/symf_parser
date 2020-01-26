<?php

namespace App\User\Controller;

use App\Service\Contracts\SearchEngineInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    private SearchEngineInterface $elasticClient;

    public function __construct(SearchEngineInterface $elasticClient)
    {
        $this->elasticClient = $elasticClient;
    }

    /**
     * @Route("/account", name="app_account")
     */
    public function index()
    {
//        $indexArr = [
//            'index' => 'product',
//            'type' => 'product',
//            'id' => 4,
//            'body' => [
//                'title' => 'hello',
//            ]
//        ];
//        $this->elasticClient->index($indexArr);

        $params = [
            'index' => 'product',
            'type' => 'product',
            'id'    => 4,
        ];

        $r = $this->elasticClient->get($params);
        $cc=0;
        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
}
