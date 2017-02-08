<?php

namespace Prism\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PrismUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
