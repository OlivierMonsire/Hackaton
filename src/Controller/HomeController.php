<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\MuseumManager;
use App\Model\RoomManager;

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
        //$museumManager=new MuseumManager();
        //var_dump($museumManager->getObject(543863));
        //var_dump($museumManager->getIdFromDpt(30));

        //$roomManager=new RoomManager();
        //var_dump($roomManager->getRoomNumbers());
        //var_dump($roomManager->getAccessibleRooms(104));exit();
        return $this->twig->render('Home/index.html.twig');
    }
}
