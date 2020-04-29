<?php


namespace App\Controller;

use App\Model\MuseumManager;
use App\Model\RoomManager;

class GameController extends AbstractController
{
    /**
     * Display home page
     *
     * @param null $roomNumber
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index($roomNumber = null)
    {
        $roomManager = new RoomManager();
        $museumManager = new MuseumManager();

        if (empty($roomNumber)) {
            $roomNumbers = $roomManager->getRoomNumbers();
            $roomNumber = $roomNumbers[rand(0, count($roomNumbers)-1)];
        }

        $messages[] = array();
        if ($_SESSION['goal'] === $roomNumber) {
            $_SESSION['objectTaken'] = true;
            $messages[] = 'You got the object, find exit to get out';
        }

        $accessibleRooms = $roomManager->getAccessibleRooms($roomNumber);

        $objectId = $_SESSION['arts'][$roomNumber];
        $objectData = $museumManager->getObject($objectId);

        return $this->twig->render('Game/index.html.twig', ['accessibleRooms' => $accessibleRooms,
                'roomNumber' => $roomNumber,'objectData' => $objectData, 'messages' => $messages]);
    }
}
