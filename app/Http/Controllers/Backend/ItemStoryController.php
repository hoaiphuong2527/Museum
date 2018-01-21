<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\ItemStoryRepository;
use Illuminate\Support\Facades\Validator;
use App\Repositories\ItemTranslateRepository;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

class ItemStoryController extends Controller
{
    /*Trả về view danh sách các item*/
    public function index(ItemStoryRepository $itemStoryRepository)
    {
        $lists = $itemStoryRepository->getAllItem('en');
        return view('Backend.stories.index',['lists' => $lists]);
    }

    /*Trả về view tạo mới một item với danh sách parent_id */
    public function create(CategoryRepository $categoryRepository)
    {
        $category_list = $categoryRepository->getListCategoryWithLangParentID('en', 0);
        foreach ($category_list as &$row) {
            $sub = $categoryRepository->getListCategoryWithLangParentID('en', $row['category_id']);
            $row['sub'] = $sub;
            /*foreach ($row['sub'] as &$sub) {
                $sub_con = $categoryRepository->getListCategoryWithLangParentID('en', $sub['category_id']);
                $sub['sub_con'] = $sub_con;
            }*/
        }
        return view('Backend.stories.create',['category_list' => $category_list]);
    }

    /*
        *Thực hiện chức năng tạo mới.
        *Có upload file.
    */
    public function postCreate(Request $request, ItemStoryRepository $itemStoryRepository, ItemTranslateRepository $itemTranslateRepository)
    {
        //Kiểm tra validate
        $validator = Validator::make(
            $request->all(),
            [
                'slug'      =>  'required',
                'code'      =>  'required',
                'parent_id' =>  'required',
                'status'    =>  'required',
                'image'     =>  'required|image|max:4096',
                'sound'     =>  'sometimes|max:4096',
                'name_vn'   =>  'required',
                'name_en'   =>  'required',
                'name_jp'   =>  'required',
                'description_vn' => 'required',
                'description_en' => 'required',
                'description_jp' => 'required',
            ],
            [
                'slug.required'             => 'Vui lòng nhập slug',
                'code.required'             => 'Vui lòng nhập mã cho bối cảnh',
                'parent_id.required'        => 'Vui lòng chọn parent_id',
                'status.required'           => 'Vui lòng chọn trạng thái cho bối cảnh',
                'image.required'            => 'Vui lòng chọn hình ảnh',
                'image.image'               => 'Hình ảnh bạn chọn không hợp lệ',
                'image.max'                 => 'Hình ảnh phải nhỏ hơn 4MB',
                'sound.required'            => 'Vui lòng chọn âm thanh',
                'sound.max'                 => 'Âm thanh phải nhỏ hơn 4MB',
                'name_vn.required'          => 'Vui lòng nhập tên Tiếng Việt cho bối cảnh',
                'name_en.required'          => 'Vui lòng nhập tên Tiếng Anh cho bối cảnh',
                'name_jp.required'          => 'Vui lòng nhập tên Tiếng Nhật cho bối cảnh',
                'description_vn.required'   => 'Vui lòng nhập mô tả cho bối cảnh bằng Tiếng Việt',
                'parent_id.description_en'  => 'Vui lòng nhập mô tả cho bối cảnh bằng Tiếng Anh',
                'description_jp.required'   => 'Vui lòng nhập mô tả cho bối cảnh bằng Tiếng Nhật',

            ]);
        if($validator->fails())
        {
            return redirect()->back()->with('notify', $validator->errors()->first())->withInput();
        }
        else
        {
            $slug = $request->input('slug');
            $code = $request->input('code');
            $parent_id = $request->input('parent_id');
            $status = $request->input('status');
            $name_vn = $request->input('name_vn');
            $name_en = $request->input('name_en');
            $name_jp = $request->input('name_jp');
            $description_vn = $request->input('description_vn');
            $description_en = $request->input('description_en');
            $description_jp = $request->input('description_jp');

            //Thực hiện chức năng tạo
            $item_story = $itemStoryRepository->create(
                [
                    "category_id"       => $parent_id,
                    "code"              => $code,
                    "slug"              => $slug,
                    "status"            => $status,
                    "deleted_flag"      => 0,
                    "created_user"      => 1,     
                    "created_time"      => date("Y-m-d H:i:s"),
                    "updated_user"      => 1,
                    "updated_time"      => date("Y-m-d H:i:s"),
                ]);
            /*
                *uplaod media.
                *Thực hiện lưu file theo id + thời gian tạo để dễ dàng phân biệt, và không bị trùng.
                *Đối với file âm thanh. kiểm tra đuôi trước khi lưu, Validate không làm được điều này nên phải viết riêng.
            */
            if ($item_story->item_story_id > 0) {
                // Edit image/sound here.
                
                if (Input::hasfile('image')) {
                    //image
                    $nameImage = Input::file('image')->getClientOriginalExtension();
                    $imageURL = $item_story->item_story_id . "." . date("H_i_s", time()) . "." . $nameImage;
                    Input::file('image')->move(public_path('upload/image/item_Story/'), $imageURL);
                } else {
                    $imageURL = "";
                }
                if (Input::hasfile('sound')) {
                    //sound
                    $nameSound = Input::file('sound')->getClientOriginalExtension();
                    if ($nameSound == 'mp3') {
                        $soundURL = $item_story->item_story_id. "." . date("H_i_s", time()) . "." . $nameSound;
                        Input::file('sound')->move(public_path('upload/audio/item_Story/'), $soundURL);
                    } else {
                        return redirect()->back()->withErrors(['sound' => "Vui lòng chọn đúng kiểu âm thanh"])->withInput();
                    }
                } else {
                    $soundURL = "";
                }

                // Thực hiện update file
                $itemStoryRepository->update([
                    'url_image' => $imageURL,
                    'sound'     => $soundURL
                ], $item_story->item_story_id, "item_story_id");

            } else {
                return redirect('item')->with('notify', "Xảy ra lỗi ở quá trình upload file!");
            }
            
            /* Thêm bối cảnh (vn) cho table m_item_story_translation */
            $item_story_translation_vn = $itemTranslateRepository->create(
                [
                    "item_story_id"   => $item_story->item_story_id,
                    "title"          => $name_vn,
                    "description"   => $description_vn,
                    "locale"        => 'vi',
                    "deleted_flag"  => 0,
                    "created_user"  => 1,
                    "created_time"  => date("Y-m-d H:i:s"),
                    "updated_user"  => 1,
                    "updated_time"  => date("Y-m-d H:i:s"),
                ]
            );

            /* Thêm bối cảnh (en) cho table m_item_story_translation */
            $item_story_translation_en = $itemTranslateRepository->create(
                [
                    "item_story_id" => $item_story->item_story_id,
                    "title"         => $name_en,
                    "description"   => $description_en,
                    "locale"        => 'en',
                    "deleted_flag"  => 0,
                    "created_user"  => 1,
                    "created_time"  => date("Y-m-d H:i:s"),
                    "updated_user"  => 1,
                    "updated_time"  => date("Y-m-d H:i:s"),
                ]
            );

            /* Thêm bối cảnh (jp) cho table m_item_story_translation */
            $item_story_translation_jp = $itemTranslateRepository->create(
                [
                    "item_story_id"   => $item_story->item_story_id,
                    "title"         => $name_jp,
                    "description"   => $description_jp,
                    "locale"        => 'jp',
                    "deleted_flag"  => 0,
                    "created_user"  => 1,
                    "created_time"  => date("Y-m-d H:i:s"),
                    "updated_user"  => 1,
                    "updated_time"  => date("Y-m-d H:i:s"),
                ]
            );
            /* Kiểm tra trạng thái và redirect về trang danh sách danh mục*/
            if($item_story!=null && $item_story_translation_vn!=null && $item_story_translation_en!=null && $item_story_translation_jp!=null) {
                return redirect('/admin/story_item')->with('notify-success', 'Thêm danh mục thành công');
            } else {
                return redirect('/admin/story_item')->with('notify-error', 'Thêm danh mục thất bại');
            }    
        }
    }
    /*
        function trả về view chỉnh sửa với dữ liệu là danh sách parent_id
    */
    public function update($id,Request $request, CategoryRepository $categoryRepository, ItemStoryRepository $itemStoryRepository, ItemTranslateRepository $itemTranslateRepository )
    {
        $validator = Validator::make(['item_story_id' => $id], [
            'item_story_id'   => 'exists:m_item_story,item_story_id'
        ], [
            'item_story_id.exists'      => 'Không tồn bối cảnh',
        ]);

        if ($validator->fails())
        {
            return redirect()->back();
        }
        else
        {
            $category_list = $categoryRepository->getListCategoryWithLangParentID('en', 0);
            foreach ($category_list as &$row) {
                $sub = $categoryRepository->getListCategoryWithLangParentID('en', $row['category_id']);
                $row['sub'] = $sub;
            }
            $item_story = $itemStoryRepository->find((int)$id);
            return view('Backend.stories.update', ['item_story' => $item_story,'category_list' => $category_list]);
        }
    }

