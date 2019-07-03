<?php

namespace Uzaweb\Openexam\Models;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
	protected $table = 'openexam_dashboard';
	
	protected $revisionEnabled = false;
	protected $revisionCleanup = true; //Remove old revisions (works only when used with $historyLimit)
	protected $historyLimit = 500; //Maintain a maximum of 500 changes at any point of time, while cleaning up old revisions.
	protected $revisionCreationsEnabled = true;
	/*protected $keepRevisionOf = array(
			'content_html'
	);*/
	protected $revisionFormattedFields = [
			'title' => 'string:<strong>%s</strong>',
			'detail' => 'string:<strong>%s</strong>',
			'modified' => 'datetime:m/d/Y g:i A',
			'deleted_at' => 'isEmpty:Active|Deleted',
	];
	
	public static function boot()
	{
		parent::boot();
	}
	
	//TODO Create other Eloquent Relationships https://hackernoon.com/eloquent-relationships-cheat-sheet-5155498c209
}
