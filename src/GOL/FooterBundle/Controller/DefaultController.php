<?php

namespace GOL\FooterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GOLFooterBundle:Default:index.html.twig');
    }
}
