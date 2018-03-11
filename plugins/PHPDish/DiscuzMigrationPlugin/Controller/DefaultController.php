<?php

namespace PHPDish\DiscuzMigrationPlugin\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PHPDishDiscuzMigrationPlugin:Default:index.html.twig');
    }
}
