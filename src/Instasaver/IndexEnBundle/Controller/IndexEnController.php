<?php 

namespace Instasaver\IndexEnBundle\Controller;
use Instasaver\IndexEnBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;
//use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Cookie;

include_once ("simple_html_dom.php");

class IndexEnController extends Controller
{
    public function indexAction()
    {
		$browserLang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		$user = $this->get('security.token_storage')->getToken()->getUser();
		$response = new Response();

		if (!isset($_COOKIE['userLanguage'])) {
			$userLang = $browserLang;
		} else {
			$userLang = $_COOKIE['userLanguage'];
		}
		//var_dump($userLang);
		if (is_object($user)) {
			$userId = $user->getId();
			$response = new RedirectResponse('id'.$userId);
			return $response;
		}
		
		
		switch ($userLang) {
			case 'ru': 
				return $this->render('::index.html.twig', array(
					'sign_in'                       => 'Вход',
					'sign_up'                       => 'Регистрация',
					'join'                          => 'Присоединись',
					'sign_up_modal_h4_text'         => 'Зарегистрируйтесь ',
					'sign_up_modal_sub_text'        => 'Это займет всего пару секунд:)',
					'sign_up_modal_email_label'     => 'Адрес e-mail',
					'sign_up_modal_username_label'  => 'Логин',
					'sign_up_modal_password_label'  => 'Пароль',
					'sign_up_modal_ok_button'       => 'Регистрация',
					'sign_up_modal_close_button'    => 'Закрыть',
					'content_logo'                  => 'Instasaver',
					'content_input_placeholder'     => 'Вставьте URL сюда',
					'content_get_button'            => 'Загрузить',
					'footer_about_us'               => 'О нас',
					'footer_faq'                    => 'FAQ',
					'footer_blog'                   => 'Блог',
					'footer_donation'               => 'Пожертвование',
					'invalid_email'					=> 'Укажите правильный e-mail',
					'email_not_empty'				=> 'Поле не может быть пустым',
					'username_notification'			=> 'Логин должен содержать минимум 4 знака',
					'pass_notification'				=> 'Пароль должен содержать минимум 4 знака',
					'email_busy'					=> 'Данный адрес e-mail уже занят',
					'user_busy'						=> 'Данный логин уже занят',
					'save_button'					=> 'Сохранить',
					'sign_in_modal_user_label' 		=> 'Введите логин',
					'sign_in_modal_password_label'	=> 'Введите пароль',
					'sign_in_modal_h4_text'			=> 'Вход на сайт',
					'sign_in_modal_sub_text'		=> 'Для входа на сайт заполните поля ниже',
					'sign_in_modal_ok_button'		=> 'Вход',
					'sign_in_modal_close_button'	=> 'Закрыть'
				));
			break;
			case 'en':
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
					'content_input_placeholder'     => 'Paste the URL here',
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
					'user_busy'						=> 'This username is already in use',
					'save_button'					=> 'Save',
					'sign_in_modal_user_label' 		=> 'Enter Your username',
					'sign_in_modal_password_label'	=> 'Enter Your password',
					'sign_in_modal_h4_text'			=> 'Login',
					'sign_in_modal_sub_text'		=> 'For login please fill the fields below',
					'sign_in_modal_ok_button'		=> 'Вход',
					'sign_in_modal_close_button'	=> 'Закрыть'
				));
			break;
			case 'pl':
				return $this->render('::index.html.twig', array(
					'sign_in'                       => 'Załoguj',
					'sign_up'                       => 'Rejestracja',
					'join'                          => 'Dołącz',
					'sign_up_modal_h4_text'         => 'Zarejestruj się',
					'sign_up_modal_sub_text'        => 'Zajmie Ci to parę sekund:)',
					'sign_up_modal_email_label'     => 'Adres mailowy',
					'sign_up_modal_username_label'  => 'Nazwa użytkownika',
					'sign_up_modal_password_label'  => 'Hasło',
					'sign_up_modal_ok_button'       => 'Rejestracja',
					'sign_up_modal_close_button'    => 'Zamknij',
					'content_logo'                  => 'Instasaver',
					'content_input_placeholder'     => 'Wklej URL tutaj',
					'content_get_button'            => 'Pobrać',
					'footer_about_us'               => 'O nas',
					'footer_faq'                    => 'FAQ',
					'footer_blog'                   => 'Blog',
					'footer_donation'               => 'Darowizna',
					'invalid_email'					=> 'Podaj ważny adres mailowy',
					'email_not_empty'				=> 'Pole nie może być puste',
					'username_notification'			=> 'Nazwa użytkownika musi zawierać minimum 4 znaki',
					'pass_notification'				=> 'Hasło musi zawierać minimum 4 znaki',
					'email_busy'					=> 'e-mail jest użyty przez innego użytkownika',
					'user_busy'						=> 'Nazwa użytkownika jest zajęta',
					'save_button'					=> 'Zapisz',
					'sign_in_modal_user_label' 		=> 'Podaj nazwę użytkownika',
					'sign_in_modal_password_label'	=> 'Podaj hasło',
					'sign_in_modal_h4_text'			=> 'Załoguj',
					'sign_in_modal_sub_text'		=> 'Dla łogowania wypełni pola poniżej',
					'sign_in_modal_ok_button'		=> 'Вход',
					'sign_in_modal_close_button'	=> 'Закрыть'
				));
			break;
			case 'es':
				return $this->render('::index.html.twig', array(
					'sign_in'                       => 'Entrada',
					'sign_up'                       => 'Registro',
					'join'                          => 'Únete',
					'sign_up_modal_h4_text'         => 'Regístrate',
					'sign_up_modal_sub_text'        => 'Sólo se tarda un par de segundos :)',
					'sign_up_modal_email_label'     => 'Dirección de e-mail',
					'sign_up_modal_username_label'  => 'Login',
					'sign_up_modal_password_label'  => 'Contraseña',
					'sign_up_modal_ok_button'       => 'Regístrate',
					'sign_up_modal_close_button'    => 'Cierre',
					'content_logo'                  => 'Instasaver',
					'content_input_placeholder'     => 'Pegue la URL aquí',
					'content_get_button'            => 'Descargar',
					'footer_about_us'               => 'Quiénes somos',
					'footer_faq'                    => 'FAQ',
					'footer_blog'                   => 'Blog',
					'footer_donation'               => 'Donación',
					'invalid_email'					=> 'Introduzca válida de correo electrónico',
					'email_not_empty'				=> 'El campo no puede estar vacío',
					'username_notification'			=> 'Entrar debe contener al menos 4 caracteres',
					'pass_notification'				=> 'La contraseña debe contener al menos 4 caracteres',
					'email_busy'					=> 'Esta dirección de correo electrónico ya está en uso',
					'user_busy'						=> 'Este nombre de usuario ya está en uso',
					'save_button'					=> 'Guardar',
					'sign_in_modal_user_label' 		=> 'Ingrese su login',
					'sign_in_modal_password_label'	=> 'Ingrese su contraseña',
					'sign_in_modal_h4_text'			=> 'Ingresar al sitio',
					'sign_in_modal_sub_text'		=> 'Para acceder al sitio rellene los campos de abajo',
					'sign_in_modal_ok_button'		=> 'Entrada',
					'sign_in_modal_close_button'	=> 'Cierre'
				));
			break;
		}
		
        
    }

    public function regAction() {
		$request = $this->container->get('request');
		$email = $request->get('email');     
		$username = $request->get('username');        
		$password = password_hash($request->get('password'), PASSWORD_DEFAULT); 
		$userLang = $request->get('lang');  
	   
	   //AJAX request from Index
	   
		$reg = new User();
		$reg->setEmail($email);
		$reg->setUsername($username);
		$reg->setPassword($password);
		$reg->setUserLang($userLang);
		$reg->setUserAbout('');
		$reg->setUserAvatar('');
		
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