<?php

namespace App\Controller;

use App\Entity\User;
use App\Manager\UserManager;
use Doctrine\Persistence\ManagerRegistry;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController
{

    private $serializer = null;

    private $manager = null;

    private $doctrine = null;


    public function __construct(
        SerializerInterface $serializer,
        UserManager $manager,
        ManagerRegistry $doctrine
    )
    {
        $this->serializer = $serializer;
        $this->manager = $manager;        
        $this->doctrine = $doctrine;        
    }
    #[Route('/user', name: 'app_user', methods: ['GET'])]
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
    #[Route('/userInfo', name: 'app_user_info', methods: ['GET'])]
    public function userInfo(): JsonResponse
    {
        $user = $this->getUser();
        if(!$user) {
          return new JsonResponse(['error' => 'permission not denied'], 404);
        } 
        $json= $this->serializer->serialize($user, 'json');
        return $this->json(
            json_decode($json)
        );
    }
    #[Route('/update/user', name: 'app_user_update_test', methods: ['PUT'])]
    public function updateUser(Request $request): JsonResponse
    {
        $em = $this->doctrine->getManager();
        $user= $this->getUser();
        if(!$user) {
        return new JsonResponse(['error' => 'client not found'], 404);

        }
        $decoded = json_decode($request->getContent());
        try {
            $user->setNom($decoded->nom);
            $user->setPrenom($decoded->prenom);
            $user->setPhone($decoded->phone);
            $user->setGrade($decoded->grade);
            $user->setAdress($decoded->adress);
            $user->setEchelon($decoded->echelon);
            $user->setIm($decoded->im);
            $em->persist($user);
            $user->setCin($decoded->cin);
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
    #[Route('/find/user/{id}', name: 'app_user_fin', methods: ['GET'])]
    public function findUser(Request $request): JsonResponse
    {
        $em = $this->doctrine->getManager();
        $user = $em->getRepository(User::class)->find($request->get('id'));
        if(!$user){
            return new JsonResponse(['error' => 'user not found'], 404);
        }
        $jsonUser = $this->serializer->serialize($user, 'json');
    
        return $this->json(json_decode($jsonUser));
    }

    #[Route('/delete/{id}', name: 'app_user_delete', methods: ['PUT'])]
    public function update(Request $request): Response
    {
        $em = $this->doctrine->getManager();
         $user = $em->getRepository(User::class)->find($request->get('id'));
         if(!$user) {
         return new JsonResponse(['error' => 'user not found'], 404);
 
         }
        $user = $this->serializer->deserialize($request->getContent(), User::class, 'json');
        try {
            $em->persist($user);
            $em->flush();
        } catch (\Exception $e) {
            return $this->json(
                ['error' => $e->getMessage()], 400
            );            
        }
        return $this->json([
            'success' => 'user update success!!!'
        ], 200);
    }
}