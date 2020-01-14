<?php
	namespace Tools;

	/**
	 * Klasa do obsługi routingu
	 */
	class Router  {
    protected static $router = null;

    public static function getRouter() {
        if(!isset(self::$router) || self::$router === null) {

          self::$router = new \AltoRouter();
          self::$router->setBasePath('/'.\Config\Application\Config::$tab['path']);

          // Strona Główna
          self::$router->map('GET','', array('controller' =>'Index', 'action' => 'home'), 'home');

          //Tabela Druzyna
          self::$router->map('GET','druzynaTabela', array('controller' =>'Druzyna', 'action' => 'showView'), 'druzynaTabela');
          self::$router->map('GET','druzyna/formularzDodaj', array('controller' =>'Druzyna', 'action' => 'insertForm'), 'druzynaFormularzDodaj');
          self::$router->map('POST','druzyna/insert', array('controller' =>'Druzyna', 'action' => 'insert'), 'druzynaDodaj');
          self::$router->map('GET','druzyna/formularzUpdate/[i:id]', array('controller' =>'Druzyna', 'action' => 'createForm'), 'druzynaFormularzUpdate');
          self::$router->map('POST','druzyna/update', array('controller' =>'Druzyna', 'action' => 'update'), 'druzynaUpdate');
          self::$router->map('GET','druzyna/usun/[i:id]', array('controller' =>'Druzyna', 'action' => 'delete'), 'druzynaUsun');
          self::$router->map('GET','druzyna/formularzUpdateModal/[i:id]', array('controller' =>'Druzyna', 'action' => 'createModalForm'), 'druzynaFormularzUpdateModal');

          //Tabela Zawodnik
          self::$router->map('GET','zawodnikTabela', array('controller' =>'Zawodnik', 'action' => 'showView'), 'zawodnikTabela');
          self::$router->map('GET','zawodnik/formularzDodaj', array('controller' =>'Zawodnik', 'action' => 'insertForm'), 'zawodnikFormularzDodaj');
          self::$router->map('POST','zawodnik/insert', array('controller' =>'Zawodnik', 'action' => 'insert'), 'zawodnikDodaj');
          self::$router->map('GET','zawodnik/formularzUpdate/[i:id]', array('controller' =>'Zawodnik', 'action' => 'createForm'), 'zawodnikFormularzUpdate');
          self::$router->map('POST','zawodnik/update', array('controller' =>'Zawodnik', 'action' => 'update'), 'zawodnikUpdate');
          self::$router->map('GET','zawodnik/usun/[i:id]', array('controller' =>'Zawodnik', 'action' => 'delete'), 'zawodnikUsun');
          self::$router->map('GET','druzyna/sklad/[i:id]', array('controller' =>'Zawodnik', 'action' => 'showSklad'), 'druzynaSklad');
          self::$router->map('GET','druzyna/sklad/formularzDodaj/[i:id]', array('controller' =>'Zawodnik', 'action' => 'dodajDoSkladu'), 'druzynaDodajZawodnika');
          self::$router->map('GET','zawodnik/formularzUpdateModal/[i:id]', array('controller' =>'Zawodnik', 'action' => 'createModalForm'), 'zawodnikFormularzUpdateModal');

          //Tabela Mecz
          self::$router->map('GET','meczTabela', array('controller' =>'Mecz', 'action' => 'showView'), 'meczTabela');
          self::$router->map('GET','meczTabela/nadchodzace', array('controller' =>'Mecz', 'action' => 'showNadchodzace'), 'meczNadchodzace');
          self::$router->map('GET','meczTabela/rozegrane', array('controller' =>'Mecz', 'action' => 'showRozegrane'), 'meczRozegrane');
          self::$router->map('GET','mecz/formularzDodaj', array('controller' =>'Mecz', 'action' => 'insertForm'), 'meczFormularzDodaj');
          self::$router->map('POST','mecz/insert', array('controller' =>'Mecz', 'action' => 'insert'), 'meczaDodaj');
          self::$router->map('GET','mecz/formularzUpdate/[i:id]', array('controller' =>'Mecz', 'action' => 'createForm'), 'meczFormularzUpdate');
          self::$router->map('POST','mecz/update', array('controller' =>'Mecz', 'action' => 'update'), 'meczUpdate');
          self::$router->map('GET','mecz/usun/[i:id]', array('controller' =>'Mecz', 'action' => 'delete'), 'meczaUsun');
          self::$router->map('GET','mecz/formularzUpdateModal/[i:id]', array('controller' =>'Mecz', 'action' => 'createModalForm'), 'meczFormularzUpdateModal');

          //uzytkownik
          self::$router->map('GET','uzytkownik/registerForm', array('controller' =>'Rejestracja', 'action' => 'showFormRegister'), 'showFormRegister');
          self::$router->map('POST','uzytkownik/zarejestruj', array('controller' =>'Rejestracja', 'action' => 'registerParticipant'), 'registerParticipant');
          self::$router->map('POST','uzytkownik/zaloguj', array('controller' =>'Uzytkownik', 'action' => 'login'), 'login');
          self::$router->map('GET','uzytkownik/loginForm', array('controller' =>'Uzytkownik', 'action' => 'zalogujForm'), 'zalogujForm');
          self::$router->map('GET','uzytkownik/wyloguj', array('controller' =>'Uzytkownik', 'action' => 'logout'), 'logout');

        }
        return self::$router;

  }
}
