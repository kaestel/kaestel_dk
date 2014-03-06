<?php
/**
* @package janitor.items
* This file contains item frontpage text maintenance functionality
*/

/**
* TypeCategory
*/
class TypeWishlist extends Model {

	/**
	* Init, set varnames, validation rules
	*/
	function __construct() {

		$this->db = SITE_DB.".item_wishlist";

		// Name
		$this->addToModel("name", array(
			"type" => "string",
			"label" => "Name",
			"required" => true,
			"unique" => $this->db,
			"hint_message" => "Name of the category", 
			"error_message" => "Category name must be unique"
		));

		// Class
		$this->addToModel("class", array(
			"type" => "string",
			"label" => "CSS Class for category",
			"hint_message" => "If you don't know what this is, just leave it empty"
		));

		// Tags
		$this->addToModel("tags", array(
			"type" => "tags",
			"label" => "Add tag",
			"hint_message" => "Start typing to get suggestions"
		));

		parent::__construct();
	}



	function updateOrder($action) {

		if(count($action) > 1) {

			$query = new Query();

			// delete all to avoid leftovers
//			$query->sql("SELECT * FROM ".$this->db_slides." WHERE page_id = ".$action[1]);

			for($i = 1; $i < count($action); $i++) {
				$item_id = $action[$i];
				$query->sql("UPDATE ".$this->db." SET position = ".($i)." WHERE item_id = ".$item_id);
			}

			message()->addMessage("Wishlist order updated");
			return true;
		}

		message()->addMessage("Wishlist order could not be updated - refresh your browser", array("type" => "error"));
		return false;

	}



}

?>