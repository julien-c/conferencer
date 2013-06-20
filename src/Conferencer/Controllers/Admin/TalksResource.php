<?php
namespace Conferencer\Controllers\Admin;

use Response;
use Speaker;
use Str;
use Talk;

class TalksResource extends BaseResource
{

	/**
	 * A list of relations to Eager load on the models
	 *
	 * @var array
	 */
	protected $relations = array('speakers', 'tags');

	/**
	 * Add a Speaker to the Talk
	 *
	 * @param integer $talk    The Talk id
	 * @param integer $speaker The Speaker id
	 *
	 * @return  string The Speaker JSON
	 */
	public function addSpeaker($talk, $speaker)
	{
		return $this->addRelated('speaker', $talk, $speaker);
	}

	/**
	 * Add a Tag to the Talk
	 *
	 * @param integer $talk  The Talk id
	 * @param integer $tag   The Tag id
	 *
	 * @return  string The Tag JSON
	 */
	public function addTag($talk, $tag)
	{
		return $this->addRelated('tag', $talk, $tag);
	}

	/**
	 * Remove a Tag from a Talk
	 *
	 * @param  integer $talk The Talk id
	 * @param  integer $tag  The Tag id
	 */
	public function removeTag($talk, $tag)
	{
		return $this->removeRelated('tag', $talk, $tag);
	}

	/**
	 * Remove a Speaker from a Talk
	 *
	 * @param integer $talk    The Talk id
	 * @param integer $speaker The Speaker id
	 */
	public function removeSpeaker($talk, $speaker)
	{
		return $this->removeRelated('speaker', $talk, $speaker);
	}

	////////////////////////////////////////////////////////////////////
	/////////////////////////////// HELPERS ////////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Add a related model from an HasMany relationship
	 *
	 * @param  string  $modelName   The related model's name
	 * @param  integer $talk        The Talk id
	 * @param  integer $modelKey    The model id
	 */
	protected function addRelated($modelName, $talk, $modelKey)
	{
		$model    = ucfirst($modelName);
		$relation = Str::plural($modelName);

		$talk  = Talk::findOrFail($talk);
		$model = $model::findOrFail($modelKey);

		// If the model isn't already on this Talk
		$related = $talk->$relation->all();
		$related = array_pluck($related, 'id');
		if (in_array((string) $model->id, $related)) {
			return Response::json(array('status' => 503));
		}

		// Add model to talk
		$talk->$relation()->attach($model->id);

		return Response::json(array(
			'status' => 200,
			'model'  => $model->toArray()
		));
	}

	/**
	 * Remove a related model from an HasMany relationship
	 *
	 * @param  string  $modelName   The related model's name
	 * @param  integer $talk        The Talk id
	 * @param  integer $modelKey    The model id
	 */
	protected function removeRelated($modelName, $talk, $modelKey)
	{
		$model = Str::plural($modelName);

		$talk = Talk::findOrFail($talk);
		$talk->$model()->detach($modelKey);

		return Response::json(array('status' => 200));
	}

}
