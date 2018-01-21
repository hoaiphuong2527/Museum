<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\MUser;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Utils\SessionManager;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
class UserController extends Controller
{
    //view user
    public function users(Request $request, UserRepository $userRepository)
    {
        $currentLogin = SessionManager::getLoginInfo();
        $users = $userRepository->getAllUsers();
        return view('Backend.users.index', ['users' => $users],['value' => $currentLogin]);
    }

    //view tạo mới user
    public function createUser()
    {
         return view('Backend.users.create');
    }

    //Thực hiện chức năng tạo mới
    public function create(Request $request, UserRepository $userRepository)    
    {
        //Kiểm tra validate
        $validator = Validator::make(
            $request->all(),
            [
                'email'                  => 'required|email|unique:m_user,email|regex:/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/',
                'phone_num'              => 'required|digits_between:10,15|numeric',
                'name'                   => 'required|max:30',
                'password'               => 'required|min:6|regex:/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/|confirmed',    
                'image'                  => 'sometimes|image|max:4096',
            ]
            ,
            [
                'email.required'       => 'Vui lòng nhập email ',
                'email.unique'         => 'Email đã tồn tại. Vui lòng nhập email khác',
                'email.email'          => 'Email phải là địa chỉ email hợp lệ',
                'email.regex'          => 'Vui lòng nhập email không chứa những kí hiệu đặc biệt',
                'password.regex'       => 'Mật khẩu buộc phải có kí tự in hoa, kí tự thường và số',
                'password.required'    => 'Vui lòng nhập mật khẩu', 
                'password.min'         => 'Mật khẩu có ít nhất 6 ký tự', 
                'password.confirmed'   => 'Nhập lại mật khẩu không đúng. Vui lòng nhập lại mật khẩu',
                'phone_num.required'   => 'Vui lòng nhập số điện thoại',
                'phone_num.numeric'    => 'Vui lòng nhập số điện thoại bằng số',
                'phone_num.digits_between'        => 'Vui lòng nhập số điện thoại bằng số. Số điện thoại có tối thiểu 10 số và tối đa 15 số',
                'name.max'        => 'Tên người dùng có nhiều nhất 30 ký tự',
                'name.required'   => 'Vui lòng nhập tên người dùng',
                'image.required'            => 'Vui lòng chọn hình ảnh',
                'image.image'               => 'Hình ảnh bạn chọn không hợp lệ',
                'image.max'                 => 'Hình ảnh phải nhỏ hơn 4MB',
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            /*
                *Kiểm tra người đăng nhập có phải là super admin hay không, 
                nêu phải, cho phép họ có quyền tạo mới admin hoặc super admin(User_role).
                Ngược lại sẽ gán user_role = 1 (admin)
            */
            $currentLogin = SessionManager::getLoginInfo();
            if($currentLogin->user_role == 0)
            {
                $email       = $request->input('email');
                $phone_num   = $request->input('phone_num');
                $name   = $request->input('name');
                $password    = Hash::make($request->input('password'));
                $user_role   = $request->input('user_role');
                $user = $userRepository->create(
                    [
                    "email"          =>$email, 
                    "phone_num"      =>$phone_num, 
                    "name"           =>$name,
                    "password"       =>$password,  
                    "user_role"      =>$user_role,
                    "deleted_flag" => 0,
                    "created_user" => 1,
                    "created_time" => date("Y-m-d H:i:s"),
                    "updated_user" => 1,
                    "updated_time" => date("Y-m-d H:i:s"),
                    ]);
            }
            else
            {
                $email       = $request->input('email');
                $phone_num   = $request->input('phone_num');
                $name   = $request->input('name');
                $password    = Hash::make($request->input('password'));
                $user = $userRepository->create(
                    [
                    "email"          =>$email, 
                    "phone_num"      =>$phone_num, 
                    "name"           =>$name,
                    "password"       =>$password,  
                    "user_role"      =>1,
                    "deleted_flag" => 0,
                    "created_user" => 1,
                    "created_time" => date("Y-m-d H:i:s"),
                    "updated_user" => 1,
                    "updated_time" => date("Y-m-d H:i:s"),
                    ]);
            }
                //upload avta
            if ($user->user_id > 0) {
                // Edit image here.
                
                if (Input::hasfile('image')) {
                    //image
                    $nameImage = Input::file('image')->getClientOriginalExtension();
                    $imageURL = $user->user_id . "." . date("H_i_s", time()) . "." . $nameImage;
                    Input::file('image')->move(public_path('upload/image/avatar/'), $imageURL);
                } else {
                    $imageURL = "";
                }
                

                // Update
                $userRepository->update([
                    'avata' => $imageURL,

                ], $user->user_id, "user_id");

            } else {
                return redirect('item')->with('notify', "Xảy ra lỗi ở quá trình upload file!");
            }
                if($user!=null) {
                    return redirect('/admin/users')->with('notify-success', 'Thêm người dùng thành công');
                } else {
                    return redirect('/admin/users')->with('notify-error', 'Thêm người dùng thất bại');
                }
        }

    }
    

    //detail a quiz
    public function editForm($id, UserRepository $userRepository)
    {
        $currentLogin = SessionManager::getLoginInfo();
        $validator = Validator::make(['user_id' => $id], [
            'user_id'   => 'exists:m_user,user_id'
        ], [
            'user_id.require'   =>'Không tồn tại người dùng',
        ]);

        if ($validator->fails())
        {
            return redirect()->back();
        }
        else
        {
            $user = $userRepository->find((int)$id);
            if($currentLogin->user_role == 0 || $user->email == $currentLogin->email)
            {          
                return view('Backend.users.detail_user', ['user' => $user]);
            }
            else
            {                
                return redirect()->back()->withErrors(['users' => "Không thể thực hiện yêu cầu, tài khoản bạn muốn sửa là người quản trị"])->withInput();
            } 
        }
    }

    //destroy user
    public function destroyUser($id, UserRepository $userRepository)
    {
        /*Yêu cầu kiểm tra người đăng nhập có phải là super admin hay ko,
         nếu phải, họ có quyền xóa admin nhưng ko xóa đc super admin khác
         */
        $currentLogin = SessionManager::getLoginInfo();
        $user = MUser::find((int) $id);
        //update delete_flag
        if($currentLogin->user_role == 0)
        {          
            
            $userRepository->update(
                [
                    "deleted_flag"          => 1,
                ],
                $id,
                "user_id"
            );
            return redirect()->back();
        }
        else
        {
            if($user->user_role == 0 || $user->user_role == 1){
                return redirect()->back()->withErrors(['users' => "Không thể thực hiện yêu cầu, tài khoản bạn muốn xóa là người quản trị"])->withInput();
            }
        } 
    }

    //view edit
    public function detail($user_id,UserRepository $userRepository)
    {
        /*
            *Super admin có thể chỉnh sửa bản thân họ và admin thường.
            *Admin thường có thể chỉnh sửa thông tin của họ.
        */

        $users = $userRepository->getAllUsers();
        $user = MUser::find((int) $user_id);
        $validator = Validator::make(['user_id' => $user_id], [
            'user_id'   => 'exists:m_user,user_id'
            ], []);

        if ($validator->fails())
        {
            return redirect()->back();
        }
        else
        {
            return view('Backend.users.index', ['value' => $user],['users' => $users]);

        }
    }

    /*Thực hiện chức năng update*/
    public function updateUser(Request $request, $id, UserRepository $userRepository )
    {
       
        $user = $userRepository->find($id);
        $currentLogin = SessionManager::getLoginInfo();
        //Trường hợp người dùng ko đổi pass sẽ lấy pass cũ
        if($request->get('password') == '')
        {
            $validator = Validator::make($request->all(), [
                'phone_num'             => 'required|digits_between:10,15|numeric',
                'name'                  => 'required|max:30',
                'image'                 => 'sometimes|image|max:4096',
                ],
                [
                'phone_num.required'              => 'Vui lòng nhập số điện thoại',
                'phone_num.digits_between'        => 'Số điện thoại có thiểu 10 số và tối đa 15 số',
                'phone_num.numeric'               => 'Vui lòng nhập số điện thoại bằng số',
                'phone_num.digits_between'        => 'Vui lòng nhập số điện thoại bằng số. Số điện thoại có tối thiểu 10 số và tối đa 15 số',
                'name.required'                 => 'Vui lòng nhập tên người dùng',
                'image.required'                => 'Vui lòng chọn hình ảnh',
                'image.image'                   => 'Hình ảnh bạn chọn không hợp lệ',
                'image.max'                     => 'Hình ảnh phải nhỏ hơn 4MB',
                ]);
    
            if ($validator->fails())
            {
                return redirect()->back()->with('notify', $validator->errors()->first())->withInput();
            }
            else{
    
                if (Input::hasfile('image'))
                {
                    $nameImage = Input::file('image')->getClientOriginalExtension();
                    $imageURL = $id . "." . date("H_i_s",time()). ".". $nameImage;
                    $oldImage = $user->avata;
                    if($oldImage != '')
                    {
                        if(File::exists(public_path('upload/image/avatar/') . $oldImage))
                        {
                            unlink(public_path('upload/image/avatar/') . $oldImage);   
                        } 
                    }
                    Input::file('image')->move(public_path('upload/image/avatar/'), $imageURL);
                    
                    $userRepository->update(
                        [
                            "avata"          => $imageURL,
                        ],
                        $id,
                        "user_id"
                    );   
                }
                if($currentLogin->user_role == 0)
                {
                    $userRepository->update(
                        [
                        "phone_num" => $request->get('phone_num'),
                        "name" => $request->get('name'),
                        "user_role" => $request->get('user_role')
                        ], 
                        $id,
                        "user_id"
                        );
                }else
                {
                    $userRepository->update(
                        [
                        "phone_num" => $request->get('phone_num'),
                        "name" => $request->get('name')
                        ], 
                        $id,
                        "user_id"
                        );
                }

                if($user!=null) {
                    return redirect('/admin/users')->with('notify-success', 'Sửa người dùng thành công');
                } else {
                    return redirect('/admin/users')->with('notify-error', 'Sửa người dùng thất bại');
                }
            }
        }else
        {
            //Trường hợp người dùng chỉnh sửa pass
            $validator = Validator::make($request->all(), [
                'password'          => 'required|min:6|regex:/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/|confirmed',
                'phone_num'         => 'required|digits_between:10,15|numeric',
                'name'              => 'required|max:30',
                'image'             => 'sometimes|image|max:4096',
    
                ],
                [ 
                'password.regex'       => 'Mật khẩu phải có kí tự in hoa, kí tự thường và số', 
                'password.min'         => 'Mật khẩu có ít nhất 6 ký tự', 
                'password.confirmed'   => 'Vui lòng nhập lại mật khẩu',
                'phone_num.required'   => 'Số điện thoại không được để trống',
                'phone_num.digits_between'        => 'Số điện thoại có thiểu 10 số và tối đa 15 số',
                'phone_num.numeric'               => 'Vui lòng nhập bằng số',
                'phone_num.digits_between'        => 'Vui lòng nhập số điện thoại bằng số. Số điện thoại có tối thiểu 10 số và tối đa 15 số',
                'name.required'                   => 'Tên không được để trống',
                'image.required'            => 'Vui lòng chọn hình ảnh',
                'image.image'               => 'Hình ảnh bạn chọn không hợp lệ',
                'image.max'                 => 'Hình ảnh phải nhỏ hơn 4MB',
                ]);
    
            if ($validator->fails())
            {
                return redirect()->back()->with('notify', $validator->errors()->first())->withInput();
            }
            else{
                if (Input::hasfile('image'))
                {
                    $nameImage = Input::file('image')->getClientOriginalExtension();
                    $imageURL = $id . "." . date("H_i_s",time()). ".". $nameImage;
                    $oldImage = $user->avata;
                    if($oldImage != '')
                    {
                        if(File::exists(public_path('upload/image/avatar/') . $oldImage))
                        {
                            unlink(public_path('upload/image/avatar/') . $oldImage);   
                        } 
                    }
                    Input::file('image')->move(public_path('upload/image/avatar/'), $imageURL);
                    
                    $userRepository->update(
                        [
                            "avata"          => $imageURL,
                        ],
                        $id,
                        "user_id"
                    );   
                }
                if($currentLogin->user_role == 0){
                    $userRepository->update(
                        [
                        "password"   =>Hash::make($request->get('password')),
                        "phone_num"  => $request->get('phone_num'),
                        "name"  => $request->get('name'),
                        "user_role" => $request->get('user_role')
                        ], 
                        $id,
                        "user_id"
                    );
                }else
                {
                    $userRepository->update(
                        [
                        "password"   =>Hash::make($request->get('password')),
                        "phone_num"  => $request->get('phone_num'),
                        "name"  => $request->get('name'),
                        
                        ], 
                        $id,
                        "user_id"
                    );
                }
                    
                if($user!=null) {
                    return redirect('/admin/users')->with('notify-success', 'Sửa người dùng thành công');
                } else {
                    return redirect('/admin/users')->with('notify-error', 'Sửa người dùng thất bại');
                }
            }
        }
    }
}
