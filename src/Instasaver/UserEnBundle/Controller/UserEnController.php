<?php

namespace Instasaver\UserEnBundle\Controller;
use Instasaver\IndexEnBundle\Entity\User;
use Instasaver\UserEnBundle\Entity\LangEn;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Cookie;

class UserEnController extends Controller {

	public function indexAction($id_num) {
		$user = $this->get('security.token_storage')->getToken()->getUser();
		$userLang = $user->getUserLang();
		//var_dump($user);
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

		$userId = $user->getId(); /*залогиненый юзер*/
		$currentUserId = $id_num; /*айди юзера в адресной строке*/
		$currentUserId = intval($currentUserId);

		if ($userId == $currentUserId) {
			$mainInfBtn = 1;
		} else {
			$mainInfBtn = 0;
		}

		$em = $this->getDoctrine()->getEntityManager();
		$query = $em->createQuery(
			"SELECT username FROM InstasaverIndexEnBundle:User username WHERE username.id = $id_num"
		);
		$userTableInfo = $query->getSingleResult();
		$userAbout = $userTableInfo->getUserAbout();

		//$array = (array) $userTableInfo;
		//var_dump($userTableInfo);

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
					'pass_change_success'	=> 'Password was changed successfully!'
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
					'follow' 				=> strtoupper('śledzić'),
					'saved_photos' 			=> 'Zapisane zdjęcia',
					'wrong_pass'			=> 'Podane stare hasło nie jest poprawne!',
					'notmatch_pass'			=> 'Sprawdz poprawność podanego hasła',
					'pass_change_success'	=> 'Hasło zostało zmienione pomyślnie!'
				));
				break;
			case 'ru':
				return $this->render('::user.html.twig', array (
					'username'				=> $userTableInfo->getUsername(),
					'logout'				=> 'Выход',
					'main_inf_btn'			=> $mainInfBtn,
					'email'					=> $userTableInfo->getEmail(),
					'userAboutTpl'			=> $userAboutTpl,
					'edit_profile'			=> 'РЕДАКТИРОВАТЬ ПРОФИЛЬ',
					'account_settings' 		=> 'НАСТРОЙКИ ПРОФИЛЯ',
					'edit_profile_tab'		=> 'РЕДАКТИРОВАТЬ ПРОФИЛЬ',
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
					'follow' 				=> strtoupper('подписаться'),
					'saved_photos' 			=> 'Сохраненные фотографии',
					'wrong_pass'			=> 'Неверно указан старый пароль!',
					'notmatch_pass'			=> 'Проверьте правильность ввода пароля',
					'pass_change_success'	=> 'Пароль был успешно сменен!'
				));
				break;
			case 'es':
				return $this->render('::user.html.twig', array (
					'username'				=> $userTableInfo->getUsername(),
					'logout'				=> 'Cerrar sesión',
					'main_inf_btn'			=> $mainInfBtn,
					'email'					=> $userTableInfo->getEmail(),
					'userAboutTpl'			=> $userAboutTpl,
					'edit_profile'			=> strtoupper('Editar perfil'),
					'account_settings' 		=> strtoupper(''),
					'edit_profile_tab'		=> strtoupper(''),
					'change_pass_tab' 		=> strtoupper(''),
					'username_label' 		=> 'Login',
					'email_label' 			=> '',
					'about_label' 			=> '',
					'language_label' 		=> '',
					'save_btn' 				=> '',
					'close_btn' 			=> '',
					'old_pass_lbl' 			=> '',
					'new_pass_lbl' 			=> '',
					'confirm_pass_lbl' 		=> '',
					'follow' 				=> strtoupper(''),
					'saved_photos' 			=> '',
					'wrong_pass'			=> 'Old password is incorrect!',
					'notmatch_pass'			=> 'New password not match',
					'pass_change_success'	=> 'SUCCESS'
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
					return new Response( 'warning' );
				} else {
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
			return new Response( 'danger' );
		}

	}

}