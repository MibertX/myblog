<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\CategoryRepository as Categories;

class CategoryController extends Controller
{
	/**
	 * Dependency, which will be inject in constructor
	 * @var Categories
	 */
    protected $categories;


	/**
	 * CategoryController constructor.
	 * @param Categories $categories
	 */
	public function __construct(Categories $categories)
	{
		$this->categories = $categories;
	}


	/**
	 * Get all categories from repository and show them.
	 * @return \Illuminate\Http\Response
	 * */
	public function getAll()
	{
		$categories = $this->categories->allCategories();
		return response()->view('admin.category.all', array('categories' => $categories));
	}


	/**
	 * Get the form for creating a new category.
	 * @return \Illuminate\Http\Response
	 */
	public function getCreateView()
	{
		return response()->view('admin.category.create');
	}

	
	/**
	 * Store the new category and redirect 
	 * to the page with all categories with the notification of the result.
	 * 
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postCreate(Request $request)
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
	public function getUpdateView($id)
	{
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
	public function postUpdate(Request $request)
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
	public function postDelete(Request $request)
	{
		$this->categories->destroyById($request->category_id);
		return redirect()->route('adminCategories')
			->with('info', 'The category was deleted successfully');
	}
}

