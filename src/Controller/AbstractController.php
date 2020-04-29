<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 15:38
 * PHP version 7
 */

namespace App\Controller;

use App\Model\MuseumManager;
use App\Model\RoomManager;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

/**
 *
 */
abstract class AbstractController
{
    /**
     * @var Environment
     */
    protected $twig;


    /**
     *  Initializes this class.
     */
    public function __construct()
    {

        $status = session_status();
        if ($status == PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION)) {
            $_SESSION['login_name'] = 'Benoit';
            $_SESSION['arts']=array();
            //var_dump($museumManager->getIdFromDpt(30));
            $museumManager=new MuseumManager();
            //var_dump($museumManager->getObject(543863));
            $roomManager = new RoomManager();
            $roomNumbers = $roomManager->getRoomNumbers();
            $getID = $museumManager->getIdFromDpt(count($roomNumbers));

            $countID=count($getID);

            for ($i=0; $i<$countID; $i++) {
                $roomNumber = $roomNumbers[$i];
                $artwork = $getID[$i];
                $_SESSION['arts'][$roomNumber]=$artwork;
            }
        }
        if (empty($_SESSION['goal'])) {
            $_SESSION['goal'] = array_rand($_SESSION['arts'], 1);
        }

        $loader = new FilesystemLoader(APP_VIEW_PATH);
        $this->twig = new Environment(
            $loader,
            [
                'cache' => !APP_DEV,
                'debug' => APP_DEV,
            ]
        );
        $this->twig->addExtension(new DebugExtension());
    }
}
