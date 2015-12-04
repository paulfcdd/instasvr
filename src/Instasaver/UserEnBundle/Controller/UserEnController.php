<?php

namespace Instasaver\UserEnBundle\Controller;
use Instasaver\IndexEnBundle\Entity\User;
use Instasaver\UserEnBundle\Entity\LangEn;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserEnController extends Controller {

	public function indexAction($id_num) {
		$user = $this->get('security.token_storage')->getToken()->getUser();
		$userId = $user->getId(); /*залогиненый юзер*/
		$currentUserId = $id_num; /*айди юзера в адресной строке*/
		$currentUserId = intval($currentUserId);
		if ($userId == $currentUserId) {
			$mainInfBtn = 1;
		} else {
			$mainInfBtn = 0;
		}
		$userLang = $user->getUserLang();
		//var_dump($user->getUserAvatar());
		$userCookie = array(
			'name'		=> 'userLanguage',
			'value'		=> $userLang,
			'time'  => time() + 3600 * 24 * 7
		);

		$cookie = new Cookie($userCookie['name'], $userCookie['value'], $userCookie['time']);
		$response = new Response();
		$response->headers->setCookie($cookie);
		$response->send();
		//var_dump($cookie);
		$repository = $this->getDoctrine()->getRepository('InstasaverIndexEnBundle:User');
		$user = $repository->find($id_num);
		if (!$user) {
			throw $this->createNotFoundException('No user found for id '.$id_num);
		}






		$em = $this->getDoctrine()->getEntityManager();
		$query = $em->createQuery(
			"SELECT username FROM InstasaverIndexEnBundle:User username WHERE username.id = $id_num"
		);
		$userTableInfo = $query->getSingleResult();
		$userAbout = $userTableInfo->getUserAbout();

		//$array = (array) $userTableInfo;
		//var_dump($userTableInfo);
		//var_dump($user->getUserAvatar());
		if ($userAbout == null) {
			$userAboutTpl = '';
		} else {
			$userAboutTpl = $userAbout;
		}

		switch ($userLang) {
			case 'en':
				return $this->render('::user.html.twig', array (
					'username'				=> $userTableInfo->getUsername(),
					'logout'				=> 'Logout',
					'main_inf_btn'			=> $mainInfBtn,
					'email'					=> $userTableInfo->getEmail(),
					'userAboutTpl'			=> $userAboutTpl,
					'edit_profile'			=> 'EDIT PROFILE',
					'account_settings' 		=> 'ACCOUNT SETTINGS',
					'edit_profile_tab'		=> 'EDIT PROFILE',
					'change_pass_tab' 		=> 'CHANGE PASSWORD',
					'username_label' 		=> 'Username',
					'email_label' 			=> 'E-mail',
					'about_label' 			=> 'About you',
					'language_label' 		=> 'Language',
					'save_btn' 				=> 'Save',
					'close_btn' 			=> 'Close',
					'old_pass_lbl' 			=> 'Old password',
					'new_pass_lbl' 			=> 'New password',
					'confirm_pass_lbl' 		=> 'Confirm password',
					'follow' 				=> 'FOLLOW',
					'saved_photos' 			=> 'Saved photos',
					'wrong_pass'			=> 'Old password is incorrect!',
					'notmatch_pass'			=> 'Сheck the correctness of the password',
					'pass_change_success'	=> 'Password was changed successfully!',
					'avatar'				=> $user->getUserAvatar()
				));
				break;
			case 'pl':
				return $this->render('::user.html.twig', array (
					'username'				=> $userTableInfo->getUsername(),
					'logout'				=> 'Wyłoguj',
					'main_inf_btn'			=> $mainInfBtn,
					'email'					=> $userTableInfo->getEmail(),
					'userAboutTpl'			=> $userAboutTpl,
					'edit_profile'			=> strtoupper('EDYTUJ KONTO'),
					'account_settings' 		=> strtoupper('ustawienia konta'),
					'edit_profile_tab'		=> strtoupper('edytuj konto'),
					'change_pass_tab' 		=> ('ZMIEŃ HASŁO'),
					'username_label' 		=> 'Login',
					'email_label' 			=> 'E-mail',
					'about_label' 			=> 'O mnie',
					'language_label' 		=> 'Język',
					'save_btn' 				=> 'Zapisz',
					'close_btn' 			=> 'Zamknij',
					'old_pass_lbl' 			=> 'Aktualne hasło',
					'new_pass_lbl' 			=> 'Nowe hasło',
					'confirm_pass_lbl' 		=> 'potwierdź hasło',
					'follow' 				=> 'ŚLEDZIĆ',
					'saved_photos' 			=> 'Zapisane zdjęcia',
					'wrong_pass'			=> 'Podane stare hasło nie jest poprawne!',
					'notmatch_pass'			=> 'Sprawdz poprawność podanego hasła',
					'pass_change_success'	=> 'Hasło zostało zmienione pomyślnie!',
					'avatar'				=> $user->getUserAvatar()
				));
				break;
			case 'ru':
				return $this->render('::user.html.twig', array (
					'username'				=> $userTableInfo->getUsername(),
					'logout'				=> 'Выход',
					'main_inf_btn'			=> $mainInfBtn,
					'email'					=> $userTableInfo->getEmail(),
					'userAboutTpl'			=> $userAboutTpl,
					'edit_profile'			=> 'НАСТРОЙКИ',
					'account_settings' 		=> 'НАСТРОЙКИ ПРОФИЛЯ',
					'edit_profile_tab'		=> 'РЕДАКТИРОВАТЬ ',
					'change_pass_tab' 		=> 'СМЕНИТЬ ПАРОЛЬ',
					'username_label' 		=> 'Логин',
					'email_label' 			=> 'E-mail',
					'about_label' 			=> 'О себе',
					'language_label' 		=> 'Язык',
					'save_btn' 				=> 'Сохранить',
					'close_btn' 			=> 'Закрыть',
					'old_pass_lbl' 			=> 'Текущий пароль',
					'new_pass_lbl' 			=> 'Новый пароль',
					'confirm_pass_lbl' 		=> 'Повторите пароль',
					'follow' 				=> 'ПОДПИСАТЬСЯ',
					'saved_photos' 			=> 'Сохраненные фотографии',
					'wrong_pass'			=> 'Неверно указан старый пароль!',
					'notmatch_pass'			=> 'Проверьте правильность ввода пароля',
					'pass_change_success'	=> 'Пароль был успешно сменен!',
					'avatar'				=> $user->getUserAvatar()
				));
				break;
			case 'es':
				return $this->render('::user.html.twig', array (
					'username'				=> $userTableInfo->getUsername(),
					'logout'				=> 'Cerrar sesión',
					'main_inf_btn'			=> $mainInfBtn,
					'email'					=> $userTableInfo->getEmail(),
					'userAboutTpl'			=> $userAboutTpl,
					'edit_profile'			=> 'EDITAR DE PERFIL',
					'account_settings' 		=> 'CONFIGURACIÓN DE LA CUENTA',
					'edit_profile_tab'		=> 'EDITAR DE PERFIL',
					'change_pass_tab' 		=> 'CAMBIAR CONTRASEÑA',
					'username_label' 		=> 'Usuario',
					'email_label' 			=> 'Email',
					'about_label' 			=> 'Acerca de ti',
					'language_label' 		=> 'Idioma',
					'save_btn' 				=> 'Guardar',
					'close_btn' 			=> 'Cerca',
					'old_pass_lbl' 			=> 'Contraseña antigua',
					'new_pass_lbl' 			=> 'Contraseña nueva',
					'confirm_pass_lbl' 		=> 'Confirmar contraseña',
					'follow' 				=> 'SEGUIR',
					'saved_photos' 			=> 'Guardadas fotos',
					'wrong_pass'			=> 'Old password is incorrect!',
					'notmatch_pass'			=> 'New password not match',
					'pass_change_success'	=> 'SUCCESS',
					'avatar'				=> $user->getUserAvatar()
				));
				break;
		}

		//return new Response('Hello, '.$username[0]->getUsername());

	}

	public function editProfileAction() {
		$user = $this->get('security.token_storage')->getToken()->getUser();
		$request = $this->container->get('request');

		$userId = $user->getId();
		$username = $request->get('username');
		$email = $request->get('email');
		$about = $request->get('about');
		$lang = $request->get('lang');

		$em = $this->getDoctrine()->getEntityManager();
		$update = $em->getRepository('InstasaverIndexEnBundle:User')->find($userId);

		$update->setUsername($username);
		$update->setEmail($email);
		$update->setUserAbout($about);
		$update->setUserLang($lang);

		$em->persist($update);
		$em->flush();

		return new Response ('true');
	}

	public function getCurrentLangAction () {
		$user = $this->get('security.token_storage')->getToken()->getUser();
		$currentLang = $user->getUserLang();
		return new Response( $currentLang );
	}

	public function changePassAction () {

		$user = $this->get('security.token_storage')->getToken()->getUser();
		$request = $this->container->get('request');
		$userId = $user->getId();

		$username = $user->getUsername();
		$email	 = $user->getEmail();
		$oldpass = $request->get('oldPassword');
		$newpass = $request->get('newPassword');
		$confpas = $request->get('confimPassword');
		$currentPass = $user->getPassword();
		/*Creat mail notification*/

		$message = \Swift_Message::newInstance()
					->setSubject('Test email')
					->setFrom('notifications@instasaver.pl')
					->setTo($email)
					->setBody(
						$this->renderView(
							'emails\test.html.twig',
							array('' => '')
						), 'text/html'
					);

		/*comparison of passwords*/
		if (password_verify($oldpass, $currentPass)) {
			if ($newpass !== $confpas) {
					/*If newpass and confpass are not compare - retur warning message*/
					return new Response( 'warning' );
				} else {
					/*if everything is OK - change password and send notification email*/
					$newpass = password_hash($newpass, PASSWORD_DEFAULT);
					$em = $this->getDoctrine()->getEntityManager();
					$update = $em->getRepository('InstasaverIndexEnBundle:User')->find($userId);
					$update->setPassword($newpass);

					$em->persist($update);
					$em->flush();
					//$this->get('mailer')->send($message);
					return new Response( 'success' );
			}
		}  else {
			/*If old password is wrong - return error message*/
			return new Response( 'danger' );
		}

	}

	public function uploadAvatarAction() {
		$user = $this->get('security.token_storage')->getToken()->getUser();
		$request = $this->container->get('request');
		$userId = $user->getId();
		$imageJSON = $request->get('imageJSON');
		$imageBASE64 = json_decode($imageJSON);
		list($type, $imageBASE64) = explode(';', $imageBASE64);
		list(, $imageBASE64)      = explode(',', $imageBASE64);
		$data = base64_decode($imageBASE64);
		$path = '../web/uploads/id'.$userId.'.jpg';
		$pathForDb = '/uploads/id'.$userId.'.jpg';
		if (file_put_contents($path, $data) == true) {
			$em = $this->getDoctrine()->getEntityManager();
			$update = $em->getRepository('InstasaverIndexEnBundle:User')->find($userId);
			$update->setUserAvatar($pathForDb);
			$em->persist($update);
			$em->flush();
			return new Response('OK');
		} else {
			return new Response('Error');
		}
	}

}