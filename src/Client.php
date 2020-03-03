<?php
namespace devskyfly\mgp;

use devskyfly\mgp\managers\AbstractManager;
use devskyfly\mgp\serialize\Serializer;
use devskyfly\php56\types\Arr;
use yii\base\BaseObject;
use yii\httpclient\Client as HttpclientClient;
use devskyfly\php56\types\Obj;
use devskyfly\php56\types\Vrbl;
use Yii;


class Client extends BaseObject
{
    public $auth = null;

    public $crmUrl = "https://crm.iitrust.int";

    public $proxy = "localhost:3128";
    
    public $token = null;

    protected $client = null;

    protected $managers = [];
    
    public function init()
    {
        parent::init();
        
        if (Arr::isArray($this->auth)) {
            $this->auth = Yii::createObject($this->auth);
        }

        if (!Obj::isA($this->auth, Auth::class)) {
            throw new MgpException('Property $auth is not '.Auth::class.' class type.');
        }

        if (Vrbl::isNull($this->token)) {
            $this->token = new Token;
        } else {
            if (!Obj::isA($this->token, Token::class)) {
                throw new MgpException('Property token is not '.Token::class.'class type.');
            }
        }

        $this->client = new HttpclientClient();    
        $this->initToken();       
    }

    public function makePost($url, $data, $json = true)
    {
        $request = $this->createRequest();

        $headers = $request->getHeaders();
        $headers->set('AUTHORIZATION', 'Bearer '.$this->token->value);
        $request->setMethod('POST')
        ->addHeaders(['content-type' => 'application/json'])
        ->setContent($data)
        ->setUrl($this->crmUrl.$url);

        if ($json) {
            return $this->getContent($request);
        } else {
            return $this->getData($request);
        }
    }

    public function makeDelete($url, $data, $json = true)
    {
        $request = $this->createRequest();

        $headers = $request->getHeaders();
        $headers->set('AUTHORIZATION', 'Bearer '.$this->token->value);
        $request->setMethod('DELETE')
        ->addHeaders(['content-type' => 'application/json'])
        ->setContent($data)
        ->setUrl($this->crmUrl.$url);

        if ($json) {
            return $this->getContent($request);
        } else {
            return $this->getData($request);
        }
    }

    public function makeGet($url, $data, $json = true)
    {
        $request = $this->createRequest();

        $headers = $request->getHeaders();
        $headers->set('AUTHORIZATION', 'Bearer '.$this->token->value);
        $request->setMethod('GET')
        ->setUrl($this->crmUrl.$url)
        ->setData($data);

        if ($json) {
            return $this->getContent($request);
        } else {
            return $this->getData($request);
        }
        
    }
    
    protected function createRequest()
    {
        $request = $this->client->createRequest();
        $headers = $request->getHeaders();
        $headers->set('Content-Type', 'multipart/form-data');
        $request->setFormat(HttpclientClient::FORMAT_JSON);
        if (!empty($this->proxy)) {
            $request->setOptions([
                'proxy' => $this->proxy, // use a Proxy
                'timeout' => 5, // set timeout to 5 seconds for the case server is not responding
            ]);
        }
        return $this->client->createRequest();
    } 

    protected function initToken()
    {
        $data = [
            'username' => $this->auth->user,
            'password' => $this->auth->pass,
            'grant_type' => "password"
        ];

        $request = $this->createRequest();
        $request->setMethod('POST')
        ->setUrl($this->crmUrl.'/api/v3/auth/access_token')
        ->setData($data);
        $ans = $this->getData($request);

        $this->token->value = $ans['access_token'];
        $this->token->expire = $ans['expires_in'];
        $this->token->tokenType = $ans['token_type'];

        return $this;
    }

    protected function getData($request)
    {
        try {
            $response = $request->send();
        } catch(\Exception $e) {
            throw $e;
        }

        return $response->getData();
    }

    protected function getContent($request)
    {
        try {
            $response = $request->send();
        } catch(\Exception $e) {
            throw $e;
        }

        return $response->getContent();
    }

    /**
     * Undocumented function
     *
     * @param  string $cls - AbstractManager class name.
     * @return void
     */
    public function getManager(string $cls): AbstractManager 
    {
        if (!class_exists($cls)) {
            throw new MgpException("Class '{$cls}' does not exist.");
        }
        
        if (isset($this->managers[$cls])) {
            return $this->managers[$cls];
        }

        $serializer = Serializer::getInstance();
        $manager = new $cls(['client' => $this, 'serializer' => $serializer]);
        $this->managers[$cls] = $manager;

        return $manager;
    }
}