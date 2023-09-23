<?php

namespace App\Controller;

use App\Manager\DeleteCommandeManager;
use Doctrine\Persistence\ManagerRegistry;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;

class DeleteCommandeController extends AbstractController
{
    private $serializer = null;

    private $manager = null;

    private $doctrine = null;


    public function __construct(
        SerializerInterface $serializer,
        DeleteCommandeManager $manager,
        ManagerRegistry $doctrine
    )
    {
        $this->serializer = $serializer;
        $this->manager = $manager;        
        $this->doctrine = $doctrine;        
    }

    #[Route('/commandes/delete', name: 'app_delete_commande', methods: ['GET'])]
    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        list($datas, $totalItem, $pageCount) = $this->manager->findByParam([], $page);
        $aDatas = [];
        foreach($datas as $data) {
            $context = SerializationContext::create()->setGroups(array('list'));
            $jsonData = $this->serializer->serialize($data, 'json', $context);
            $aDatas[] = json_decode($jsonData);
        }

        return $this->json([
            'datas' =>$aDatas,
            'pages' =>$page,
            'nb_page' =>$pageCount,
            'total' =>$totalItem
        ]);
    }

}