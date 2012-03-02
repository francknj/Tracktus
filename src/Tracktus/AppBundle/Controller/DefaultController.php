<?php
namespace Tracktus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
/**
* Default controller of the AppBundle
*/
class DefaultController extends Controller
{
    /**
     * Action that show homepage
     * @param  Request $request
     * @return Response
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        if ($this->get('security.context')->isGranted('ROLE_USER'))
        {
            return $this->render('TracktusAppBundle::layout.html.twig');
        }
        return $response = $this->redirect($this->generateUrl('fos_user_security_login'));
    }
}