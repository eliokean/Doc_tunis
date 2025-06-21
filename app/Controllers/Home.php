<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('/templates/accueil');
    }

    public function galerie(): string
    {
        return view('/templates/galerie');
    }

    public function Apropos(): string
    {
        return view('/templates/Apropos');
    }

    public function contact(): string
    {
        return view('/templates/contact');
    }
    
}
