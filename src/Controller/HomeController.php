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
        return $this->twig->render('Home/index.html.twig');
    }

    public function replay()
    {

        $message="Vous avez passé ".$_SESSION['roundCount']." heures dans le musée.";
        if ($_SESSION['roundCount']<10) {
            $message.=" Vous êtes un des plus rapide cambrioleur que nous ayons jamais vu.";
        } elseif ($_SESSION['roundCount']>20) {
            $message.=" Vous devez vraiment aimer l'art pour prendre autant de risques.";
        }

        return $this->twig->render('Home/replay.html.twig', ['message' => $message]);
    }

    public function restart()
    {
        $this->clearSession();
        header('location:/./home/index');
    }

    private function clearSession()
    {
        unset($_SESSION['arts']);
        unset($_SESSION['objectTaken']);
        unset($_SESSION['goal']);
        unset($_SESSION['exit']);
        unset($_SESSION['roundCount']);
        unset($_SESSION['start']);
        unset($_SESSION['120times']);
    }
}
