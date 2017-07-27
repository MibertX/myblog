<?php
namespace App\Repositories\Admin;

use App\Models\Category;
use App\Repositories\CategoryRepository as BaseRepository;
use Illuminate\Support\Facades\DB;


class CategoryRepository extends BaseRepository
{
	/**
	 * Path to each file of translation.
	 * It is necessary to save, update and delete translation of the categories.
	 *
	 * @var string
	 */
	protected $ru_locale_path = '../resources/lang/ru/categories.php';
	protected $en_locale_path = '../resources/lang/en/categories.php';


	/**
	 * CategoryRepository constructor.
	 * @param Category $category
	 */
	public function __construct(Category $category)
	{
		parent::__construct($category);
	}


	/**
	 * First of all, will be created the valid name of category
	 *  (this name will be saved into DB and will be used as a key of translation).
	 *
	 * After that, all translation will be saved in appropriate language files.
	 *
	 * No need to store the category into DB without translation,
	 *  so if translation's saving in file failed - category won't be stored (return false).
	 *
	 * @param $data
	 * @param null $category
	 * @return bool
	 */
	public function store($data, $category = null)
	{
		if (!$category) {
			$this->model->name = $this->makeValidName($data->name_en);
		} else{
			$this->model = $category;
		}

		$en = $this->saveLocalization('en', $data->name_en);
		$ru = $this->saveLocalization('ru', $data->name_ru);

		if (!$ru or !$en) {
			return false;
		}

		$this->model->save();
		return true;
	}


	/**
	 * After finding the category by id, create the new valid name(enetered by user)
	 *  of category that is being edited.
	 * If they are the same - no need to update the category (return false).
	 *
	 * If the names are not the same - delete the previous translation
	 *  and store the category with new translation.
	 *
	 * @param $data
	 * @return bool
	 */
	public function update($data)
	{
		$category = $this->findById($data->id);
		$updated_name = $this->makeValidName($data->name_en);

		if ($category->name == $updated_name) {
			return false;
		}

		$this->deleteLocalization('ru', $category->name);
		$this->deleteLocalization('en', $category->name);
		$category->name = $updated_name;
		return $this->store($data, $category);
	}


	/**
	 * Delete the category from DB.
	 * If deleting was successful - also delete the translations
	 *  (actually there is no nedd to delete them, and it won't be any error if
	 *  deleting will be failed, but it will be better to keep language files clean).
	 *
	 * @param $id
	 * @return bool
	 */
	public function destroyById($id)
	{
		$category = $this->findById($id);
		$result = parent::destroyById($id);

		if (!$result) {
			return false;
		}

		$this->deleteLocalization('en', $category->name);
		$this->deleteLocalization('ru', $category->name);
		return true;
	}


	public function categoriesByPostId($id)
	{
		
		return DB::table('post_category')->select('category_id')->where('post_id', '=', $id)->get();
	}

	/**
	 * Making the valid name of category, to save it into DB
	 *  and use as a key in language files.
	 *
	 * Remove spaces from both sides of the name,
	 *  then make it in lowercase and
	 *  replace all other spaces with '_'.
	 *
	 * @param $name
	 * @return mixed
	 */
	protected function makeValidName($name)
	{
		$category = mb_strtolower(trim($name));
		$valid_category = str_replace(' ', '_', $category);
		return $valid_category;
	}


	/**
	 * Save the translation of word in selected $language.
	 * The key for translation array is current name of model.
	 *
	 * First of all - get the translation file as array,
	 *  then delete last element(which is the closing square bracket).
	 *
	 * After that add the new transltaion of word in the end of array,
	 *  then add closing square bracket in new string.
	 *
	 * Finally, 'implode' array and resave it into the file.
	 *
	 * @param $language
	 * @param $translation
	 * @return bool
	 */
	protected function saveLocalization($language, $translation)
	{
		$file_path = $this->localizationFilePath($language);
		$file = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

		if (!$file) {
			return false;
		}
		
		unset($file[count($file) - 1]);
		$file[] = "\t" . '\'' . $this->model->name . '\'' . '=>' . '\'' . $translation . '\',';
		$file[] = '];';
		$new_file = implode("\n", $file);
		
		file_put_contents($file_path, $new_file);

		return true;
	}


	/**
	 * Delete the translation of word ($key) in selected $language.
	 *
	 * First of all - read the file into an array.
	 * Each element of this array will be a string as 'key' => 'value'.
	 *
	 * We need to find only 'key' in this string, so we will use circle 'for' for it
	 *  (we have to skip first two elements - '<?php' and 'return [',
	 *  for the situation when the $key will have one of this values,
	 * 	so circle 'for' is more preferable than 'foreach').
	 *
	 * @param $language
	 * @param $key
	 * @return bool|int
	 */
	protected function deleteLocalization($language, $key)
	{
		$file_path = $this->localizationFilePath($language);
		$file = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

		if(!$file) {
			return false;
		}

		for($i = 2; $i < count($file); $i++) {
			$arrow = strpos($file[$i], '=>');
			$array_key = substr($file[$i], 0, $arrow);
			if ('\'' . $key . '\'' == trim($array_key)) {
				unset($file[$i]);
				break;
			}
		}

		$new_file = implode("\n", $file);
		return file_put_contents($file_path, $new_file);
	}


	/**
	 * Switch case construction for determination path to the $language file
	 *
	 * @param $language
	 * @return bool|string
	 */
	protected function localizationFilePath($language)
	{
		switch ($language) {
			case ('ru'): return $this->ru_locale_path;
			case ('en'): return $this->en_locale_path;
			default:return false;
		}
	}
}