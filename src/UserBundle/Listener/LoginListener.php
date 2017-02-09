<?php
 
namespace UserBundle\Listener;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use UserBundle\Entity\User;

class LoginListener 
{
    
    protected $userManager;
    
    public function __construct(UserManagerInterface $userManager){
        $this->userManager = $userManager;
    }
    
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();
        $this->updateUser($user);
    }

    public function updateUser($user)
    {
        $user->setLoginCount((int) $user->getLoginCount() + 1);
        $this->userManager->updateUser($user);
    }
}