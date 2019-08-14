<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\CommentRepository;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Comment;
use App\Form\AdminCommentType;

class AdminCommentController extends AbstractController
{

    /**
     * Undocumented function
     *
     * @return Response
     */
    public function index(CommentRepository $repo)
    {
        return $this->render('admin/comment/index.html.twig', [
            'comments' => $repo->findAll()
        ]);
    }

    public function edit(Comment $comment, ObjectManager $manager, Request $request)
    {
        $form = $this->createForm(AdminCommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($comment);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le commentaire a bien été modifié"
            );
        }

        return $this->render('admin/comment/edit.html.twig',
        [
            'form' => $form->createView(),
            'comment' => $comment
        ]);
    }

    public function delete(Comment $comment, ObjectManager $manager){

        $manager->remove($comment);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le commentaire de <strong>{$comment->getAuthor()->getFirstName()} {$comment->getAuthor()->getLastName()} </strong> a bien été suprimé"
        );

        return $this->redirectToRoute('admin_comments_index');
    }
}
