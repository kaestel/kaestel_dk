<?php
/**
* @package janitor.items
* This file contains Log maintenance functionality
*/


class TypePost extends Model {

	/**
	* Init, set varnames, validation rules
	*/
	function __construct() {

		// itemtype database
		$this->db = SITE_DB.".item_post";
		$this->db_mediae = SITE_DB.".item_post_mediae";


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


		// Files
		$this->addToModel("files", array(
			"type" => "files",
			"label" => "Add media here",
			"allowed_formats" => "png,jpg,mp4",
			"hint_message" => "Add images or videos here. Use png, jpg or mp4.",
			"error_message" => "Media does not fit requirements."
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


	// CMS SECTION

	// update item type - based on posted values
	function update($item_id) {

		$query = new Query();
		$IC = new Item();

		$query->checkDbExistance($this->db);
		$query->checkDbExistance($this->db_mediae);

		$uploads = $IC->upload($item_id, array("auto_add_variant" => true));
		if($uploads) {
			foreach($uploads as $upload) {
				$query->sql("INSERT INTO ".$this->db_mediae." VALUES(DEFAULT, $item_id, '".$upload["name"]."', '".$upload["format"]."', '".$upload["variant"]."', 0)");
			}
		}


		$entities = $this->data_entities;
		$names = array();
		$values = array();

		foreach($entities as $name => $entity) {
			if($entity["value"] != false && $name != "published_at" && $name != "status" && $name != "tags" && $name != "prices") {
				$names[] = $name;
				$values[] = $name."='".$entity["value"]."'";
			}
		}

		if($this->validateList($names, $item_id)) {
			if($values) {
				$sql = "UPDATE ".$this->db." SET ".implode(",", $values)." WHERE item_id = ".$item_id;
//					print $sql;
			}

			if(!$values || $query->sql($sql)) {
				return true;
			}
		}

		return false;
	}


	// custom loopback function

	// delete product image - 4 parameters exactly
	// /product/#item_id#/deleteImage/#image_id#
	function deleteMedia($action) {

		if(count($action) == 4) {

			$query = new Query();

//			print "DELETE FROM ".$this->db_images." WHERE item_id = ".$action[0]." AND variant = '".$action[2]."'";

			if($query->sql("DELETE FROM ".$this->db_mediae." WHERE item_id = ".$action[1]." AND variant = '".$action[3]."'")) {
				FileSystem::removeDirRecursively(PUBLIC_FILE_PATH."/".$action[1]."/".$action[3]);
				FileSystem::removeDirRecursively(PRIVATE_FILE_PATH."/".$action[1]."/".$action[3]);

				message()->addMessage("Media deleted");
				return true;
			}
		}

		message()->addMessage("Media could not be deleted", array("type" => "error"));
		return false;
	}

}

?>