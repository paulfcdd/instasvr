<?php
/**
 * Created by PhpStorm.
 * User: rbajno-op
 * Date: 21-10-2015
 * Time: 10:49
 */

namespace Instasaver\IndexEnBundle\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('::index.html.twig', array(
            'sign_in'                       => 'Sign in',
            'sign_up'                       => 'Sign up',
            'join'                          => 'Join',
            'sign_up_modal_h4_text'               => 'Sign up to us',
            'sign_up_modal_sub_text'        => 'It will takes several seconds:)',
            'sign_up_modal_email_label'     => 'Your e-mail',
            'sign_up_modal_username_label'  => 'Your username',
            'sign_up_modal_password_label'  => 'Your password',
            'sign_up_modal_ok_button'       => 'Sign up',
            'sign_up_modal_close_button'    => 'Close',
            'content_logo'                  => 'Instasaver',
            'content_input_placeholder'     => 'Insert URL here',
            'content_get_button'            => 'Get',
            'footer_about_us'               => 'About us',
            'footer_faq'                    => 'FAQ',
            'footer_blog'                   => 'Blog',
            'footer_donation'               => 'Donation'
        ));
    }
}