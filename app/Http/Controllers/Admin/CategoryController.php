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
			return response()->view('admin.category.table', array('categories' => $categories));
		}

		$categories = $this->categories->allCategoriesForAdmin();
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
			abort(403);
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
			return redirect()
				->route('adminCategories')
				->with('error', 'Can\'t create the category. Try please later');
		}

		return redirect()
			->route('adminCategories')
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
			abort(403);
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
		if (Gate::denies('deleteCategory', Auth::user())) {
			abort(403);
		}

		$this->categories->destroyById($request->category_id);

		return response()->view('partials.message_partial', ['type' => 'error', 'message' => 'category was deleted']);
	}

	/**
	 * Toogle category active value (true or false).
	 * This action can be done only with ajax, if not - show 404 page.
	 *
	 * @param Request $request
	 */
	public function toogleCategoryActive(Request $request)
	{
		if (!$request->ajax()) {
			abort(404);
		}

		if (Gate::denies('toogleCategoryActive', $request->user())) {
			abort(403);
		}

		$this->categories->toogleCategoryActive($request);
	}

	/**
	 * Toogle category seen value (true or false).
	 * This action can be done only with ajax. If not - show 404 page.
	 *
	 * @param Request $request
	 */
	public function toogleCategorySeen(Request $request)
	{
		if (!$request->ajax()) {
			abort(404);
		}

		if (Gate::denies('toogleCategorySeen', $request->user())) {
			abort(403);
		}

		$this->categories->toogleCategorySeen($request);
	}
}