    /*
        *Thực hiện chức năng chỉnh sửa.
    */
    public function postUpdate($id, Request $request, ItemStoryRepository $itemStoryRepository)
    {
        //Tìm kiếm item theo id và kiểm tra validate khi chỉnh sửa
        $item = $itemStoryRepository->find((int) $id);
        $validator = Validator::make(
            $request->all(),
            [
                'slug'      =>  'required',
                'code'      =>  'required',
                'parent_id' =>  'required',
                'status'    =>  'required',
                'image'     =>  'required|image|max:4096',
                'sound'     =>  'sometimes|max:4096',
                'name_vn'   =>  'required',
                'name_en'   =>  'required',
                'name_jp'   =>  'required',
                'description_vn' => 'required',
                'description_en' => 'required',
                'description_jp' => 'required',
            ],
            [
                'slug.required'             => 'Vui lòng nhập slug',
                'code.required'             => 'Vui lòng nhập mã cho bối cảnh',
                'parent_id.required'        => 'Vui lòng chọn parent_id',
                'status.required'           => 'Vui lòng chọn trạng thái cho bối cảnh',
                'image.required'            => 'Vui lòng chọn hình ảnh',
                'image.image'               => 'Hình ảnh bạn chọn không hợp lệ',
                'image.max'                 => 'Hình ảnh phải nhỏ hơn 4MB',
                'sound.max'                 => 'Âm thanh phải nhỏ hơn 4MB',
                'name_vn.required'          => 'Vui lòng nhập tên Tiếng Việt cho bối cảnh',
                'name_en.required'          => 'Vui lòng nhập tên Tiếng Anh cho bối cảnh',
                'name_jp.required'          => 'Vui lòng nhập tên Tiếng Nhật cho bối cảnh',
                'description_vn.required'   => 'Vui lòng nhập mô tả cho bối cảnh bằng Tiếng Việt',
                'parent_id.description_en'  => 'Vui lòng nhập mô tả cho bối cảnh bằng Tiếng Anh',
                'description_jp.required'   => 'Vui lòng nhập mô tả cho bối cảnh bằng Tiếng Nhật',

            ]);

        if ($validator->fails())
        {
            return redirect()->back()->with('notify', $validator->errors()->first())->withInput();
        }
        else
        {
            $slug = $request->get('slug');
            $code = $request->get('code');
            $parent_id = $request->get('parent_id');
            $status = $request->get('status');
            $name_vn = $request->get('name_vn');
            $name_en = $request->get('name_en');
            $name_jp = $request->get('name_jp');
            $description_vn = $request->get('description_vn');
            $description_en = $request->get('description_en');
            $description_jp = $request->get('description_jp');

            //upload file
            if (Input::hasfile('image'))
            {
                $nameImage = Input::file('image')->getClientOriginalExtension();
                $imageURL = $id . "." . date("H_i_s",time()). ".". $nameImage;
                $oldImage = $item->url_image;
                if($oldImage != '')
                {
                    //Xóa file cũ khi có chỉnh sửa để tránh lãng phí bộ nhớ
                    if(File::exists(public_path('upload/image/item_Story/') . $oldImage))
                    {
                        unlink(public_path('upload/image/item_Story/') . $oldImage);   
                    } 
                }
                Input::file('image')->move(public_path('upload/image/item_Story/'), $imageURL);
                //update file
                $itemStoryRepository->update(
                    [
                        "image"          => $imageURL,
                    ],
                    $id,
                    "item_story_id"
                );   
            }
            //upload audio
            if(Input::hasfile('sound'))
            {
                //sound
                $nameSound = Input::file('sound')->getClientOriginalExtension();
                $oldSound = $item->sound;
                if($nameSound == 'mp3')
                {
                    $soundURL = $id . "." . date("H_i_s",time()). ".". $nameSound;
                    if($oldSound != '')
                    {
                        //Xóa file cũ khi có chỉnh sửa để tránh lãng phí bộ nhớ
                        if(File::exists(public_path('upload/audio/item_Story/') . $oldSound))
                        {
                            unlink(public_path('upload/audio/item_Story/').$oldSound);   
                        }
                    }
                    Input::file('sound')->move(public_path('upload/audio/item_Story/'), $soundURL);
                    //update file
                    $itemStoryRepository->update(
                        [
                            "sound"          =>$soundURL,
                        ],
                        $id,
                        "item_story_id"
                    );
                }else
                {
                    return redirect()->back()->withErrors("Vui lòng chọn đúng kiểu âm thanh")->withInput();                    
                }
                
                
            }

            //update item
            $itemStoryRepository->update([
                "category_id"       => $parent_id,
                "code"              => $code,
                "slug"              => $slug,
                "status"            => $status,
                "deleted_flag"      => 0,
                "created_user"      => 1,     
                "created_time"      => date("Y-m-d H:i:s"),
                "updated_user"      => 1,
                "updated_time"      => date("Y-m-d H:i:s"),
            ]);
            
            /* Chỉnh sửa bối cảnh (vn) cho table m_item_story_translation */
            $item_story_translation_vn = $itemTranslateRepository->create(
                [
                    "category_id"   => $item->category_id,
                    "name"          => $name_vn,
                    "description"   => $description_vn,
                    "locale"        => 'vi',
                    "deleted_flag"  => 0,
                    "created_user"  => 1,
                    "created_time"  => date("Y-m-d H:i:s"),
                    "updated_user"  => 1,
                    "updated_time"  => date("Y-m-d H:i:s"),
                ]
            );

            /* Chỉnh sửa bối cảnh (en) cho table m_item_story_translation */
            $item_story_translation_en = $itemTranslateRepository->create(
                [
                    "category_id"   => $item->category_id,
                    "name"          => $name_en,
                    "description"   => $description_en,
                    "locale"        => 'en',
                    "deleted_flag"  => 0,
                    "created_user"  => 1,
                    "created_time"  => date("Y-m-d H:i:s"),
                    "updated_user"  => 1,
                    "updated_time"  => date("Y-m-d H:i:s"),
                ]
            );

            /* Chỉnh sửa bối cảnh (jp) cho table m_item_story_translation */
            $item_story_translation_jp = $itemTranslateRepository->create(
                [
                    "category_id"   => $item->category_id,
                    "name"          => $name_jp,
                    "description"   => $description_jp,
                    "locale"        => 'jp',
                    "deleted_flag"  => 0,
                    "created_user"  => 1,
                    "created_time"  => date("Y-m-d H:i:s"),
                    "updated_user"  => 1,
                    "updated_time"  => date("Y-m-d H:i:s"),
                ]
            );
            /* Kiểm tra trạng thái và redirect về trang danh sách danh mục*/
            if($item_story!=null && $item_story_translation_vn!=null && $item_story_translation_en!=null && $item_story_translation_jp!=null) {
                return redirect('/admin/story_item')->with('notify-success', 'Thêm danh mục thành công');
            } else {
                return redirect('/admin/story_item')->with('notify-error', 'Thêm danh mục thất bại');
            }   

        }
    }

    /*Thực hiện update cờ delete_flag*/
    public function delete($id,ItemStoryRepository $itemStoryRepository )
    {
        //get list quiz choosed 
        //$list_id = $rq->get('list_id');
        
            $itemStoryRepository->update(
                [
                    "deleted_flag"          => 1, 
                ],
                $id,
                "item_story_id"
            );
        
        return redirect()->back();
    }
}