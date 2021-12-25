<?php

namespace App\Controller;

use App\DTO\TicketDTO;
use App\Entity\Ticket;
use App\Form\TicketType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/")
     */
    public function indexAction(Request $request): Response
    {
        $ticketDTO = new TicketDTO();

        $form = $this->createForm(TicketType::class, $ticketDTO, [
            'action' => $this->generateUrl('app_default_index')
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ticket = Ticket::createFromDTO($ticketDTO);
            $this->entityManager->persist($ticket);
            $this->entityManager->flush();

            return $this->redirectToRoute('/show-ticket');
        }

        return $this->renderForm('base.html.twig', [
            'form' => $form
        ]);
    }
}