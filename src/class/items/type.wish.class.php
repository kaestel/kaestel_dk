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

		// Name
		$this->addToModel("name", array(
			"type" => "string",
			"label" => "Name",
			"required" => true,
			"unique" => $this->db,
			"hint_message" => "Name of the product - Format: Miele - AX11.", 
			"error_message" => "Name must to be filled out."
		));

		// Price
		$this->addToModel("price", array(
			"type" => "integer",
			"label" => "Price",
			"required" => true,
			"hint_message" => "Price or price range of product", 
			"error_message" => "Price must be indicated"
		));

		// Reserved
		$this->addToModel("reserved", array(
			"type" => "select",
			"options" => array(array(0,"Free"),array(1,"Reserved")),
			"label" => "Reserved?",
			"hint_message" => "Is product reserved"
		));

		// Description
		$this->addToModel("description", array(
			"type" => "text",
			"label" => "Description",
			"hint_message" => "Write a meaningful description of the product. Remember product descriptions are very important for Google - Make sure to use varied language and include all relevant keywords in your description."
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
			"hint_message" => "Add imagehere. Use png or jpg in any proportion.",
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


	function reserve($item_id) {
		$query = new Query();
		$sql = "UPDATE ".$this->db." SET reserved = 1 WHERE item_id = ".$item_id;
		if($query->sql($sql)) {
			return true;
		}
		return false;
	}

	function unreserve($item_id) {
		$query = new Query();
		$sql = "UPDATE ".$this->db." SET reserved = 0 WHERE item_id = ".$item_id;
		if($query->sql($sql)) {
			return true;
		}
		return false;
	}
// 
// 	/**
// 	* Get item
// 	*/
// 	function get($item_id) {
// 		$query = new Query();
// 		$query_images = new Query();
// 
// 		if($query->sql("SELECT * FROM ".$this->db." WHERE item_id = $item_id")) {
// 			$item = array();
// 			$item["name"] = $query->result(0, "name");
// 			$item["description"] = $query->result(0, "description");
// 			$item["images"] = array();
// 
// 			// get slides
// 			if($query_images->sql("SELECT * FROM ".$this->db_images." WHERE item_id = $item_id ORDER BY position DESC, id DESC")) {
// 
// 				$images = $query_images->results();
// 				foreach($images as $i => $image) {
// 					$item["images"][$i]["id"] = $image["id"];
// 					$item["images"][$i]["variant"] = $image["variant"];
// 					$item["images"][$i]["format"] = $image["format"];
// 				}
// 			}
// 
// 			return $item;
// 		}
// 		else {
// 			return false;
// 		}
// 	}
// 
// 
// 
// 	// CMS SECTION
// 
// 	// update item type - based on posted values
// 	function update($item_id) {
// 
// 		$query = new Query();
// 		$IC = new Item();
// 
// 		$query->checkDbExistance($this->db);
// 		$query->checkDbExistance($this->db_images);
// 
// 		$uploads = $IC->upload($item_id, array("proportion" => 1/1, "filegroup" => "image", "auto_add_variant" => true));
// 		if($uploads) {
// 			foreach($uploads as $upload) {
// 				$query->sql("INSERT INTO ".$this->db_images." VALUES(DEFAULT, $item_id, '".$upload["name"]."', '".$upload["format"]."', '".$upload["variant"]."', 0)");
// 			}
// 		}
// 
// 
// 		$entities = $this->data_entities;
// 		$names = array();
// 		$values = array();
// 
// 		foreach($entities as $name => $entity) {
// 			if($entity["value"] != false && $name != "published_at" && $name != "status" && $name != "tags" && $name != "prices") {
// 				$names[] = $name;
// 				$values[] = $name."='".$entity["value"]."'";
// 			}
// 		}
// 
// 		if($this->validateList($names, $item_id)) {
// 			if($values) {
// 				$sql = "UPDATE ".$this->db." SET ".implode(",", $values)." WHERE item_id = ".$item_id;
// //					print $sql;
// 			}
// 
// 			if(!$values || $query->sql($sql)) {
// 				return true;
// 			}
// 		}
// 
// 		return false;
// 	}
// 
// 
// 	// custom loopback function
// 	// delete product image
// 	function deleteImage($action) {
// 		if(count($action) == 3) {
// 
// 			$query = new Query();
// 
// //			print "DELETE FROM ".$this->db_images." WHERE item_id = ".$action[0]." AND variant = '".$action[2]."'";
// 
// 			if($query->sql("DELETE FROM ".$this->db_images." WHERE item_id = ".$action[0]." AND variant = '".$action[2]."'")) {
// 				FileSystem::removeDirRecursively(PUBLIC_FILE_PATH."/".$action[0]."/".$action[2]);
// 				FileSystem::removeDirRecursively(PRIVATE_FILE_PATH."/".$action[0]."/".$action[2]);
// 
// 				return true;
// 			}
// 		}
// 
// 		return false;
// 	}
	
}

?>