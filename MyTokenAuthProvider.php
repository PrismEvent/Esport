<?php
namespace Prism\EsportBundle\Param;

use Devhelp\Piwik\Api\Param\Param;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class MyTokenAuthProvider implements Param
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function value()
    {
        $token = $this->tokenStorage->getToken();

        return $token instanceof TokenInterface ? $token->getUser()->getPiwikToken() : null;
    }
}
?>