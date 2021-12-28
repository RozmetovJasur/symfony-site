<?php

namespace App\Event\Listener;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;

class JwtAuthenticationSuccessListener
{
    /**
     * @var int
     */
    private int $jwtTll;

    public function __construct(int $jwtTll)
    {
        $this->jwtTll = $jwtTll;
    }

    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }

        $data['expires_at'] = (new \DateTime(sprintf('+ %s seconds', $this->jwtTll)))->format('Y-m-d H:i:s');

        $u = new \stdClass();
        $u->email = $user->getUsername();
        $u->firstName = $user->getFirstName();
        $u->lastName = $user->getLastName();

        $data['user'] = $u;
        $event->setData($data);
    }
}
