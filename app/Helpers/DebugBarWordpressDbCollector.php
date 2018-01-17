<?php namespace App\Helpers;
use DebugBar\DataCollector\AssetProvider;
use DebugBar\DataCollector\DataCollector;
use DebugBar\DataCollector\Renderable;
use DebugBar\DebugBarException;
use DebugBar;
class DebugBarWordpressDbCollector extends DataCollector implements Renderable, AssetProvider
{
	protected $wpdb;

	public function __construct()
	{

		global $wpdb;
		$this->wpdb = $wpdb;
	}

	public function collect()
	{
		$queries = array();
		$totalExecTime = 0;


		if(count($this->wpdb->queries)){
			foreach ($this->wpdb->queries as $q) {
				list($query, $duration, $caller) = $q;
				$queries[] = array(
					'sql' => $query,
					'duration' => $duration,
					'duration_str' => $this->getDataFormatter()->formatVar($duration)
				);
				$totalExecTime += $duration;
			}

			return array(
				'nb_statements' => count($queries),
				'accumulated_duration' => $totalExecTime,
				'accumulated_duration_str' => $this->getDataFormatter()->formatVar($totalExecTime),
				'statements' => $queries
			);
		}

	}

	public function getName()
	{
		return 'wpdb';
	}

	public function getWidgets()
	{
		return array(
			"WP Queries" => array(
				"icon" => "arrow-right",
				"widget" => "PhpDebugBar.Widgets.SQLQueriesWidget",
				"map" => "wpdb",
				"default" => "[]"
			),
			"WP Queries:badge" => array(
				"map" => "wpdb.nb_statements",
				"default" => 0
			)
		);
	}

	public function getAssets()
	{
		return array(
			'css' => 'widgets/sqlqueries/widget.css',
			'js' => 'widgets/sqlqueries/widget.js'
		);
	}
}