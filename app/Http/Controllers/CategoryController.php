<?php

/**
 * This file implements Category Controller.
 * PHP version 7.2
 *
 * @category Class
 * @package  CategoryController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */

namespace App\Http\Controllers;

use App\Category;
use App\DataTables\CategoryDataTable;
use App\Events\LogActivity;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ImageRequest;
use Illuminate\Http\Request;

/**
 * Controls the data flow into a category object and
 *  updates the view whenever data changes.
 *
 * @category Class
 * @package  CategoryController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */
class CategoryController extends Controller
{

    /**
     * Constructs a new instance Middleware Applied
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Categories debatable give access to management.
     *
     * @param CategoryDataTable $dataTable
     *
     * @return \Illuminate\View\View
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('management.categories.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Category::class);
        return view('entries.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CategoryRequest $request The request
     *
     * @return \Illuminate\Http\JsonResponse.
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($this->_validCategory($request));
        event(
            new LogActivity(
                $category->name,
                __('Data saved successfully'),
                __('Category')
            )
        );
        return response()->json(
            ['message' => __('Data saved successfully')]
        );
    }

    /**
     * Display the specified resource
     *
     * @param \App\Category $category The category
     *
     * @return \Illuminate\View\View
     */
    public function show(Category $category)
    {
        $this->authorize('manage', Category::class);
        return view('management.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource
     *
     * @param \App\Category $category The category
     *
     * @return \Illuminate\View\View
     */
    public function edit(Category $category)
    {
        $this->authorize('create', Category::class);
        return view('management.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage,
     *
     * @param CategoryRequest $request  The request
     * @param Category        $category The category
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $this->authorize('manage', Category::class);
        $category->update($this->_validCategory($request));
        event(
            new LogActivity(
                $category->name,
                __('Data updated successfully'),
                __('Category')
            )
        );
        return response()->json(
            ['message' => __('Data updated successfully')],
            200
        );
    }

    /**
     * Destroys the given category Check $category has sub categories
     *
     * @param \App\Category $category The category
     *
     * @return \Illuminate\Http\RedirectResponse.
     */
    public function destroy(Category $category)
    {
        $this->authorize('manage', Category::class);
        if ($category->subcategories->count() > 0 || $category->products->count() > 0) {
            return back()->with('warning', __('Category has subcategories or products !'));
        }
        $this->checkLogoExistence($category->image);
        event(
            new LogActivity(
                $category->name,
                __('Data removed successfully'),
                __('Category')
            )
        );
        $category->delete();
        return redirect(route('category.index'))
            ->with('info', __('Data removed successfully'));
    }

    /**
     * $category Image
     *
     * @param ReqImageRequest $request The request
     *
     * @return \Illuminate\Http\RedirectResponse.
     */
    public function image(ImageRequest $request)
    {
        $category = Category::find($request->category_id);
        $this->checkLogoExistence($category->image);
        $image = $request->image->store('uploads/category', 'public');
        $category->update(['image' => $image]);
        event(
            new LogActivity(
                $category->name,
                __('Uploaded & saved successfully'),
                __('Category')
            )
        );
        return back()->with('success', __('Uploaded & saved successfully'));
    }

    /**
     * Validate category
     *
     * @param mixed $request The request
     *
     * @return array
     */
    private function _validCategory($request)
    {
        return [
            'name' => $request->name,
            'code' => $this->generateCode($request),
            'detail' => $request->detail,
        ];
    }
}
