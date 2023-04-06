<?php

declare(strict_types=1);

namespace App\Controller;

use App\DelegationFacade;
use App\DTO\DelegationRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class DelegationController extends AbstractController
{
    #[Route('/delegation', name: 'app_diet', methods: ['POST'])]
    public function create(
        Request $request,
        DelegationFacade $delegationFacade,
        ValidatorInterface $validator,
        SerializerInterface $serializer,
    ): JsonResponse {
        $dto = $serializer->deserialize($request->getContent(), DelegationRequest::class, 'json');
        $value = $delegationFacade->getDelegationsCostByUser($dto);
        $errors = $validator->validate($dto);
        if (\count($errors) > 0) {
            return $this->json([
                'message' => 'bad request',
                'code'    => 400,
            ], 400);
        }
        //        $delegationFacade->createDelegation($dto);



        return $this->json([
            'message' => 'delegation created',
            'code'    => 200,
        ]);
    }
}
