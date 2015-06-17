<?php
class FusionChart {
	/*
	Class for a FusionChart object which can be JSON printed into the correct format for use of Post Requests by Javascript or for printing on a PHP page. JSON printed with: echo json_encode($fusionchart_object, JSON_PRETTY_PRINT);
	 */

	private $data, $series, $unique_series, $unique_categories, $user_categories, $chart_attributes; //The private options that we don't need to print out

	public static $defaults = array(
		'user_categories' => array(),
		'data' => array(), //Should be an associative array of the series and it's related data
		'unique_series' => true,
		'unique_categories' => true,
		'chart_attributes' => array()
	);

	private static $fusionchart_defaults = array(
		'chart' => array(),
		'categories' => array(array('category' => array())),
		'dataset' => array()
	);

	public function __construct(array $args = array()) {
		/*
		(Array) -> Null
		Constructs the FusionChart Object with the user's options and provided data
		 */
		$defaults = self::$defaults;
		$args = array_merge($defaults, $args);

		//Construct the object properities
		$this->user_categories = (is_array($args['user_categories'])) ? $args['user_categories'] : array();
		$this->data = (is_array($args['data'])) ? $args['data'] : array();
		$this->unique_series = (is_bool($args['unique_series'])) ? $args['unique_series'] : false;
		$this->unique_categories = (is_bool($args['unique_categories'])) ? $args['unique_categories'] : false;
		$this->chart_attributes = (is_array($args['chart_attributes'])) ? $args['chart_options'] : array();

		//Assign the basic FusionChart properties
		$fusionchart_defaults = self::$fusionchart_defaults;
		$this->dataset = $fusionchart_defaults['dataset'];
		$this->categories = $fusionchart_defaults['categories'];

		//Constructs the basic properities that need to be printed out of the FusionChart object
		$this->resolve_chart_attributes();
		$this->resolve_categories();
		$this->resolve_data();		
	}

	public function resolve_chart_attributes() {
		/*
		(Null) -> Null
		Attempts to set all the provided chart attributes
		 */
		foreach ($this->chart_attributes as $attribute_name => $attribute_val) {
			$this->chart[$attribute_name] = $attribute_val;
		}
	}

	public function resolve_data() {
		/*
		(Null) -> Null
		Attempts to construct the dataset field of the FusionChart object using the user provided data
		 */
		foreach ($this->data as $series_name => $data_array) {
			$key = $this->__search_series($series_name);
			if (is_null($key)) {
				//The seriesname doesn't exist yet, append it appropiately
				$this->dataset[] = array('seriesname' => $series_name, 'data' => array());
				$key = count($this->dataset) - 1;
			}
			//The key should now be numeric, if it is not, raise an error, but deal with error handling later for now
			foreach ($data_array as $key_x=>$val) {
				$this->dataset[$key]['data'][] = array(
					'value' => $val
				);
			}
		}
	}

	public function resolve_categories() {
		/*
		(Null) -> Null
		Attempts to construct the categories field for the FusionChart object using the user provided data
		 */
		foreach ($this->user_categories as $key=>$val) {
			if ($this->unique_categories) {
				if ($this->__search_categories($val)) {
					continue;
				}
				else {
					//The cateogory is not inside the object, insert it
					$this->categories[0]['category'][] = array('label' => $val);
				}
			}
			else {
				$this->categories[0]['category'] = array('label' => $val);
			}
		}		
	}

	private function __search_categories($search) {
		/*
		(Null) -> Bool
		Attempts to search if the specified category is already inside the object
		 */
		foreach ($this->categories[0]['category'] as $key=>$val) {
			if ($val['label'] == $search) {
				return true;
			}
		}
		return false;		
	}

	private function __search_series($search) {
		/*
		Attempts to search for if a series is already present, if it is, it returns the key, if it doesn't it returns null
		 */
		foreach ($this->dataset as $key=>$val) {
			if ($val['seriesname'] == $search) {
				return $key;
			}
		}
		return null;
	}
}
?>