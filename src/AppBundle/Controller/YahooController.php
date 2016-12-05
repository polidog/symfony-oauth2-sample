<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2016/12/06
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tavii\OAuth2\Client\Provider\YConnect;
use Tavii\OAuth2\Client\Provider\YConnectResourceOwner;

/**
 * @Route("/yahoo")
 * Class YahooController
 */
class YahooController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->get('oauth2.registry')
            ->getClient('yconnect_client') // key used in config.yml
            ->redirect(['profile']);
    }

    /**
     * @Route("/callback")
     *
     */
    public function callbackAction()
    {
        /** @var YConnect $client */
        $client = $this->get('oauth2.registry')
            ->getClient('yconnect_client');

        try {
            /** @var YConnectResourceOwner $user */
            $user = $client->fetchUser();
            var_dump($user->toArray());die;
            // ...
        } catch (IdentityProviderException $e) {
            var_dump($e->getMessage());die;
        }
    }

}