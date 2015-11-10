<?php 

namespace Instasaver\IndexEnBundle\Controller;
use Instasaver\IndexEnBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

include_once ("simple_html_dom.php");

class IndexEnController extends Controller
{
    public function indexAction()
    {
		//$user = $this->get('security.token_storage')->getToken()->getUser();
		//$userId = $user->getId();
		
		
        return $this->render('::index.html.twig', array(
            'sign_in'                       => 'Sign in',
            'sign_up'                       => 'Sign up',
            'join'                          => 'Join',
            'sign_up_modal_h4_text'         => 'Sign up to us',
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
            'footer_donation'               => 'Donation',
			'invalid_email'					=> 'Please, enter valid email',
			'email_not_empty'				=> 'This field can not be empty',
			'username_notification'			=> 'Username must include minimum 4 chars',
			'pass_notification'				=> 'Password must contains minimum 4 chars',
			'email_busy'					=> 'Email already in use',
			'user_busy'						=> 'User with this username was registred',
			'save_button'					=> 'Save',
			'sign_in_modal_user_label' 		=> 'Enter Your username',
			'sign_in_modal_password_label'	=> 'Enter Your password'		
        ));
    }

    public function regAction() {
		$request = $this->container->get('request');
		$email = $request->get('email');     
		$username = $request->get('username');     
		$password = password_hash($request->get('password'), PASSWORD_DEFAULT); 
	   
	   //AJAX request from Index
	   
		$reg = new User();
		$reg->setEmail($email);
		$reg->setUsername($username);
		$reg->setPassword($password);
		
		
		$em = $this->getDoctrine()->getEntityManager();
		$em -> persist($reg);
		$em->flush();

		return new Response('User '.$reg->getUsername().' was registred. Your ID is '.$reg->getId());
   }
   
	public function checkemailAction() {
		$request = $this->container->get('request');
		$email = $request->get('email'); 
		$repository = $this->getDoctrine()->getRepository('InstasaverIndexEnBundle:User');
		$resultEmail = $repository->findOneByEmail($email);
		if ($resultEmail == null) {
			return new Response( 1 );
		} else {
			return new Response( 0 );
		}
	}
	
	public function checkusernameAction() {
		$request = $this->container->get('request');
		$user = $request->get('user');  
		$repository = $this->getDoctrine()->getRepository('InstasaverIndexEnBundle:User');
		$resultUser = $repository->findOneByUsername($user);
		if ($resultUser == null) {
			return new Response( 1 );
		} else {
			return new Response( 0 );
		}
		
	}
	
	public function geturlAction() {
		$request = $this->container->get('request');
		$url = $request->get('url');
		$html = file_get_html($url);
        foreach ( $html->find('meta[property=og:image]') as $meta )
        {		
			return new Response( $meta->content );
        }
        $html->clear();
        unset($html);
	}
}