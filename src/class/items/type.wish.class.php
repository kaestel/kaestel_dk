<?php
/**
* @package janitor.items
* This file contains item type functionality
*/

class TypeWish extends Model {

	/**
	* Init, set varnames, validation rules
	*/
	function __construct() {

		// itemtype database
		$this->db = SITE_DB.".item_wish";
		$this->db_mediae = SITE_DB.".item_wish_mediae";

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
			"label" => "Drag image here",
			"allowed_formats" => "png,jpg",
			"hint_message" => "Add image here. Use png or jpg in any proportion.",
			"error_message" => "File does not fit requirements."
		));

		// Tags
		$this->addToModel("tags", array(
			"type" => "tags",
			"label" => "Tag",
			"hint_message" => "Start typing to filter available tags. A correct tag has this format: context:value.",
			"error_message" => "Tag must conform to tag format: context:value."
		));


		parent::__construct();
	}


	// Custom get item with media
	function get($item_id) {
		$query = new Query();
		$query_media = new Query();

		if($query->sql("SELECT * FROM ".$this->db." WHERE item_id = $item_id")) {
			$item = $query->result(0);
			unset($item["id"]);

			$item["mediae"] = false;

			// get media
			if($query_media->sql("SELECT * FROM ".$this->db_mediae." WHERE item_id = $item_id ORDER BY position ASC, id DESC")) {

				$mediae = $query_media->results();
				foreach($mediae as $i => $media) {
					$variant = $media["variant"];
					$item["mediae"][$variant]["id"] = $media["id"];
					$item["mediae"][$variant]["variant"] = $variant;
					$item["mediae"][$variant]["format"] = $media["format"];
					$item["mediae"][$variant]["width"] = $media["width"];
					$item["mediae"][$variant]["height"] = $media["height"];
				}
			}

			return $item;
		}
		else {
			return false;
		}
	}


	// used for frontend communication
	// reserve wish
	// /wishlist/reserve/#item_id#
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
	// /wishlist/unreserve/#item_id#
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


	// custom function to add media
	// /admin/wish/addMedia/#item_id# (post image)
	function addMedia($action) {

		if(count($action) == 2) {
			$query = new Query();
			$IC = new Item();
			$item_id = $action[1];

			$query->checkDbExistance($this->db_mediae);

			if($this->validateList(array("files"), $item_id)) {
				$uploads = $IC->upload($item_id, array("input_name" => "files", "auto_add_variant" => true));
				if($uploads) {

					$return_values = array();

					foreach($uploads as $upload) {
						$query->sql("INSERT INTO ".$this->db_mediae." VALUES(DEFAULT, $item_id, '".$upload["name"]."', '".$upload["format"]."', '".$upload["variant"]."', '".$upload["width"]."', '".$upload["height"]."', 0)");

						$return_values[] = array(
							"item_id" => $item_id, 
							"media_id" => $query->lastInsertId(), 
							"variant" => $upload["variant"], 
							"format" => $upload["format"], 
							"width" => $upload["width"], 
							"height" => $upload["height"]
						);
					}

					return $return_values;
				}
			}
		}

		return false;
	}


	// delete image - 3 parameters exactly
	// /admin/wish/deleteImage/#item_id#/#variant#
	function deleteMedia($action) {

		if(count($action) == 3) {

			$query = new Query();
			$fs = new FileSystem();

			$sql = "DELETE FROM ".$this->db_mediae." WHERE item_id = ".$action[1]." AND variant = '".$action[2]."'";
			if($query->sql($sql)) {
				$fs->removeDirRecursively(PUBLIC_FILE_PATH."/".$action[1]."/".$action[2]);
				$fs->removeDirRecursively(PRIVATE_FILE_PATH."/".$action[1]."/".$action[2]);

				message()->addMessage("Media deleted");
				return true;
			}
		}

		message()->addMessage("Media could not be deleted", array("type" => "error"));
		return false;
	}


	// update media order
	// /admin/log/updateMediaOrder (comma-separated order in POST)
	function updateMediaOrder($action) {

		$order_list = getPost("order");
		if(count($action) == 1 && $order_list) {

			$query = new Query();
			$order = explode(",", $order_list);

			for($i = 0; $i < count($order); $i++) {
				$media_id = $order[$i];
				$sql = "UPDATE ".$this->db_mediae." SET position = ".($i+1)." WHERE id = ".$media_id;
				$query->sql($sql);
			}

			message()->addMessage("Media order updated");
			return true;
		}

		message()->addMessage("Media order could not be updated - refresh your browser", array("type" => "error"));
		return false;

	}


}

?>