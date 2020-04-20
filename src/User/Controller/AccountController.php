<?php

namespace App\User\Controller;

use App\Service\Contracts\SearchEngineInterface;
use App\User\Repository\Contracts\UserRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class AccountController extends AbstractController
{
    private SearchEngineInterface $elasticClient;
    private UserRepositoryInterface $userService;
    private SerializerInterface $serializer;

    public function __construct(
        SearchEngineInterface $elasticClient,
        UserRepositoryInterface $userService,
        SerializerInterface $serializer
    )
    {
        $this->elasticClient = $elasticClient;
        $this->userService = $userService;
        $this->serializer = $serializer;
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

        $elasticResult = $this->elasticClient->get($params);
        $users = $this->userService->find(1);
        return $this->json($users, 200, [], ['groups' => 'group1']);
//          return $this->render('account/index.html.twig', [
//              'controller_name' => 'AccountController',
//          ]);
    }
}
