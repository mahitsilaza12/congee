<?php

namespace App\Controller;

use App\Entity\Congee;
use App\Manager\CongeeManager;
use Doctrine\Persistence\ManagerRegistry;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CongeeController extends AbstractController
{
    private $serializer = null;

    private $manager = null;

    private $doctrine = null;


    public function __construct(
        SerializerInterface $serializer,
        CongeeManager $manager,
        ManagerRegistry $doctrine
    )
    {
        $this->serializer = $serializer;
        $this->manager = $manager;   
        $this->doctrine = $doctrine;        
    }
    #[Route('/congee', name: 'app_congee_list', methods: ['GET'])]
    public function index(Request $request): JsonResponse
    {
        $user = $this->getUser();
        $isAdmin = false;
        if ($user !== null) {
            $isAdmin = in_array('ROLE_ADMIN', $user->getRoles());
        }

        $page = $request->get('page', 1);
        if($isAdmin) {
            list($datas, $totalItem, $pageCount) = $this->manager->findByParam([], $page);

        }else{
            $userCongee = $user->getCongees();
            $datas = $userCongee;
            $totalItem = count($userCongee);
            $pageCount = 1; 

        }
        $aDatas = [];
        $count =0;
        foreach($datas as $data) {
            $context = SerializationContext::create()->setGroups(array('list'));
            $jsonData = $this->serializer->serialize($data, 'json', $context);
            $aDatas[] = json_decode($jsonData);
            if($data->getStatus1() == 1) {
                $count++;
            }
        }

        return $this->json([
            'datas' =>$aDatas,
            'count'=> $count,
            'pages' =>$page,
            'nb_page' =>$pageCount,
            'total' =>$totalItem
        ]);
    }
    #[Route('/congee', name: 'app_congee', methods: ['POST'])]
    public function demandeConngee(Request $request): JsonResponse
    {
        $user = $this->getUser();
        $congee = new Congee();
        $em = $this->doctrine->getManager();
        $decoded = json_decode($request->getContent());
        try {
            if($decoded->type == 'Congé de maternité')
                {
                    $congee->setNombreJ(90);
                }
            if($decoded->type == 'Congé de patérnité')
                {
                    $congee->setNombreJ(7);
                }
            if($decoded->type == 'Congé annuel')
                {
                    $congee->setNombreJ($decoded->nombreJ);
                }
            if($decoded->type == 'Congé de malade')
                {
                    $congee->setNombreJ($decoded->nombreJ);
                }
            $dateDebut = new \DateTime($decoded->dateDebut);
            $dateFin = new \DateTime($decoded->dateFin);
            $jourUpdate = $user->getJourRestant() -  $decoded->nombreJ;
            $user->setJourRestant($jourUpdate);
            $congee->setType($decoded->type);
            $congee->setDateDebut($dateDebut);
            $congee->setDateFin($dateFin);
            $congee->setStatus1($decoded->status1);
            $congee->setUserId($user);
            $em->persist($congee);
            $em->flush();
        } catch (\Exception $e) {
            return $this->json(
                ['error' => $e->getMessage()], 400
            );            
        }
        return $this->json([
            'success' => 'congee envoyer avec success!!!'
        ], 200);
    }
    #[Route('/congee/{id}', name: 'app_congee_get', methods: ['GET'])]
    public function getCongee(Request $request): JsonResponse
    {
        $em = $this->doctrine->getManager();
        $user = $this->getUser();
        if(!$user){
            return new JsonResponse(['error' => 'user not found'], 404);
        }
        $congee = $em->getRepository(Congee::class)->find($request->get('id'));
        if(!$congee) {
            return new JsonResponse(['error' => 'congee not found'], 404);
    
          }
        $jsonCongee = $this->serializer->serialize($congee, 'json');
    
        return $this->json(json_decode($jsonCongee)); 
    }

    #[Route('/congee/delete/{id}', name: 'app_congee_delete', methods: ['DELETE'])]
    public function deleteCongee(Request $request): JsonResponse
    {
        $em = $this->doctrine->getManager();
        $user = $this->getUser();
        if(!$user){
            return new JsonResponse(['error' => 'user not found'], 404);
        }
        $congee = $em->getRepository(Congee::class)->find($request->get('id'));
        if(!$congee) {
          return new JsonResponse(['error' => 'congee not found'], 404);
  
        }
        try {
            $em->remove($congee);
            $em->flush();
        } catch (\Exception $e) {
            return $this->json(
                ['error' => $e->getMessage()], 400
            );            
        }
        return $this->json([
            'success' => 'congee delete success!!!'
        ], 200);
    }
    #[Route('/congee/annuler/{id}', name: 'app_congee_refuse', methods: ['GET'])]
    public function updateCongee(Request $request): JsonResponse
    {
        $em = $this->doctrine->getManager();
        $user = $this->getUser();
        if(!$user){
            return new JsonResponse(['error' => 'user not found'], 404);
        }
        $congee = $em->getRepository(Congee::class)->find($request->get('id'));
        if(!$congee) {
          return new JsonResponse(['error' => 'congee not found'], 404);
  
        }
        try {
            $congee->setStatus1(0);
            $em->flush();
        } catch (\Exception $e) {
            return $this->json(
                ['error' => $e->getMessage()], 500
            );            
        }
        return $this->json([
            'success' => 'congee annulee avec success!!!'
        ], 200);
    }

    #[Route('/congee/confirme/{id}', name: 'app_congee_confirm', methods: ['GET'])]
    public function confirmCongeeAdmin(Request $request): JsonResponse
    {
        $em = $this->doctrine->getManager();
        $user = $this->getUser();
        if(!$user){
            return new JsonResponse(['error' => 'user not found'], 404);
        }
        $congee = $em->getRepository(Congee::class)->find($request->get('id'));
        if(!$congee) {
          return new JsonResponse(['error' => 'congee not found'], 404);
        }
        try {
            $congee->setStatus2(1);
            $em->flush();
        } catch (\Exception $e) {
            return $this->json(
                ['error' => $e->getMessage()], 400
            );            
        }
        return $this->json([
            'success' => 'congee acceptee avec success!!!'
        ], 200);
    }
}