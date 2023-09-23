<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Client;
use App\Manager\ClientManager;
use Doctrine\Persistence\ManagerRegistry;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends AbstractController
{
    private $serializer = null;

    private $manager = null;

    private $doctrine = null;


    public function __construct(
        SerializerInterface $serializer,
        ClientManager $manager,
        ManagerRegistry $doctrine
    )
    {
        $this->serializer = $serializer;
        $this->manager = $manager;        
        $this->doctrine = $doctrine;        
    }

    #[Route('/client', name: 'app_client', methods: ['GET'])]
    /**
     * Get client list
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
     *     description="Get client list and search",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="client")
     * @Security(name="Bearer")
     */
    public function index(Request $request): JsonResponse
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

    #[Route('/client', name: 'add_client', methods: ['POST'])]
     /**
     * Create Client
     * @OA\Response(
     *     response=200,
     *     description="Ok",
     *     @OA\JsonContent(
     *         example={
     *              "status":"true",
     *              "message":"Client Create succefuly"
     *         }
     *     )
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *                  {"name": "string","adress": "text", "numero":"integer"}
     *              }
     *     )
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Create client ",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="client")
     * @Security(name="Bearer")
     */
    public function create(Request $request): Response
    {
        $em = $this->doctrine->getManager();
        $client = $this->serializer->deserialize($request->getContent(), Client::class, 'json');
        try {
            $em->persist($client);
            $em->flush();
        } catch (\Exception $e) {
            return $this->json(
                ['error' => $e->getMessage()], 400
            );            
        }
        return $this->json([
            'success' => 'Client create success!!!'
        ], 200);
    }

    #[Route('/client/{id}', name: 'update_client', methods: ['PUT'])]
    /**
    * Update Client
    * @OA\Response(
    *     response=200,
    *     description="Ok",
    *     @OA\JsonContent(
    *         example={
    *              "status":"true",
    *              "message":"Client Update succefuly"
    *         }
    *     )
    * )
    * @OA\RequestBody(
    *     required=true,
    *     @OA\JsonContent(
    *         example={
    *                  {"name": "string","adress": "text", "numero":"integer"}
    *              }
    *     )
    * )
    * @OA\Parameter(
    *     name="Authorization",
    *     in="header",
    *     description="Update client ",
    *     @OA\Schema(type="string")
    * )
    * @OA\Tag(name="client")
    * @Security(name="Bearer")
    */
   public function update(Request $request): Response
   {
       $em = $this->doctrine->getManager();
    //    $user = $this->getUser();
    //    if (!$user) {
    //     return new JsonResponse(['error' => 'Permission denied'], 403);
    //     }
        $client = $em->getRepository(Client::class)->find($request->get('id'));
        if(!$client) {
        return new JsonResponse(['error' => 'client not found'], 404);

        }
       $client = $this->serializer->deserialize($request->getContent(), Client::class, 'json');
       try {
           $em->persist($client);
           $em->flush();
       } catch (\Exception $e) {
           return $this->json(
               ['error' => $e->getMessage()], 400
           );            
       }
       return $this->json([
           'success' => 'Client update success!!!'
       ], 200);
   }
   
   #[Route('/client/{id}', name: 'delete_client', methods: ['DELETE'])]
   /**
   * delete Client
   * @OA\Response(
   *     response=200,
   *     description="Ok",
   *     @OA\JsonContent(
   *         example={
   *              "status":"true",
   *              "message":"Client delete succefuly"
   *         }
   *     )
   * )
   * @OA\Parameter(
   *     name="Authorization",
   *     in="header",
   *     description="Update client ",
   *     @OA\Schema(type="string")
   * )
   * @OA\Tag(name="client")
   * @Security(name="Bearer")
   */
  public function delete(Request $request, int $id): Response
  {
      $em = $this->doctrine->getManager();
      $client = $em->getRepository(Client::class)->find($request->get('id'));
      if(!$client) {
        return new JsonResponse(['error' => 'Client not found'], 404);

      }
      try {
          $em->remove($client);
          $em->flush();
      } catch (\Exception $e) {
          return $this->json(
              ['error' => $e->getMessage()], 400
          );            
      }
      return $this->json([
          'success' => 'Client delete success!!!'
      ], 200);
  }

  #[Route('/client/{id}', name: 'get_client', methods: ['GET'])]
  /**
     * Get client
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
     *     description="Get client",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="client")
     * @Security(name="Bearer")
     */
  public function getClient(Request $request)
  {
    $em = $this->doctrine->getManager();
    $client = $em->getRepository(Client::class)->find($request->get('id'));
    if(!$client){
        return new JsonResponse(['error' => 'Client not found'], 404);
    }
    $jsonClient = $this->serializer->serialize($client, 'json');

    return $this->json(json_decode($jsonClient));
  }

}