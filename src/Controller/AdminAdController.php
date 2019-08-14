<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Persistence\ObjectManager;

class AdminAdController extends AbstractController
{
    public function index(AdRepository $repo)
    {
        return $this->render('admin/ad/index.html.twig', [
            'ads' => $repo->findAll()
        ]);
    }

    /**
     * Undocumented function
     *
     * @param Ad $ad
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function edit(Ad $ad, Request $request, ObjectManager $manager)
    {

        $form = $this->createForm(AdType::class, $ad);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /* Ajout des images */
            foreach ($ad->getImages() as $image){
                $image->setAd($ad);
            }

            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce <strong>{$ad->getTitle()} </strong> a bien été modifiée"
            );
        }

        return $this->render('admin/ad/edit.html.twig',
        [
            'form' => $form->createView(),
            'ad' => $ad
        ]);

    }

    public function delete(Ad $ad, ObjectManager $manager){
        if(count($ad->getBookings()) > 0){
            $this->addFlash(
                'warning',
                "Vous ne pouvez pas supprimer l'annonce <strong>{$ad->getTitle()} </strong> car elle posséde déjà des reservations"
            );
        }else{
            $manager->remove($ad);
            $manager->flush();
    
            $this->addFlash(
                'success',
                "L'annonce <strong>{$ad->getTitle()} </strong> a bien été suprimée"
            );
        }


        return $this->redirectToRoute('admin_ads_index');
    }
}
