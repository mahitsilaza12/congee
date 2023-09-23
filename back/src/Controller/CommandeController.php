<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\DeleteCommand;
use App\Entity\Produit;
use App\Manager\CommandeManager;
use Doctrine\Persistence\ManagerRegistry;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;

class CommandeController extends AbstractController
{

    private $serializer = null;

    private $manager = null;

    private $doctrine = null;


    public function __construct(
        SerializerInterface $serializer,
        CommandeManager $manager,
        ManagerRegistry $doctrine
    )
    {
        $this->serializer = $serializer;
        $this->manager = $manager;        
        $this->doctrine = $doctrine;        
    }

        
    #[Route('/commande/{id}', name: 'delete_commande', methods: ['DELETE'])]
    public function delete(Request $request): Response
    {
        $em = $this->doctrine->getManager();
        $commande = $em->getRepository(Commande::class)->find($request->get('id'));
        if(!$commande) {
          return new JsonResponse(['error' => 'commande not found'], 404);
  
        }
        try {
              // Ajouter une entrée dans la table DeleteCommand
            $deleteCommand = new DeleteCommand();
            $deleteCommand->setName($commande->getIdclient()->getName());
            $deleteCommand->setUser($this->getUser());
            $deleteCommand->setProduitName($commande->getIdProduit()->getName());
            $deleteCommand->setDateCommande($commande->getDateCommande());
            $deleteCommand->setPrice($commande->getIdProduit()->getPrix());
            $deleteCommand->setQuantite($commande->getQuantite());
            $em->persist($deleteCommand);
            $em->remove($commande);
            $em->flush();
            
        } catch (\Exception $e) {
            return $this->json(
                ['error' => $e->getMessage()], 400
            );            
        }
        return $this->json([
            'success' => 'command delete success!!!'
        ], 200);
    }

    #[Route('/commande', name: 'app_commande', methods: ['GET'])]
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

    #[Route('/commande', name: 'add_commande', methods: ['POST'])]
    public function create(Request $request)
    {
        $em = $this->doctrine->getManager();
        $commandes = json_decode($request->getContent());
    
        if (is_array($commandes)) {
            foreach($commandes as $commande) {
                $client = $em->getRepository(Client::class)->find($commande->idclient_id);
                if (!$client) {
                    return $this->json(['error' => 'client not found'], 400);
                }
                $produit = $em->getRepository(Produit::class)->find($commande->id_produit_id);
                if (!$produit) {
                    return $this->json(['error' => 'produit not found'], 400);
                }
                $comm = new Commande();
                $comm->setQuantite($commande->quantite);
                $comm->setIdclient($client);
                $comm->setIdProduit($produit);
                $comm->setDateCommande(new \DateTimeImmutable('now'));
                $em->persist($comm);
            }
        } else {
            $client = $em->getRepository(Client::class)->find($commandes->idclient_id);
            if (!$client) {
                return $this->json(['error' => 'client not found'], 400);
            }
            $produit = $em->getRepository(Produit::class)->find($commandes->id_produit_id);
            if (!$produit) {
                return $this->json(['error' => 'produit not found'], 400);
            }
            $comm = new Commande();
            $comm->setQuantite($commandes->quantite);
            $comm->setIdclient($client);
            $comm->setIdProduit($produit);
            $comm->setDateCommande(new \DateTimeImmutable('now'));
            $em->persist($comm);
        }
    
        try {
            $em->flush();
        } catch (\Exception $e) {
            return $this->json([
                'error' =>$e->getMessage()
            ]);
        }
    
        return $this->json([
            'success' => 'Commande success'
        ]);
    }

    #[Route('/commande/{id}', name: 'get_commande', methods: ['GET'])]
    /**
     * Get command 
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *     @OA\JsonContent(
     *         example={
     *             "page": "integer",
     *              "nb_page": "integer",
     *              "total": "integer",
     *              "datas": {
     *                  {"quantite": "integer", "date_commande": "date","client": "string","produit": "string"}
     *              }
     *         }
     *     )
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Get commande",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="Commande")
     * @Security(name="Bearer")
     */
    public function getCommande(Request $request): Response
    {
        $em = $this->doctrine->getManager();
        $commande = $em->getRepository(Commande::class)->find($request->get('id'));
        if(!$commande) {
          return new JsonResponse(['error' => 'commande not found'], 404);
  
        }
        $jsonClient = $this->serializer->serialize($commande, 'json');

        return $this->json(json_decode($jsonClient));
    }
}