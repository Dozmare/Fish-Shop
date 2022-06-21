<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Form\PanierType;
use App\Repository\ProduitRepository;
use App\Repository\CategorieRepository;
use App\Repository\PanierRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\SousCategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(CategorieRepository $cat, ProduitRepository $prod): Response
    {
        $categList = $cat->findAll();
        $produitList = $prod->findAll();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'categorieList' => $categList,
            'produitList' => $produitList
        ]);
    }

    /**
     * @Route("/categorie/{categId}", name="categ_id")
     */
    public function getSousCategorieByCategorie(int $categId, SousCategorieRepository $sousCat, CategorieRepository $cat): Response
    {
        $sousCategorieList = $sousCat->findBy(['categorie' => $categId]);
        $categList = $cat->findAll();

        if($sousCategorieList ==[])
        {
            return $this->render('error/errorSousCategList.html.twig', [
                'categorieList' => $categList
            ]);
        }

        else{        return $this->render('home/sousCategorie.html.twig', [
            'sousCategorieList' => $sousCategorieList,
            'categorieList' => $categList
        ]);

        };

    }



    /**
     * @Route("/categ/{categId}/", name="produit_id")
     */
    public function getProduitBysousCategorie(int $categId, SousCategorieRepository $sousCat, CategorieRepository $cat, ProduitRepository $produit): Response
    {
        $sousCategorie = $sousCat->find($categId);
        $categList = $cat->findAll();

        $produitList = $produit->findBy(['sousCategorie' => $sousCategorie]);
        
        if($produitList ==[])
        {
            return $this->render('error/errorSousCategList.html.twig', [
                'categorieList' => $categList
            ]);
        }

        return $this->render('home/produitBySousCategorie.html.twig', [
            'produitList' => $produitList,
            'categorieList' => $categList
        ]);
    }

    /**
     * @Route("/produit/{produitName}", name="produit")
     */
    public function produitname(string $produitName,CategorieRepository $cat, ProduitRepository $produit, Request $request,  EntityManagerInterface $entityManager): Response
    {
        $categList = $cat->findAll();
        $prod= $produit ->findOneBy(['name'=>$produitName]);
        $panier = new Panier();
        $form = $this->createForm(PanierType::class, $panier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $panier->setIdUser($user);
            $panier->setIdProduit($prod);
            $panier->setEtat(false);
            $entityManager->persist($panier);
            $entityManager->flush();
            // do anything else you need here, like send an email
            return $this->redirectToRoute('panier');
        }
        return $this->render('home/produit.html.twig', [
            'form' => $form->createView(),
            'produit' => $prod,
            'categorieList' => $categList
        ]);
    }


    /**
     * @Route("/panier", name="panier")
     */
    public function Panier(CategorieRepository $cat, PanierRepository $pan): Response
    {
        $categList = $cat->findAll();
        $panierListComplet= $pan ->findAll();
        $user= $this->getUser();
        $panierList = [];

        foreach($panierListComplet as $panier){
            if($panier->getIdUser() == $user){
                $panierList[] = $panier;
            }
        }


        return $this->render('home/panier.html.twig', [
            'panierList' => $panierList,
            'categorieList' => $categList
        ]);

    }

        /**
     * @Route("/profil", name="profil")
     */
    public function profilAffich(CategorieRepository $cat): Response
    {
        $categList = $cat->findAll();


        return $this->render('home/profil.html.twig', [
            'controller_name' => 'HomeController',
            'categorieList' => $categList,

        ]);
    }

}
