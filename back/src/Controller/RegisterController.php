<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;

class RegisterController extends AbstractController
{
    private $serializer = null;

    private $doctrine = null;

    public function __construct(
                                SerializerInterface $serializer,
                                ManagerRegistry $doctrine)
    {

        $this->serializer = $serializer;
        $this->doctrine =$doctrine;
    }

    #[Route('/register', name: 'register', methods: ['POST'])]
     /**
     * Register 
     * @OA\Response(
     *     response=200,
     *     description="Ok",
     *     @OA\JsonContent(
     *         example={
     *              "status":"true",
     *              "message":" Register succefuly"
     *         }
     *     )
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *                  {"email": "xxx@xx.com","password": "text"}
     *              }
     *     )
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Register  ",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="connexion")
     * @Security(name="Bearer")
     */
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $em = $this->doctrine->getManager();
        $decoded = json_decode($request->getContent());
        $password = $decoded->password;
        $oUser = $this->serializer->deserialize($request->getContent(), User::class, 'json');
        $oUser->setUsername($oUser->getEmail());
        $oUser->setPassword($passwordHasher->hashPassword($oUser, $password));
        $oUser->setPhone($decoded->phone);
        $oUser->setNom($decoded->nom);
        $oUser->setJourTotal(4);
        $oUser->setJourRestant(4);
        $oUser->setRoles(['ROLE_USER']);
        $oUser->setCreatedAt(new \DateTimeImmutable('now'));
        $em->persist($oUser);
        $em->flush();

        return $this->json(['message' => 'Registered Successfully']);
    }

    #[Route('/add_personnel', name: 'add_personnel', methods: ['POST'])]
    public function addPersonnel(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $em = $this->doctrine->getManager();
        $decoded = json_decode($request->getContent());
        $password = $decoded->password;
        $oUser = $this->serializer->deserialize($request->getContent(), User::class, 'json');
        $oUser->setUsername($oUser->getEmail());
        $oUser->setPassword($passwordHasher->hashPassword($oUser, $password));
        $oUser->setPhone($decoded->phone);
        $oUser->setNom($decoded->nom);
        $oUser->setGrade($decoded->grade);
        $oUser->setAdress($decoded->adress);
        $oUser->setCin($decoded->cin);
        $oUser->setEchelon($decoded->echelon);
        $oUser->setPrenom($decoded->prenom);
        $oUser->setRoles(['ROLE_USER']);
        $oUser->setCreatedAt(new \DateTimeImmutable('now'));
        $em->persist($oUser);
        $em->flush();

        return $this->json(['message' => 'add Successfully']);
    }

    #[Route('/getpersonnel/{id}', name: 'gettpersonnel', methods: ['GET'])]
    public function getPersonnel(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $em = $this->doctrine->getManager();
        $user = $this->getUser();
        if(!$user){
            return new JsonResponse(['error' => 'user not found'], 404);
        }
        $user = $em->getRepository(User::class)->find($request->get('id'));
        if(!$user) {
            return new JsonResponse(['error' => 'user not found'], 404);
    
          }
        $jsonuser = $this->serializer->serialize($user, 'json');

        return $this->json(json_decode($jsonuser)); 
    }

    #[Route('/edit_personnel/{id}', name: 'editpersonnel', methods: ['PUT'])]
    public function editPersonnel(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $em = $this->doctrine->getManager();
        $user = $this->getUser();
        if(!$user){
            return new JsonResponse(['error' => 'user not found'], 404);
        }
        $oUser = $em->getRepository(User::class)->find($request->get('id'));
        if(!$oUser) {
          return new JsonResponse(['error' => 'user not found'], 404);
  
        }
        $em = $this->doctrine->getManager();
        $decoded = json_decode($request->getContent());
        $password = $decoded->password;
        $oUser->setEmail($decoded->email);
        $oUser->setUsername($decoded->email);
        $oUser->setPassword($passwordHasher->hashPassword($oUser, $password));
        $oUser->setPhone($decoded->phone);
        $oUser->setNom($decoded->nom);
        $oUser->setGrade($decoded->grade);
        $oUser->setAdress($decoded->adress);
        $oUser->setCin($decoded->cin);
        $oUser->setPrenom($decoded->prenom);
        $oUser->setEchelon($decoded->echelon);
        $oUser->setRoles(['ROLE_USER']);
        $oUser->setCreatedAt(new \DateTimeImmutable('now'));
        $em->persist($oUser);
        $em->flush();

        return $this->json(['message' => 'edit Successfully']);
    }
}