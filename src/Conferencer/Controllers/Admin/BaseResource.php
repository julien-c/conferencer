<?php
namespace Conferencer\Controllers\Admin;

use App;
use BaseController;
use Eloquent;
use Former;
use Input;
use Redirect;
use Request;
use Response;
use Str;
use Validator;
use View;

/**
 * An abstract resource with precreated Restful interactions
 */
abstract class BaseResource extends BaseController
{

	/**
	 * The resource's namespace
	 *
	 * @var string
	 */
	protected $namespace;

	/**
	 * The resource's model
	 *
	 * @var string
	 */
	protected $model;

	/**
	 * An instance of the resource's model
	 *
	 * @var Eloquent
	 */
	protected $object;

	/**
	 * A list of relations to Eager load on the models
	 *
	 * @var array
	 */
	protected $relations = array();

	////////////////////////////////////////////////////////////////////
	///////////////////////////// CONSTRUCTORS /////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Set up parameters
	 */
	public function __construct()
	{
		// Fetch the actual name of the Resource
		$class = preg_replace('/Conferencer\\\Controllers\\\Admin\\\(.+)Resource/', '$1', get_called_class());

		// Set up parameters
		$this->namespace = strtolower($class);
		$this->model     = ucfirst(Str::singular($this->namespace));
		$this->object    = new $this->model;

		// Set up filters
		$this->beforeFilter('auth');
	}

	////////////////////////////////////////////////////////////////////
	/////////////////////////// RESOURCE METHODS ///////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$columns = array('name');
		$items = $this->object->with($this->relations)->get();
		$view = View::exists('admin.' .$this->namespace. '.index')
			? 'admin.' .$this->namespace. '.index'
			: 'conferencer::partials.admin.index';

		// Fetch columns to display
		if (isset($items[0])) {
			$exclude = array_merge($this->relations, array(
				'id', 'slug', 'image', 'youtube', 'links', 'youtube_views', 'flickr', 'user_id', 'created_at', 'updated_at'));

			$columns = array_keys($items[0]->getAttributes());
			$columns = array_diff($columns, $exclude);

			// Add eager loading to items
			foreach ($columns as $column) {
				if (Str::contains($column,'_id')) {
					$column = str_replace('_id', null, $column);
					if (method_exists($items[0], $column)) {
						$items->load($column);
					}
				}
			}
		}

		return View::make($view)
			->with('columns', $columns)
			->with('namespace', $this->namespace)
			->with('items', $items);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$item = $this->object->with($this->relations)->where('id', $id)->firstOrFail();

		// Return JSON of the model
		if (Request::ajax()) return $item;

		if (!View::exists('admin.'.$this->namespace.'.show')) {
			return $item;
		}

		return View::make('conferencer::admin.'.$this->namespace.'.show')
			->with('item', $item);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		Former::withRules($this->getRules());

		return View::make('conferencer::admin.' .$this->namespace. '.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		Eloquent::unguard();
		$attributes = $this->getInput();
		$attributes = $this->uploadFiles($attributes);

		// Validate input
		$validator = Validator::make($attributes, $this->getRules());
		if ($validator->fails()) {
			return Redirect::route('admin.'.$this->namespace.'.create')
				->withInput()
				->withErrors($validator);
		}

		$model = $this->object->create($attributes)->touch();

		return $this->redirectIndex();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$item = $this->object->with($this->relations)->where('id', $id)->firstOrFail();

		Former::populate($item);

		return View::make('conferencer::admin.' .$this->namespace. '.create')
			->with('item', $item);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$attributes = $this->getInput();
		$attributes = $this->uploadFiles($attributes);

		// Validate input
		$validator = Validator::make($attributes, $this->getRules());
		if ($validator->fails()) {
			return Redirect::route('admin.'.$this->namespace.'.edit', $id)
				->withInput()
				->withErrors($validator);
		}

		$this->object->where('id', $id)->update($attributes);

		return $this->redirectIndex();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->object->destroy($id);

		return $this->redirectIndex();
	}

	////////////////////////////////////////////////////////////////////
	////////////////////////////// HELPERS /////////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Get the Model's rules
	 *
	 * @return array
	 */
	protected function getRules()
	{
		$model = $this->model;

		return $model::$rules;
	}

	/**
	 * Get available input
	 *
	 * @return array
	 */
	protected function getInput()
	{
		$relations = array_map('Str::singular', $this->relations);
		$fields    = array_merge($relations, array('_method', '_wysihtml5_mode'));

		return Input::except($fields);
	}

	/**
	 * Upload any available files
	 *
	 * @param  array  $attributes
	 *
	 * @return array $attributes
	 */
	protected function uploadFiles(array $attributes)
	{
		if (Input::hasFile('image')) {
			$image     = Input::file('image');
			$hash      = md5_file($image->getPathname());
			$extension = $image->getClientOriginalExtension();

			// Move uploaded file
			$model = $this->model;
			$filename  = Str::slug(Input::get('name')). '-' .$hash.'.'.$extension;
			$folder    = App::make('path.public').'/' .$model::$images;
			$image->move($folder, $filename);

			// Replace input of the FILE by the filename
			$attributes['image'] = $filename;
		}

		return $attributes;
	}

	/**
	 * Redirect to the Resource's index
	 *
	 * @param  array  $data         Additional data to pass
	 *
	 * @return Redirect
	 */
	protected function redirectIndex($data = array())
	{
		if (Request::ajax()) {
			return Response::json(array('status' => 200));
		}

		return Redirect::route('admin.' .$this->namespace. '.index', $data);
	}

}
