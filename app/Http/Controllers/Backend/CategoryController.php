<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\CategoryTranslationRepository;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    /* Danh sách danh mục */
    public function index(Request $request, CategoryRepository $categoryRepository)
    {
        /* Mảng danh sách danh mục*/
        $list = $categoryRepository->getListCategoryWithLang('en');
        /* End */

        /* Tạo mảng kiểm tra gán tên cho danh mục */
        $category_list = $categoryRepository->getListCategoryWithLangParentID('en', 0);

        foreach ($category_list as &$row) {
            $sub = $categoryRepository->getListCategoryWithLangParentID('en', $row['category_id']);
            $row['sub'] = $sub;
            /*foreach ($row['sub'] as &$sub) {
                $sub_con = $categoryRepository->getListCategoryWithLangParentID('en', $sub['category_id']);
                $sub['sub_con'] = $sub_con;
            }*/
        }
        /* End*/

        return view('Backend.category.index', ['list' => $list, 'category_list' => $category_list]);
    }

    /* Create Category Form*/
    public function createCategoryForm(CategoryRepository $categoryRepository)
    {
        /* Mảng danh mục cho dropdown*/
        $category_list = $categoryRepository->getListCategoryWithLangParentID('en', 0);
        foreach ($category_list as &$row) {
            $sub = $categoryRepository->getListCategoryWithLangParentID('en', $row['category_id']);
            $row['sub'] = $sub;
            /*foreach ($row['sub'] as &$sub) {
                $sub_con = $categoryRepository->getListCategoryWithLangParentID('en', $sub['category_id']);
                $sub['sub_con'] = $sub_con;
            }*/
        }
        /*End*/

        return view('Backend.category.create', ['category_list' => $category_list]);
    }

    /* Create Category */
    public function createCategory(Request $request, CategoryRepository $categoryRepository, CategoryTranslationRepository $categoryTranslationRepository)
    {
        $validator = Validator::make(
            $request->all(),
            [
                
                'sort_order' => 'required',
                'parent_id' => 'required',
                'name_vn' => 'required',
                'name_en' => 'required',
                'name_jp' => 'required',
                'description_vn' => 'required',
                'description_en' => 'required',
                'description_jp' => 'required',
            ]
            ,
            [
                
                'sort_order.required' => 'Vui lòng chọn sort_order',
                'parent_id.required' => 'Vui lòng chọn parent_id',
                'name_vn.required' => 'Vui lòng chọn name_vn',
                'name_en.required' => 'Vui lòng chọn name_en',
                'name_jp.required' => 'Vui lòng chọn name_jp',
                'description_vn.required' => 'Vui lòng chọn description_vn',
                'parent_id.description_en' => 'Vui lòng chọn description_en',
                'description_jp.required' => 'Vui lòng chọn description_jp',

            ]
        );
        if ($validator->fails()) {
//            print_r($validator->errors()->first());
//            die();
            return redirect('/admin/category/add')->with('notify', $validator->errors()->first())->withInput();
        } else {
            $slug = $request->input('slug');
            $sort_order = $request->input('sort_order');
            $parent_id = $request->input('parent_id');
            $name_vn = $request->input('name_vn');
            $name_en = $request->input('name_en');
            $name_jp = $request->input('name_jp');
            $description_vn = $request->input('description_vn');
            $description_en = $request->input('description_en');
            $description_jp = $request->input('description_jp');
//            $imageURL = "";
//            $soundURL = "";
            /* Thêm danh mục cho table m_category */
            $item_category = $categoryRepository->create(
                [
                    
                    "sort_order" => $sort_order,
                    "parent_id" => $parent_id,
                    "image" => 'demo',
                    "image_description" => 'demo',
                    "video" => 'demo',
                    "deleted_flag" => 0,
                    "created_user" => 1,
                    "created_time" => date("Y-m-d H:i:s"),
                    "updated_user" => 1,
                    "updated_time" => date("Y-m-d H:i:s"),
                ]
            );

            /* Thêm danh mục (vn) cho table m_category_translation */
            $item_category_translation_vn = $categoryTranslationRepository->create(
                [
                    "category_id" => $item_category->category_id,
                    "name" => $name_vn,
                    "description" => $description_vn,
                    "locale" => 'vi',
                    "deleted_flag" => 0,
                    "created_user" => 1,
                    "created_time" => date("Y-m-d H:i:s"),
                    "updated_user" => 1,
                    "updated_time" => date("Y-m-d H:i:s"),
                ]
            );

            /* Thêm danh mục (jp) cho table m_category_translation */
            $item_category_translation_en = $categoryTranslationRepository->create(
                [
                    "category_id" => $item_category->category_id,
                    "name" => $name_en,
                    "description" => $description_en,
                    "locale" => 'en',
                    "deleted_flag" => 0,
                    "created_user" => 1,
                    "created_time" => date("Y-m-d H:i:s"),
                    "updated_user" => 1,
                    "updated_time" => date("Y-m-d H:i:s"),
                ]
            );

            /* Thêm danh mục (jp) cho table m_category_translation */
            $item_category_translation_jp = $categoryTranslationRepository->create(
                [
                    "category_id" => $item_category->category_id,
                    "name" => $name_jp,
                    "description" => $description_jp,
                    "locale" => 'jp',
                    "deleted_flag" => 0,
                    "created_user" => 1,
                    "created_time" => date("Y-m-d H:i:s"),
                    "updated_user" => 1,
                    "updated_time" => date("Y-m-d H:i:s"),
                ]
            );

            /* Kiểm tra trạng thái và redirect về trang danh sách danh mục*/
            if($item_category!=null && $item_category_translation_vn!=null && $item_category_translation_en!=null && $item_category_translation_jp!=null) {
                return redirect('/admin/category')->with('notify-success', 'Thêm danh mục thành công');
            } else {
                return redirect('/admin/category')->with('notify-error', 'Thêm danh mục thất bại');
            }            
        }

    }


    //view update a quiz
    public function editCategoryForm($id, CategoryRepository $categoryRepository)
    {
        $validator = Validator::make(['category_id' => $id], [
            'category_id'   => 'exists:m_category,category_id'
        ], [
            'category_id.required'      => 'Không tồn tại',
        ]);

        if ($validator->fails())
        {
            return redirect()->back();
        }
        else
        {
            $cate = $categoryRepository->find((int)$id);
            return view('Backend.category.create', ['category' => $cate]);
        }
    }

    //update a quiz
    public function updateCategory(Request $request, $id, CategoryRepository $categoryRepository,CategoryTranslationRepository $categoryTranslationRepository )
    {
        $cate = $categoryRepository->find((int)$id);
        $validator = Validator::make(
            $request->all(),
            [
                
                'sort_order' => 'required',
                'parent_id' => 'required',
                'name_vn' => 'required',
                'name_en' => 'required',
                'name_jp' => 'required',
                'description_vn' => 'required',
                'description_en' => 'required',
                'description_jp' => 'required',
            ]
            ,
            [
                
                'sort_order.required' => 'Vui lòng chọn sort_order',
                'parent_id.required' => 'Vui lòng chọn parent_id',
                'name_vn.required' => 'Vui lòng chọn name_vn',
                'name_en.required' => 'Vui lòng chọn name_en',
                'name_jp.required' => 'Vui lòng chọn name_jp',
                'description_vn.required' => 'Vui lòng chọn description_vn',
                'parent_id.description_en' => 'Vui lòng chọn description_en',
                'description_jp.required' => 'Vui lòng chọn description_jp',

            ]
        );

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else
        {
        
            //if choose new image for quiz
            if (Input::hasfile('image'))
            {
                $nameImage = Input::file('image')->getClientOriginalExtension();
                $imageURL = $id . "." . date("H_i_s",time()). ".". $nameImage;
                $oldImage = $quiz->image;
                if($oldImage != '')
                {
                    if(File::exists(public_path('upload/image/quiz/') . $oldImage))
                    {
                        unlink(public_path('upload/image/quiz/') . $oldImage);
                    }
                }
                Input::file('image')->move(public_path('upload/image/quiz/'), $imageURL);

                $quizRepository->update(
                    [
                        "image"          => $imageURL,
                    ],
                    $id,
                    "quiz_id"
                );
            }
            //if choose new sound for quiz
            if(Input::hasfile('sound'))
            {
                //sound
                $nameSound = Input::file('sound')->getClientOriginalExtension();
                $oldSound = $quiz->sound;
                if($nameSound == 'mp3')
                {
                    $soundURL = $id . "." . date("H_i_s",time()). ".". $nameSound;
                    if($oldSound != '')
                    {
                        if(File::exists(public_path('upload/audio/quiz/') . $oldSound))
                        {
                            unlink(public_path('upload/audio/quiz/').$oldSound);
                        }
                    }
                    Input::file('sound')->move(public_path('upload/audio/quiz/'), $soundURL);
                    $quizRepository->update(
                        [
                            "sound"          =>$soundURL,
                        ],
                        $id,
                        "quiz_id"
                    );
                }else
                {
                    return redirect()->back()->withErrors("Vui lòng chọn đúng kiểu âm thanh")->withInput();
                }


            }

            $code = $request->get('code');
            $parent_id = $request->get('parent_id');
            $status = $request->get('status');
            $name_vn = $request->get('name_vn');
            $name_en = $request->get('name_en');
            $name_jp = $request->get('name_jp');
            $description_vn = $request->get('description_vn');
            $description_en = $request->get('description_en');
            $description_jp = $request->get('description_jp');

            //update quiz
            $item_category = $categoryRepository->update(
                [
                    "level_id"          =>$request->get('levels'),
                    "quiz_type"         =>$request->get('types'),
                    "quiz_kbn"          =>$request->get('group'),
                    "content"           =>$request->get('question'),
                    "ans1"              =>$request->get('ansA'),
                    "ans2"              =>$request->get('ansB'),
                    "ans3"              =>$request->get('ansC'),
                    "ans4"              =>$request->get('ansD'),
                    "right_ans"         =>$request->get('rightAns'),
                    "right_ans_exp"     =>$request->get('content')
                ],
                $id,
                "category_id"
            );
           /* $item_category = $categoryRepository->update(
                [
                    
                    "sort_order" => $sort_order,
                    "parent_id" => $parent_id,
                    "image" => 'demo',
                    "image_description" => 'demo',
                    "video" => 'demo',
                    "deleted_flag" => 0,
                    "created_user" => 1,
                    "created_time" => date("Y-m-d H:i:s"),
                    "updated_user" => 1,
                    "updated_time" => date("Y-m-d H:i:s"),
                ],
                $id,
                "category_id"
            );*/

            /* Thêm danh mục (vn) cho table m_category_translation */
            $item_category_translation_vn = $categoryTranslationRepository->updateItemTranslate(
                [
                    "name"          => $name_vn,
                    "description"   => $description_vn,
                    "locale"        => 'vi',
                ],$cate->category_id,
                "category_id", 
                'vi',
                "locale"
            );

            /* Thêm danh mục (jp) cho table m_category_translation */
            $item_category_translation_en = $categoryTranslationRepository->updateItemTranslate(
                [
                    "name"         => $name_en,
                    "description"   => $description_en,
                    "locale"        => 'vi',
                ],$cate->category_id,
                "category_id", 
                'vi',
                "locale"
            );

            /* Thêm danh mục (jp) cho table m_category_translation */
            $item_category_translation_jp = $categoryTranslationRepository->updateItemTranslate(
                [
                    "name"         => $name_jp,
                    "description"   => $description_jp,
                    "locale"        => 'vi',
                ],$cate->category_id,
                "category_id", 
                'vi',
                "locale"
            );

            /* Kiểm tra trạng thái và redirect về trang danh sách danh mục*/
            if($item_category!=null && $item_category_translation_vn!=null && $item_category_translation_en!=null && $item_category_translation_jp!=null) {
                return redirect('/admin/category')->with('notify-success', 'Thêm danh mục thành công');
            } else {
                return redirect('/admin/category')->with('notify-error', 'Thêm danh mục thất bại');
            } 
        }

    }

    //detail a quiz
    public function detailQuiz($id, CategoryRepository $categoryRepository)
    {
        $validator = Validator::make(['quiz_id' => $id], [
            'quiz_id'   => 'exists:m_quiz,quiz_id'
        ], [
            'quiz_id.require'   =>'Không tồn tại câu hỏi',
        ]);

        if ($validator->fails())
        {
            return redirect()->back();
        }
        else
        {
            $quiz = $quizRepository->find((int)$id);
            return view('Backend.quizs.detail_quiz', ['quiz' => $quiz]);
        }
    }

    //destroy a quiz
    public function destroyQuiz($id, CategoryRepository $categoryRepository)
    {
        //update delete_flag
        $quizRepository->update(
            [
                "deleted_flag"          => 1,
            ],
            $id,
            "quiz_id"
        );
        return redirect()->back();
    }
}
