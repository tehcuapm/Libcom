<?php

namespace App\Http\Interfaces;

use App\Models\Article;

//on definit une sorte de contrat sur ce que devrait être un panier(sans pour autant implementer les methodes)
//=>permet d'avoir plusieurs gestion pour la persistence du panier(en cookie, dans la db,...)
interface PanierInterface
{

    public function getAll();

    public function getTotalPrice();

    public function getTotalQuantity();

    public function getQuantity(Article $article);

    public function mapToArticle();


    public function add(Article $article, $q);

    public function update(Article $article, $q);

    public function remove(int $id);

    public function clearUser();

    public function clearAll();

    public function updatePaniers(array $userPanier);

    public function getPaniers();

}
