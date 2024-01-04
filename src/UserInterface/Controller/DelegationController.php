<?php

declare(strict_types=1);

namespace App\UserInterface\Controller;

use App\Domain\Delegation\DelegationFacade;
use App\Domain\Delegation\DTO\DelegationRequest;
use App\Domain\Delegation\Validator\ValidatorDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class DelegationController extends AbstractController
{
    #[Route('/delegation', name: 'create_delegation', methods: ['POST'])]
    public function create(
        Request $request,
        DelegationFacade $delegationFacade,
        ValidatorDTO $validator,
        SerializerInterface $serializer,
    ): JsonResponse {
        $dto    = $serializer->deserialize($request->getContent(), DelegationRequest::class, 'json');

        $errors = $validator->validate($dto);
        if (\count($errors) > 0) {
            return $this->json([
                'message' => 'bad request',
                'code'    => 400,
            ], 400);
        }
        $delegationFacade->createDelegation($dto);

        return $this->json([
            'message' => 'delegation created',
            'code'    => 200,
        ]);
    }

    #[Route('/delegations/{user}', name: 'get_delegations', methods: ['GET'])]
    public function getDelegationsByUser(DelegationFacade $delegationFacade, int $user): JsonResponse
    {
        return $this->json([$delegationFacade->getDelegationsByUser($user)]);
    }
}
