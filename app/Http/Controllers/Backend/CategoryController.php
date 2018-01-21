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
                'slug' => 'required',
                'sort_order' => 'required',
                'parent_id' => 'required',
                'name_vn' => 'required',
                'name_en' => 'required',
                'name_jp' => 'required',
//                'image' => 'sometimes|image|max:4096',
//                'sound' => 'sometimes|max:4096',
                'description_vn' => 'required',
                'description_en' => 'required',
                'description_jp' => 'required',
            ]
            ,
            [
                'slug.required' => 'Vui lòng chọn slug',
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
                    "slug" => $slug,
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
    public function editQuizForm($id, CategoryRepository $categoryRepository)
    {
        $validator = Validator::make(['quiz_id' => $id], [
            'quiz_id'   => 'exists:m_quiz,quiz_id'
        ], [
            'quiz_id.required'      => 'Không tồn tại câu hỏi',
        ]);

        if ($validator->fails())
        {
            return redirect()->back();
        }
        else
        {
            $user = $userRepository->find((int)$id);
            return view('Backend.quizs.edit_quiz', ['quiz' => $quiz]);
        }
    }

    //update a quiz
    public function updateQuiz(Request $request, $id, CategoryRepository $categoryRepository)
    {
        $quiz = $quizRepository->find((int)$id);
        $validator = Validator::make($request->all(), [
            'levels'    =>'required',
            'types'     =>'required',
            'group'     =>'required',
            'question'  =>'required|max:1000',
            'ansA'      =>'required|max:255',
            'ansB'      =>'required|max:255',
            'ansC'      =>'sometimes|max:255',
            'ansD'      =>'sometimes|max:255',
            'rightAns'  =>'required',
            'content'   =>'sometimes|max:1000',
            'image'     =>'sometimes|image|max:4096',
            'sound'     =>'sometimes|max:4096',
        ],
            [
                'levels.required'   => 'Vui lòng chọn trình độ cho câu hỏi.',
                'types.required'    => 'Vui lòng chọn loại cho câu hỏi.',
                'group.required'    => 'Vui lòng chọn nhóm cho câu hỏi.',
                'question.required' => 'Vui lòng nhập nội dung câu hỏi.',
                'question.max'      => 'Câu hỏi tối đa có 1000 ký tự.',
                'ansA.required'     => 'Vui lòng nhập nội dung câu trả lời.',
                'ansA.max'          => 'Câu hỏi tối đa có 255 ký tự.',
                'ansB.required'     => 'Vui lòng nhập nội dung câu trả lời.',
                'ansB.max'          => 'Câu hỏi tối đa có 255 ký tự.',
                'ansC.max'          => 'Câu hỏi tối đa có 255 ký tự.',
                'ansD.max'          => 'Câu hỏi tối đa có 255 ký tự.',
                'rightAns.required' => 'Vui lòng chọn câu trả lời đúng.',
                'content.max'       => 'Lời giải thích câu trả lời đúng tối đa có 1000 ký tự.',
                'image.max'         => 'Hình ảnh chọn phải nhỏ hơn 4MB.',
                'image.image'       => 'Vui lòng chọn hình ảnh cho câu hỏi',
                'image.uploaded'    => 'Vui lòng chọn đúng kiểu hình ảnh.',
                'sound.uploaded'    => 'Vui lòng chọn đúng kiểu âm thanh.',
                'sound.max'         => 'Âm thanh chọn phải nhỏ hơn 4MB',
                'sound.mimes'       => 'Vui lòng chọn đúng kiểu âm thanh.',


            ]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else
        {
            //if check delete image
            if($request->input('delete_image'))
            {
                // find quiz by id
                $imageURL = $quiz->image;
                //unlink image in folder image
                if(File::exists(public_path('upload/image/quiz/') . $imageURL))
                {
                    unlink(public_path('upload/image/quiz/') . $imageURL);
                }
                // update url of image in database
                $quizRepository->update(
                    [
                        "image"          => "",
                    ],
                    $id,
                    "quiz_id"
                );
            }

            // if check detele sound
            if($request->input('delete_sound'))
            {
                //find quiz by id
                $soundURL = $quiz->sound;
                //unlink sound in folder auido
                if(File::exists(public_path('upload/audio/quiz/') . $soundURL))
                {
                    unlink(public_path('upload/audio/quiz/').$soundURL);
                }
                //update usl of sound in db
                $quizRepository->update(
                    [
                        "sound"          => "",
                    ],
                    $id,
                    "quiz_id"
                );
            }
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
            //
            if(($request->get('ansC') == '' && $request->get('rightAns') == 3) || ($request->get('ansD')== '' && $request->get('rightAns') == 4))
            {
                return redirect()->back()->withErrors(['quiz' => "Vui lòng chọn đúng đáp án cho câu hỏi."])->withInput();
            }
            //
            //update quiz
            $quizRepository->update(
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
                "quiz_id"
            );
            return redirect('quizs');
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
