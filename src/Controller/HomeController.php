<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\MuseumManager;

class HomeController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $museumManager=new MuseumManager();
        var_dump($museumManager->getObject(543863));
        $getID = $museumManager->getIdFromDpt(30);
        foreach ($getID as $id) {
            $_SESSION['arts'][] = $id;
        }
        var_dump($_SESSION['arts']);

        return $this->twig->render('Home/index.html.twig');
    }
}
