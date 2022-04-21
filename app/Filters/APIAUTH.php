<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class APIAUTH implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
	    $token = $request->getHeaderLine('Authorization');
	    if(!empty($token)) {
		    if (preg_match('/Bearer\s(\S+)/', $token, $matches)) {
			    $token = $matches[1];
		    }
	    }
		if(is_null($token) || empty($token)) {
			$response = service('response');
			$response->setBody('Доступ запрещен! Запрос должен содержать headers: { Authorization: `Bearer ВАШ_ТОКЕН`} полученный при выполнении POST запроса с ключами login password на https://'.$_SERVER['SERVER_NAME'].'/API/Login');
			$response->setStatusCode(403);
		return $response;
		
		}
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
