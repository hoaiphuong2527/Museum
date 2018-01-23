<?php

namespace App\Http\Controllers\Backend;

use App\Models\MUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Utils\SessionManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;
use App\Models\MCode;
use App\Repositories\CodeRepository;

class BackendController extends Controller
{
    /*function trả về view login*/
    public function loginForm()
    {
        /*
            *Kiểm tra session trước khi quay về trang login. 
            *Nếu có session thì redirect về trang chủ.
        */
        $sessionLogin = SessionManager::getLoginInfo();
        if($sessionLogin)
        {
            return redirect('/admin');
        }
        return view('Backend.login');
    }

    /*function thực hiện chức năng login, kiểm tra đăng nhập, remember me*/
    public function login(Request $request,UserRepository $userRepository )
    {
        //lấy cookie  và kiểm tra xem có tồn tại cookie không.
        $cookie = Cookie::get('remember_token');
        if($cookie != null)
        {
            $userObj = MUser::where('remember_token',$cookie)->first();
            SessionManager::setLoginInfo($userObj);
            return redirect('/admin'); 
        }
        /*Kiểm tra validate khi đăng nhập*/
        else
        {
            $validator = Validator::make($request->all(), [
            'email'             => 'required',
            'password'          => 'required'
            ],
            [
                'email.required'    => 'Vui lòng nhập email người dùng',
                'password.required'  => 'Vui lòng nhập mật khẩu để đăng nhập.',
            ]);

            if ($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            else
            {
                $email = $request->get('email');
                $password = $request->get('password');
                $user = $userRepository->findUser($email);
                
                //Thực hiện công việc kiểm tra tài khoản đăng nhập là chính xác
                if ($user)
                {
                    if($user->user_role == 0 || $user->user_role == 1)
                    {
                        if (Hash::check($password, $user['password']))
                        {
                            //if check remember me, rand auto a string and make remember_token of user 
                            if($request->get('remember'))
                            {
                                $user->remember_token = SessionManager::generateToken();
                                $user->save();
                                Cookie::queue(Cookie::make('remember_token', $user->remember_token, 119));
                                
                            }
                            SessionManager::setLoginInfo($user);
                            return redirect('/admin');                    
                        }
                        else return redirect()->back()->withErrors(['login' => "Tài khoản hoặc mật khẩu không đúng"])->withInput();
                    }else return redirect()->back()->withErrors(['login' => "Tên người dùng không phải là admin "])->withInput();
                        
                }
                else return redirect()->back()->withErrors(['login' => "Tài khoản hoặc mật khẩu không đúng"])->withInput();

                
            }
        }
        
    
    }

    //logout 
    public function logout()
    {   
        Cookie::queue(Cookie::forget('remember_token'));
        Session::flush();
        return redirect('login');
        
    }

    /*function trả về view index của backend*/
    public function index(Request $request,CodeRepository $codeRepository )
    {
        return view('Backend.index'); 
        
    }

    
}