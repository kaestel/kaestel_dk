<?php
/**
* @package janitor.items
* This file contains wishlist maintenance functionality
*/


class TypeWish extends Model {

	/**
	* Init, set varnames, validation rules
	*/
	function __construct() {

		// itemtype database
		$this->db = SITE_DB.".item_wish";

		$this->wish_reserved = array(0 => "Available", 1 => "Reserved");


		// Name
		$this->addToModel("name", array(
			"type" => "string",
			"label" => "Name",
			"required" => true,
			"unique" => $this->db,
			"hint_message" => "Name your wish", 
			"error_message" => "Name must be unique."
		));

		// Price
		$this->addToModel("price", array(
			"type" => "integer",
			"label" => "Price",
			"required" => true,
			"hint_message" => "Price or price range of wish", 
			"error_message" => "Price must be indicated"
		));

		// Reserved
		$this->addToModel("reserved", array(
			"type" => "select",
			"options" => $this->wish_reserved,
			"label" => "Reserved?",
			"hint_message" => "Is product reserved"
		));

		// Description
		$this->addToModel("description", array(
			"type" => "text",
			"label" => "Description",
			"hint_message" => "Write a meaningful description of the wish."
		));

		// Link
		$this->addToModel("link", array(
			"type" => "string",
			"label" => "Link",
			"hint_message" => "Link to product"
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


	// used for frontend communication
	// reserve wish
	function reserve($action) {

		if(count($action) == 2) {

			$query = new Query();
			$sql = "UPDATE ".$this->db." SET reserved = 1 WHERE item_id = ".$action[1];
			if($query->sql($sql)) {
				return true;
			}

		}
		return false;
	}

	// un-reserve wish
	function unreserve($action) {

		if(count($action) == 2) {

			$query = new Query();
			$sql = "UPDATE ".$this->db." SET reserved = 0 WHERE item_id = ".$action[1];
			if($query->sql($sql)) {
				return true;
			}

		}
		return false;
	}

}

?>