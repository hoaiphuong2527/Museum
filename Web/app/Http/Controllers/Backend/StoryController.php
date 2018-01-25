<?php

namespace App\Http\Controllers\Backend;

use App\Models\MCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\CategoryTranslationRepository;
use Illuminate\Support\Facades\Validator;


class StoryController extends Controller
{
    /* Danh sách danh mục */
    public function index(Request $request, CategoryRepository $categoryRepository)
    {
        /* Mảng danh sách danh mục*/
        $list = $categoryRepository->getListCategoryWithLang('en');
        /* End */

        /* Tạo mảng kiểm tra gán tên cho danh mục 
        $category_list = $categoryRepository->getListCategoryWithLangParentID('en', 0);

        foreach ($category_list as &$row) {
            $sub = $categoryRepository->getListCategoryWithLangParentID('en', $row['category_id']);
            $row['sub'] = $sub;
            /*foreach ($row['sub'] as &$sub) {
                $sub_con = $categoryRepository->getListCategoryWithLangParentID('en', $sub['category_id']);
                $sub['sub_con'] = $sub_con;
            }
        }*/
        /* End*/
        $category_list = MCategory::where('parent_id','<>', 0)->get();
        return view('Backend.stories.index', ['list' => $list, 'category_list' => $category_list]);
    }

    public function create(CategoryRepository $categoryRepository)
    {
        /*$category_list = $categoryRepository->getListCategoryWithLangParentID('en', 0);
        foreach ($category_list as &$row) {
            $sub = $categoryRepository->getListCategoryWithLangParentID('en', $row['category_id']);
            $row['sub'] = $sub;
            /*foreach ($row['sub'] as &$sub) {
                $sub_con = $categoryRepository->getListCategoryWithLangParentID('en', $sub['category_id']);
                $sub['sub_con'] = $sub_con;
            }
        }*/
        $category_list = MCategory::where('parent_id', 0)->get();

        return view('Backend.items.create',['category_list' => $category_list]);
    }
}