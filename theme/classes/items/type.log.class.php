<?php
/**
* @package janitor.items
* This file contains item type functionality
*/

class TypeLog extends Itemtype {


	public $db;


	/**
	* Init, set varnames, validation rules
	*/
	function __construct() {

		parent::__construct(get_class());


		// itemtype database
		$this->db = SITE_DB.".item_log";


		// Published
		$this->addToModel("published_at", array(
			"type" => "datetime",
			"label" => "Publishing time (yyyy-mm-dd hh:mm)",
			"hint_message" => "Date of the log entry (yyyy-mm-dd hh:mm). Leave empty for current time.", 
			"error_message" => "Date of the log entry must be a valid date (yyyy-mm-dd hh:mm). Leave empty for current time.", 
		));

		// Name
		$this->addToModel("name", array(
			"type" => "string",
			"label" => "Name",
			"required" => true,
			"hint_message" => "Name your log entry.", 
			"error_message" => "Name must be filled out."
		));

		// description
		$this->addToModel("description", array(
			"type" => "text",
			"label" => "Short SEO description",
			"max" => 155,
			"hint_message" => "Write a short description of the log entry for SEO and listings.",
			"error_message" => "Your log entry needs a description – max 155 characters."
		));

		// HTML
		$this->addToModel("html", array(
			"type" => "html",
			"label" => "HTML",
			"required" => true,
			"allowed_tags" => "p,h3,h4,download",
			"hint_message" => "Write the log entry.",
			"error_message" => "A log without any words? How weird."
		));


		// Location
		$this->addToModel("location", array(
			"type" => "string",
			"label" => "Location",
			"required" => true,
			"hint_message" => "Name and Geo coordinates of location.",
			"error_message" => "Name and Geo coordinates must be filled out."
		));
		// latitude
		$this->addToModel("latitude", array(
			"type" => "number",
			"label" => "Latitude",
			"hint_message" => "Latitude of location.", 
			"error_message" => "Latitude of location."
		));
		// longitude
		$this->addToModel("longitude", array(
			"type" => "number",
			"label" => "Longitude",
			"hint_message" => "Longitude of location.", 
			"error_message" => "Longitude of location."
		));

		// Mediae
		$this->addToModel("mediae", array(
			"type" => "files",
			"label" => "Drag image here",
			"allowed_formats" => "png,jpg",
			"max" => 20,
			"hint_message" => "Add image here. Use png or jpg in any proportion.",
			"error_message" => "Media does not fit requirements.",
		));

	}

}

?>