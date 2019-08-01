<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdController extends AbstractController
{

    /**
     * Undocumented function
     *
     * @param AdRepository $repo
     * @return void
     */
    public function index(AdRepository $repo)
    {
        $ads = $repo->findAll();

        return $this->render('ad/index.html.twig', [
           'ads'=> $ads
        ]);
    }

    /**
     * Undocumented function
     *
     * @param Ad $ad
     * @return void
     */
    public function show (Ad $ad)
    {
        return $this->render('ad/show.html.twig', [
            'ad' => $ad
        ]);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param ObjectManager $manager
     * @return void
     */
    public function create(Request $request, ObjectManager $manager)
    {
        $ad = new Ad;

        $form = $this->createForm(AdType::class, $ad);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            /* Ajout des images */
            foreach ($ad->getImages() as $image){
                $image->setAd($ad);
            }

            $ad->setAuthor($this->getUser());

            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce <strong>{$ad->getTitle()} </strong> a bien été enregistrée"
            );

            return $this->redirectToRoute('ads_show',[
                'slug' => $ad->getSlug()
            ]);
        }

        return $this->render('ad/new.html.twig',[
            'form' => $form->createView()
        ]);
    }

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

            return $this->redirectToRoute('ads_show',[
                'slug' => $ad->getSlug()
            ]);

        }

        return $this->render('ad/edit.html.twig',
        [
            'form' => $form->createView(),
            'ad' => $ad
        ]);
    }
}
