<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Goutte\Client as GoutteClient;
use App\Service\PrimitivaCombinations;

class MainController extends AbstractController
{
    /**
     * @Route("/primitiva", name="primitiva")
     */
    public function index(): Response
    {

        $result = 'Combinacion GANADORA!';
        $posibleCombination =    [];

        do {
            $randomNumber = $this->generateRandomNumber(1, 49);
            if (!in_array($randomNumber, $posibleCombination)) {
                $posibleCombination[] = $randomNumber;
            }
        } while (count($posibleCombination) < 6 );


        foreach (PrimitivaCombinations::COMBINATIONS as $combination) {
            if ($posibleCombination === $combination) {
                $result = PrimitivaCombinations::MSG_EXIST;
            }
        }

        return $this->render('main/index.html.twig', [
            'posibleCombination' => $posibleCombination,
            'result' => $result
        ]);
    }

    private function generateRandomNumber(int $min, int $max)
    {

        return rand($min, $max);
    }
}
