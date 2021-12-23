<?php

namespace App\Controller;

use App\DTO\PassengerDTO;
use App\Entity\Passenger;
use App\Form\PassengerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PassengerController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/add-passenger', name: 'app.add-passenger')]
    public function registerAction(Request $request): Response
    {
        $passengerDTO = new PassengerDTO();

        $form = $this->createForm(PassengerType::class, $passengerDTO, [
            'action' => $this->generateUrl('app.add-passenger')
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $passenger = Passenger::createFromDTO($passengerDTO);
            $this->entityManager->persist($passenger);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_default_index');
        }

        return $this->renderForm('passenger/index.html.twig', [
            'form' => $form
        ]);
    }
}
