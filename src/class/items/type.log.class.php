<?php
/**
* @package janitor.items
* This file contains Log maintenance functionality
*/


class TypeLog extends Model {

	/**
	* Init, set varnames, validation rules
	*/
	function __construct() {

		// itemtype database
		$this->db = SITE_DB.".item_log";


		// Published
		$this->addToModel("published_at", array(
			"type" => "datetime",
			"label" => "Publish date (yyyy-mm-dd hh:mm:ss)",
			"pattern" => "^[\d]{4}-[\d]{2}-[\d]{2}[0-9\-\/ \:]*$",
			"hint_message" => "Date of the log entry. Leave empty for current time", 
			"error_message" => "Date must be of format (yyyy-mm-dd hh:mm:ss)"
		));

		// Name
		$this->addToModel("name", array(
			"type" => "string",
			"label" => "Name",
			"required" => true,
			"hint_message" => "Name your log entry", 
			"error_message" => "Name must be filled out."
		));

		// HTML
		$this->addToModel("html", array(
			"type" => "text",
			"label" => "HTML",
			"required" => true,
			"hint_message" => "Write the log entry",
			"error_message" => "A log without any words? How weird."
		));


		// Location
		$this->addToModel("location", array(
			"type" => "string",
			"label" => "Location",
			"required" => true,
			"hint_message" => "Name and Geo coordinates of location",
			"error_message" => "Name and Geo coordinates must be filled out"
		));
		// latitude
		$this->addToModel("latitude", array(
			"type" => "number",
			"label" => "Latitude"
		));
		// longitude
		$this->addToModel("longitude", array(
			"type" => "number",
			"label" => "Longitude"
		));

		// Files
		$this->addToModel("files", array(
			"type" => "files",
			"label" => "Drag image here to add",
			"allowed_formats" => "png,jpg",
			"hint_message" => "Add image here. Use png or jpg in any proportion.",
			"error_message" => "File does not fit requirements."
		));


		// Tags
		$this->addToModel("tags", array(
			"type" => "tags",
			"label" => "Tag",
			"hint_message" => "Start typing to get suggestions. A correct tag has this format: context:value.",
			"error_message" => "Must be correct Tag format."
		));


		parent::__construct();
	}

}

?>