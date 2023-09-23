<?php

namespace App\Controller;

use App\Entity\Absence;
use App\Manager\AbsenceManager;
use Doctrine\Persistence\ManagerRegistry;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AbsenceController extends AbstractController
{
    private $serializer = null;

    private $manager = null;

    private $doctrine = null;


    public function __construct(
        SerializerInterface $serializer,
        AbsenceManager $manager,
        ManagerRegistry $doctrine
    )
    {
        $this->serializer = $serializer;
        $this->manager = $manager;   
        $this->doctrine = $doctrine;        
    }

    #[Route('/absence', name: 'app_absence_list', methods: ['GET'])]
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
            $userAbsence = $user->getAbsences();
            $datas = $userAbsence;
            $totalItem = count($userAbsence);
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

    #[Route('/absence', name: 'app_absence', methods: ['POST'])]
    public function demandeAbsence(Request $request): JsonResponse
    {
        $user = $this->getUser();
        $absence = new Absence();
        $em = $this->doctrine->getManager();
        $decoded = json_decode($request->getContent());
        try {
            $dateDebut = new \DateTime($decoded->dateDebut);
            $dateFin = new \DateTime($decoded->dateFin);
            $jourUpdate = $user->getJourRestant() - $decoded->nombreJ;
            $absence->setMotif($decoded->motif);
            $absence->setNombreJ($decoded->nombreJ);
            $user->setJourRestant($jourUpdate);
            $absence->setDateDebut($dateDebut);
            $absence->setDateFin($dateFin);
            $absence->setStatus1($decoded->status1);
            $absence->setUser($user);
            $em->persist($absence);
            $em->flush();
        } catch (\Exception $e) {
            return $this->json(
                ['error' => $e->getMessage()], 400
            );            
        }
        return $this->json([
            'success' => 'absence envoyer avec success!!!'
        ], 200);
    }

    #[Route('/absence/{id}', name: 'app_absence_get', methods: ['GET'])]
    public function getAbsence(Request $request): JsonResponse
    {
        $em = $this->doctrine->getManager();
        $user = $this->getUser();
        if(!$user){
            return new JsonResponse(['error' => 'user not found'], 404);
        }
        $absence = $em->getRepository(Absence::class)->find($request->get('id'));
        if(!$absence) {
            return new JsonResponse(['error' => 'absence not found'], 404);
    
          }
        $jsonabsence = $this->serializer->serialize($absence, 'json');
    
        return $this->json(json_decode($jsonabsence)); 
    }

    #[Route('/absence/{id}', name: 'app_absence_delete', methods: ['DELETE'])]
    public function deleteAbsence(Request $request): JsonResponse
    {
        $em = $this->doctrine->getManager();
        $user = $this->getUser();
        if(!$user){
            return new JsonResponse(['error' => 'user not found'], 404);
        }
        $absence = $em->getRepository(Absence::class)->find($request->get('id'));
        if(!$absence) {
          return new JsonResponse(['error' => 'absence not found'], 404);
  
        }
        try {
            $em->remove($absence);
            $em->flush();
        } catch (\Exception $e) {
            return $this->json(
                ['error' => $e->getMessage()], 400
            );            
        }
        return $this->json([
            'success' => 'absence delete success!!!'
        ], 200);
    }

    #[Route('/absence/annuler/{id}', name: 'app_absence_refuse', methods: ['GET'])]
    public function updateAbsence(Request $request): JsonResponse
    {
        $em = $this->doctrine->getManager();
        $user = $this->getUser();
        if(!$user){
            return new JsonResponse(['error' => 'user not found'], 404);
        }
        $absence = $em->getRepository(Absence::class)->find($request->get('id'));
        if(!$absence) {
          return new JsonResponse(['error' => 'absence not found'], 404);
  
        }
        try {
            $absence->setStatus1(0);
            $em->flush();
        } catch (\Exception $e) {
            return $this->json(
                ['error' => $e->getMessage()], 400
            );            
        }
        return $this->json([
            'success' => 'absence annulee avec success!!!'
        ], 200);
    }

    #[Route('/absence/confirm/{id}', name: 'app_absence_confirm', methods: ['GET'])]
    public function confirmCongeeAdmin(Request $request): JsonResponse
    {
        $em = $this->doctrine->getManager();
        $user = $this->getUser();
        if(!$user){
            return new JsonResponse(['error' => 'user not found'], 404);
        }
        $absence = $em->getRepository(Absence::class)->find($request->get('id'));
        if(!$absence) {
          return new JsonResponse(['error' => 'absence not found'], 404);
  
        }
        try {
            $absence->setStatus2(1);
            $em->flush();
        } catch (\Exception $e) {
            return $this->json(
                ['error' => $e->getMessage()], 400
            );            
        }
        return $this->json([
            'success' => 'absence acceptee avec success!!!'
        ], 200);
    }
}