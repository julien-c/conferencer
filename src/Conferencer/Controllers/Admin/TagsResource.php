<?php
namespace Conferencer\Controllers\Admin;

use DB;

class TagsResource extends BaseResource
{

	/**
	 * Delete a Tag and its associations from all Talks
	 */
	public function destroy($id)
	{
		DB::table('tag_talk')->where('tag_id', $id)->delete();

		return parent::destroy($id);
	}

}
