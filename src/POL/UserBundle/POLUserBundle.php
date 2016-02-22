<?php

namespace POL\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class POLUserBundle extends Bundle
{
  public function getParent(){
    return 'FOSUserBundle';
  }
}
