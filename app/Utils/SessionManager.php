<?php

namespace App\Utils;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class SessionManager extends Session
{
    //session ngôn ngữ
    public static function setLang($lang){
        Session::put("LANG",$lang);
    }

    public static function getLang(){
        $currentLang = null;
        if(Session::has("LANG")){
            $currentLang  = Session::get("LANG");
        }
        return $currentLang;
    }

    //session admin đăng nhập backend
    public static function setLoginInfo($userInfo) {
        Session::put("USER_LOGIN_INFO", $userInfo);
    }

    public static function getLoginInfo() {
        $loginUserInfo = null;
        if(Session::has("USER_LOGIN_INFO")) {
            $loginUserInfo = Session::get("USER_LOGIN_INFO");
        }
        return $loginUserInfo;
    }
    
    public static function isAdmin() {
        $loginUserInfo = SessionManager::getLoginInfo();
        $isAdmin = false;
        if($loginUserInfo != null && ($loginUserInfo->user_role == 0 || $loginUserInfo->user_role == 1)) {
            $isAdmin = true;
        }
        return $isAdmin;
    }

    public static function getLoginId() {
        $loginUserInfo = SessionManager::getLoginInfo();
        $loginId = null;
        if($loginUserInfo != null) {
            $loginId = $loginUserInfo->user_id;
        }
        return $loginId;
    }

    public static function logout() {
        Session::flush();
    }

    //generate Token hỗ trợ remeber me
    public static function generateToken()
	{
		return md5(Carbon::now() . rand(100000, 999999));
	}

    //session người dùng đăng nhập trên fontend
    public static function setLoginInFontend($code)
    {
        Session::put("IS_lOGIN",$code);
    }

    public static function getLoginInFontend()
    {
        $getLogin = null;
        if(Session::has("IS_lOGIN")){
            $getLogin  = Session::get("IS_lOGIN");
        }
        return $getLogin;
    }

    public static function isLogined()
    {
        $getLogin = SessionManager::getLoginInFontend();
        $isLogined = false;
        if($getLogin != null && $getLogin->deleted_flag == 0 && $getLogin->expried < time()) {
            $isLogined = true;
        }
        return $isLogined;
    }
}