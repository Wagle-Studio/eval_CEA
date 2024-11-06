<?php

namespace App\Controller;

use App\Entity\Promotion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function homepage(EntityManagerInterface $entityManagerInterface): Response
    {
        $promotionRepository = $entityManagerInterface->getRepository(Promotion::class);
        $promotions = $promotionRepository->findAll();

        $ongoingPromotion = [];

        foreach ($promotions as $promotion) {
            if ($promotion->getStatus() === "ONGOING") {
                $ongoingPromotion[] = $promotion;
            }
        }

        // $ongoingPromotion = array_filter($promotions, function (Promotion $promotion) {
        //     return $promotion->getStatus() === "ONGOING";
        // });

        $ongoinPromotionCount = count($ongoingPromotion);

        return $this->render('home/index.html.twig', [
            "ongoinPromotionCount" => $ongoinPromotionCount,
        ]);
    }

    #[Route('/subscribe_newsletter', name: 'api_subscribe_newsletter', methods: ['POST'])]
    public function subscribeNewsletter(Request $request, EntityManagerInterface $entityManagerInterface): JsonResponse
    {
        $jsonContent = $request->getContent();

        // $data = json_decode($jsonContent, true);
        // $email = $data['email'] ?? null;

        // if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //     return new JsonResponse(['message' => 'Adresse email invalide.'], Response::HTTP_BAD_REQUEST);
        // }

        return new JsonResponse(['message' => 'Inscription réussie !'], Response::HTTP_OK);
    }
}
