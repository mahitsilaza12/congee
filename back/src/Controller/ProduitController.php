<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Manager\ProduitManager;
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

class ProduitController extends AbstractController
{
    private $serializer = null;

    private $manager = null;

    private $doctrine = null;

    public function __construct(
        ManagerRegistry $doctrine,
        SerializerInterface $serializer,
        ProduitManager $manager
        )
    {
        $this->serializer = $serializer;
        $this->doctrine = $doctrine;
        $this->manager = $manager;
    }
    #[Route('/produit', name: 'app_produit', methods: ['GET'])]
    /**
     * Get produit list
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *     @OA\JsonContent(
     *         example={
     *             "page": "integer",
     *              "nb_page": "integer",
     *              "total": "integer",
     *              "datas": {
     *                  {"name": "string","prix": "text", "design":"string", "image":"string"}
     *              }
     *         }
     *     )
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Get produit list and search",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="produit")
     * @Security(name="Bearer")
     */
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
    #[Route('/produit', name: 'add_produit', methods: ['POST'])]
         /**
     * Create produit
     * @OA\Response(
     *     response=200,
     *     description="Ok",
     *     @OA\JsonContent(
     *         example={
     *              "status":"true",
     *              "message":"produit Create succefuly"
     *         }
     *     )
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *                  {"name": "string","prix": "text", "design":"string", "image":"string"}
     *              }
     *     )
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Create produit ",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="produit")
     * @Security(name="Bearer")
     */
    public function create(Request $request): Response
    {
        $em = $this->doctrine->getManager();
        $produit = $this->serializer->deserialize($request->getContent(), Produit::class, 'json');
        try {
            $em->persist($produit);
            $em->flush();
        } catch (\Exception $e) {
            return $this->json(
                ['error' => $e->getMessage()], 400
            );            
        }
        return $this->json([
            'success' => 'produit create success!!!'
        ], 200);
    }

    #[Route('/produit/{id}', name: 'update_produit', methods: ['PUT'])]
    /**
    * Update produit
    * @OA\Response(
    *     response=200,
    *     description="Ok",
    *     @OA\JsonContent(
    *         example={
    *              "status":"true",
    *              "message":"produit Update succefuly"
    *         }
    *     )
    * )
    * @OA\RequestBody(
    *     required=true,
    *     @OA\JsonContent(
    *         example={
    *                  {"name": "string","prix": "text", "design":"string", "image":"string"}
    *              }
    *     )
    * )
    * @OA\Parameter(
    *     name="Authorization",
    *     in="header",
    *     description="Update produit ",
    *     @OA\Schema(type="string")
    * )
    * @OA\Tag(name="produit")
    * @Security(name="Bearer")
    */
    public function update(Request $request): Response
    {
        $em = $this->doctrine->getManager();

        $Produit = $em->getRepository(Produit::class)->find($request->get('id'));
        if(!$Produit) {
          return new JsonResponse(['error' => 'Produit not found'], 404);
  
        }
        $produits = $this->serializer->deserialize($request->getContent(), Produit::class, 'json');
        try {
            $em->persist($produits);
            $em->flush();
        } catch (\Exception $e) {
            return $this->json(
                ['error' => $e->getMessage()], 400
            );            
        }
        return $this->json([
            'success' => 'produit update success!!!'
        ], 200);
    }

    #[Route('/produit/{id}', name: 'delete_produit', methods: ['DELETE'])]
    /**
   * delete produit
   * @OA\Response(
   *     response=200,
   *     description="Ok",
   *     @OA\JsonContent(
   *         example={
   *              "status":"true",
   *              "message":"produit delete succefuly"
   *         }
   *     )
   * )
   * @OA\Parameter(
   *     name="Authorization",
   *     in="header",
   *     description="Update produit ",
   *     @OA\Schema(type="string")
   * )
   * @OA\Tag(name="produit")
   * @Security(name="Bearer")
   */
    public function delete(Request $request): Response
    {
        $em = $this->doctrine->getManager();
        $produit = $em->getRepository(Produit::class)->find($request->get('id'));   
        if(!$produit) {
          return new JsonResponse(['error' => 'produit not found'], 404);
  
        }
        try {
            $em->remove($produit);
            $em->flush();
        } catch (\Exception $e) {
            return $this->json(
                ['error' => $e->getMessage()], 400
            );            
        }
        return $this->json([
            'success' => 'produit delete success!!!'
        ], 200);
    }

    #[Route('/produit/{id}', name: 'get_produit', methods: ['GET'])]
      /**
     * Get produit
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *     @OA\JsonContent(
     *         example={
     *             "page": "integer",
     *              "nb_page": "integer",
     *              "total": "integer",
     *              "datas": {
     *                  {"id": "integer", "username": "string","email": "string"}
     *              }
     *         }
     *     )
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Get produit",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="produit")
     * @Security(name="Bearer")
     */
    public function geProduit(Request $request)
    {
      $em = $this->doctrine->getManager();
      $produit = $em->getRepository(Produit::class)->find($request->get('id'));
      if(!$produit){
          return new JsonResponse(['error' => 'produit not found'], 404);
      }
      $jsonProduit = $this->serializer->serialize($produit, 'json');
  
      return $this->json(json_decode($jsonProduit));
    }
}