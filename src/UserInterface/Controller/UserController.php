<?php

declare(strict_types=1);

namespace App\UserInterface\Controller;

use App\UserFacade;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user', methods: ['POST']) ]
    public function createUser(UserFacade $userFacade): JsonResponse
    {
        $userFacade->createUser();

        return $this->json([
            'message' => 'user has been created !',
            'id'      => $userFacade->getLastUser()
                ->getId(),
        ]);
    }
}
