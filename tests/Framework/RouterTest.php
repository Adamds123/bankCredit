<?php
namespace Tests\Framework;

use Framework\Router\Router;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

final class RouterTest extends  TestCase
{
    private Router  $router;
    public function setUp(): void
    {
        $this->router = new Router();
    }
    public function testMatchedRoute() : void
    {
        $request = new ServerRequest('GET', '/home');
        $this->router->get('/home', function (){
            return 'Hello';
        }, 'home');
        $route = $this->router->match($request);
        $this->assertEquals('home', $route->getName());
        $this->assertEquals('Hello', call_user_func($route->getCallback(), $request));
    }
    public function testMatchedRouteIfUrlDoesNotExist() : void
    {
        $request = new ServerRequest('GET', '/hometrr');
        $this->router->get('/home', function (){
            return 'Hello';
        }, 'home');
        $route = $this->router->match($request);
        $this->assertEquals(null, $route);
    }
    public function testMatchedRouteWithParams() : void
    {
        $request = new ServerRequest('GET', '/home/mon-article-8');
        $this->router->get('/home', function (){
            return 'Hello';
        }, 'home');
        $this->router->get('/home/{slug:[a-z0-9\-]+}-{id:[\d]+}', function (){
            return 'Hello';
        }, 'home.view');
        $route = $this->router->match($request);
        $this->assertEquals('home.view', $route->getName());
        $this->assertEquals('Hello', call_user_func($route->getCallback(), $request));
        $this->assertEquals(['slug'=>'mon-article','id'=>'8'], $route->getParams());
        $route = $this->router->match(new  ServerRequest('GET', '/home/mon_article-18'));
        $this->assertEquals(null,$route);
    }
    public function testGenerateUri() : void
    {
        $this->router->get('/home', function (){
            return 'Hello';
        }, 'post');
        $this->router->get('/home/{slug:[a-z0-9\-]+}-{id:[\d]+}', function (){
            return 'Hello';
        }, 'home.view');
        $uri = $this->router->generateUri('home.view',['slug'=>'mon-article','id'=>'18']);
        $this->assertEquals('/home/mon-article-18',$uri);
    }
}