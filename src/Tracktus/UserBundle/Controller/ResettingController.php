<?php
namespace Tracktus\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Tracktus\UserBundle\Form\ResettingRequestForm;

class ResettingController extends Controller
{
    /**
     * Show resetting request page
     * @Route("/reset", name="resetting_request")
     */
    public function showResetRequestPage()
    {
        $form = $this->container->get('form.factory')
            ->create(new ResettingRequestForm());
        return $this->render('TracktusUserBundle:Resetting:resetting_request.html.twig', 
            array('form' => $form->createView()));
    }

    /**
     * Reset the password of an user
     * @Route("/reset/process", name="resetting_process")
     */
    public function processResetRequest(Request $request)
    {
        $form = $this->container->get('form.factory')
                    ->create(new ResettingRequestForm());
        if ($request->getMethod() == 'POST')
        {
            $form->bindRequest($request);
            if ($form->isValid())
            {
                $userManager = $this->container->get('fos_user.user_manager');
                $user = $userManager->findUserByEmail($form['email']->getData());
                $user->setPlainPassword(ResettingController::generatePassword());
                $password = $user->getPlainPassword();
                $userManager->updatePassword($user);
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($user);
                $em->flush();
                $message = \Swift_Message::newInstance()
                    ->setSubject('Nouveau password')
                    ->setFrom('pierre.goudjo@gmail.com')
                    ->setTo($form['email']->getData())
                    ->setBody($this->renderView('TracktusUserBundle:Resetting:resetting_email.txt.twig',
                        array('password' => $password)));
                try 
                {
                    $this->get('mailer')->send($message);
                    $this->render('TracktusUserBundle:Resetting:resetting_confirmation.html.twig',
                        array('email'=> $form['email']->getData()));
                }
                catch(\Swift_TransportException $e)
                {
                    return new Response($password);
                }
                
            }
            else
            {
                return $this->render('TracktusUserBundle:Resetting:resetting_request.html.twig',
                    array('form' => $form->createView()));
            }
        }
    }

    /**
     * Generate random password
     * @param  integer $length Length of the password
     * @return string
     * @see http://www.laughing-buddha.net/php/password
     * @copyright http://www.laughing-buddha.net/php/password
     */
    static function generatePassword ($length = 8)
    {
        $password = "";

        // define possible characters - any character in this string can be
        // picked for use in the password, so if you want to put vowels back in
        // or add special characters such as exclamation marks, this is where
        // you should do it
        $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";

        // we refer to the length of $possible a few times, so let's grab it now
        $maxlength = strlen($possible);

        // check for length overflow and truncate if necessary
        if ($length > $maxlength) {
            $length = $maxlength;
        }

        // set up a counter for how many characters are in the password so far
        $i = 0; 

        // add random characters to $password until $length is reached
        while ($i < $length) { 

            // pick a random character from the possible ones
            $char = substr($possible, mt_rand(0, $maxlength-1), 1);

            // have we already used this character in $password?
            if (!strstr($password, $char)) { 
            // no, so it's OK to add it onto the end of whatever we've already got...
            $password .= $char;
            // ... and increase the counter by one
            $i++;
            }

        }

        // done!
        return $password;

    }
}