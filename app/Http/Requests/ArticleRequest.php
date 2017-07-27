<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

//use App\Models\Post;

class ArticleRequest extends FormRequest {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
//		$id = $this->blog ? ',' . $this->blog : '';
		return [
			'title' => 'required|max:255',
			'preview' => 'required|max:65000',
			'text' => 'required|max:65000',
			'categories' => 'required'
		];
	}

}