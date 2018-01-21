<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Repositories\CodeRepository;
use App\Utils\SessionManager;


class FrontendController extends Controller
{
    public function login()
    {
        
        return view('Frontend.login');
    }

    public function postLogin(Request $request, CodeRepository $codeRepository)
    {
        $validator = Validator::make($request->all(), [
        'code'              => 'required'
        ],
        [
            'code.required'    => 'Please enter code to login.'
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else
        {
            $code = $request->input('code');
            $item = $codeRepository->findCode($code);        
            if ($item != null)
            {
                if (SessionManager::isLogined())
                { 
                    SessionManager::setLoginInFontend($item);
                    return redirect('/homepage');  
                } else return redirect()->back()->withErrors(['loginFrontend' => "The code doesn't match, this code is used or time is out."])->withInput();
                
            } else return redirect()->back()->withErrors(['loginFrontend' => "The code doesn't match, this code is used or time is out."])->withInput();
            
        }
    }
    

    public function Lang($lang)
    {
        SessionManager::setLang($lang);
        app()->setLocale(SessionManager::getLang());
        return redirect()->back()->withInput();
    }
    public function index()
    {
        if(SessionManager::getLang() != null)
        {
            app()->setLocale(SessionManager::getLang());
            return view('Frontend.index'); 
        }
        return view('Frontend.index');
    }

    public function image()
    {
        if(SessionManager::getLang() != null)
        {
            app()->setLocale(SessionManager::getLang());
            return view('Frontend.image'); 
        }
        return view('Frontend.image');
    }

    public function img2()
    {
        if(SessionManager::getLang() != null)
        {
            app()->setLocale(SessionManager::getLang());
            return view('Frontend.img2'); 
        }
        return view('Frontend.img2');
    }

    public function img3()
    {
        if(SessionManager::getLang() != null)
        {
            app()->setLocale(SessionManager::getLang());
            return view('Frontend.img3'); 
        }
        return view('Frontend.img3');
    }

    public function list1()
    {
        if(SessionManager::getLang() != null)
        {
            app()->setLocale(SessionManager::getLang());
            return view('Frontend.list1'); 
        }
        return view('Frontend.list1');
    }

    public function list2()
    {
        if(SessionManager::getLang() != null)
        {
            app()->setLocale(SessionManager::getLang());
            return view('Frontend.list2'); 
        }
        return view('Frontend.list2');
    }

    public function list3()
    {
        if(SessionManager::getLang() != null)
        {
            app()->setLocale(SessionManager::getLang());
            return view('Frontend.list3'); 
        }
        return view('Frontend.list3');
    }

    public function demo()
    {
        if(SessionManager::getLang() != null)
        {
            app()->setLocale(SessionManager::getLang());
            return view('Frontend.demo'); 
        }
        return view('Frontend.demo');
    }
}