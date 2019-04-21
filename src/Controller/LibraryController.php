<?php

namespace App\Controller;

use App\Entity\Book;
use http\Env\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\Paginator;
class LibraryController extends AbstractController
{
    /**
     * @Route("/", name="library")
     */
    public function index(\Symfony\Component\HttpFoundation\Request $request,PaginatorInterface $paginator)
    {
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Book::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('b')
            ->orderBy('b.id','DESC')
            ->getQuery();

        // Paginate the results of the query
        $pagination = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            5
        );
        dump($pagination);
        return $this->render('library/index.html.twig',
        ['pagination' => $pagination ]);
    }
}
