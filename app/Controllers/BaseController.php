<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

       $this->session = \Config\Services::session();
	   $this->accessToken = $this->getToken();
    }
	
	/**
	 * @return string
	 * Вытаскивание токена из заголовков
	 */
	private function getToken():string
	{
		$token = $this->request->getHeaderLine('Authorization');
		if(!empty($token)) {
			if (preg_match('/Bearer\s(\S+)/', $token, $matches)) {
				$token = $matches[1];
				$token = trim(str_replace('Bearer','',$token));
			}
		}
		return $token;
	}
	
	/**
	 * @param string $tokenExpire
	 * @return bool
	 * Проверка просроченного токена
	 */
	public function checkToken(string $tokenExpire):bool
	{
		return (strtotime($tokenExpire) < time() )?true:false;
	}
	
	
}
