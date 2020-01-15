<?php
namespace Tools;
use PhpRbac\Rbac;

/**
 * Klasa do obsługi sesji z komunikatami
 */
class Messages extends Session
{
	// klucze sesji
	public  static 	$success 		= 'success_msg';
	public  static 	$fail 		    = 'fail_msg';
    public  static 	$info 		    = 'info_msg';

    private function __construct() {}

	// public static function init()
    // {
	// 	self::$sessionTime = \Config\Application\Session::$sessionTime;
	// }

	/**
	 * MSG
	 * @param  string $success 				Komunikat pozytywny
	 * @param  string $fail  				Komunikat negatywny
	 */
	public static function setSuccessMsg($success)
    {
			parent::set(self::$success, $success);
	}
    public static function setFailMsg($fail)
    {
            parent::set(self::$fail, $fail);
    }
    public static function setInfoMsg($info)
    {
            parent::set(self::$info, $info);
    }

    public static function getSuccessMsg()
    {
            parent::get(self::$success);
    }
    public static function getFailMsg()
    {
            parent::get(self::$fail);
    }
    public static function getInfoMsg()
    {
            parent::get(self::$info);
    }

	// wyczysc wiadomosci
	public static function clearMessages()
    {
		parent::clear(self::$success);
		parent::clear(self::$fail);
		parent::clear(self::$info);
		//parent::regenerate();
	}

}
//Access::init();
