<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository as Categories;

class CategoryController extends Controller
{
	/**
	 * Dependency, which will be inject in constructor.
	 * 
	 * @var Categories
	 */
    protected $categories;

	/**
	 * CategoryController constructor.
	 * 
	 * @param Categories $categories
	 */
	public function __construct(Categories $categories)
	{
		$this->categories = $categories;
	}

	/**
	 * Get all categories from repository and show them.
	 * 
	 * @param Request $request
	 * @return \Illuminate\Http\Response
	 * */
	public function allCategories(Request $request)
	{
		if ($request->ajax()) {
			$categories = $this->categories->allCategoriesForAdmin($request->ordered_column, $request->direction);
//			$categories->pagination_menu = $categories->render();
			return response()->view('admin.category.table', array('categories' => $categories));
		}

		$categories = $this->categories->allCategoriesForAdmin();
//		$categories->pagination_menu = $categories->render();
		return response()->view('admin.category.all', array('categories' => $categories));
	}
	
	/**
	 * Get the form for creating a new category.
	 * 
	 * @return \Illuminate\Http\Response
	 */
	public function createCategoryView()
	{
		if(Gate::denies('createCategory', Auth::user())) {
			return redirect()->back()->with('error', 'no permission');
		}

		return response()->view('admin.category.create');
	}
	
	/**
	 * Store the new category and redirect 
	 * to the page with all categories with the notification of the result.
	 * 
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function createCategory(Request $request)
	{
		$result = $this->categories->store($request);

		if(!$result) {
			return redirect()->route('adminCategories')
				->with('error', 'Can\'t create the category. Try please later');
		}

		return redirect()->route('adminCategories')
			->with('info', 'The category was created successfully');
	}

	/**
	 * Get the category by id and show the form for editing it.
	 *
	 * @param $id
	 * @return \Illuminate\Http\Response
	 */
	public function updateCategoryView($id)
	{
		if(Gate::denies('updateCategory', Auth::user())) {
			return redirect()->back()->with('error', 'no permission');
		}

		$category = $this->categories->findById($id);
		return response()->view('admin.category.update', array('category' => $category));
	}
	
	/**
	 * Update the category and redirect to 
	 * the page with all categories with notification of result.
	 * 
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function updateCategory(Request $request)
	{
		$result = $this->categories->update($request);
		if ($result == true) {
			session()->put('info', 'category_changed');
		}
		
		return redirect()->route('adminCategories');
	}
	
	/**
	 * Delete the category and redirect to
	 * the page with all categories with notification of result.
	 * 
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function deleteCategory(Request $request)
	{
		if (!$request->ajax()) {
			abort(404);
		}

		if (Gate::denies('deleteCategory', Auth::user())) {
			return redirect()->back()->with('error', 'no permission');
			//return popup msg
		}

		$this->categories->destroyById($request->category_id);
	}


	public function toogleCategoryActive(Request $request)
	{
		if (Gate::denies('toogleCategoryActive', $request->user())) {
			abort(403);
		}
		
		if ($request->ajax()) {
			$this->categories->toogleCategoryActive($request);
		} else {
			abort(404);
		}
	}
	
	public function toogleCategorySeen(Request $request)
	{
		if (Gate::denies('toogleCategorySeen', $request->user())) {
			abort(403);
		}
		
		if ($request->ajax()) {
			$this->categories->toogleCategorySeen($request);
		} else {
			abort(404);
		}
	}
	
	
}

