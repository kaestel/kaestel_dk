<?php
/**
* @package janitor.items
* This file contains item type functionality
*/

class TypePage extends Model {

	/**
	* Init, set varnames, validation rules
	*/
	function __construct() {

		// itemtype database
		$this->db = SITE_DB.".item_page";
		$this->db_mediae = SITE_DB.".item_page_mediae";


		// Published
		$this->addToModel("published_at", array(
			"type" => "datetime",
			"label" => "Publish date (yyyy-mm-dd hh:mm:ss)",
			"pattern" => "^[\d]{4}-[\d]{2}-[\d]{2}[0-9\-\/ \:]*$",
			"hint_message" => "Publication date and time of page. This will be shown on website. Leave empty for current time", 
			"error_message" => "Date must be of format (yyyy-mm-dd hh:mm:ss)"
		));

		// Name
		$this->addToModel("name", array(
			"type" => "string",
			"label" => "Title",
			"required" => true,
			"hint_message" => "Title of your page", 
			"error_message" => "Title must be filled out."
		));

		// description
		$this->addToModel("description", array(
			"type" => "text",
			"label" => "Short description",
			"required" => true,
			"hint_message" => "Write a short description of the page. It is used for page listings and SEO.",
			"error_message" => "Your page needs a description"
		));

		// HTML
		$this->addToModel("html", array(
			"type" => "html",
			"label" => "HTML content",
			"allowed_tags" => "h2,h3,h4,p",
			"hint_message" => "Write the log entry",
			"error_message" => "A page without any words? How weird."
		));


		// Primary images
		$this->addToModel("main_media", array(
			"type" => "files",
			"label" => "Drag main image here",
			"allowed_formats" => "png,jpg",
			"allowed_sizes" => "960x540",
			"max" => 1,
			"hint_message" => "Add primary page image by dragging it here. Image must be jpg or png format in 960x540 pixels.",
			"error_message" => "Media does not fit requirements."
		));

		// HTML images
		$this->addToModel("mediae", array(
			"type" => "files",
			"label" => "Add media here",
			"allowed_formats" => "png,jpg",
			"hint_message" => "Add images or videos here. Use png, jpg or mp4.",
			"error_message" => "Media does not fit requirements."
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


	// CMS SECTION
	// custom loopback functions


	// custom function to add main media
	// /admin/page/addMain/#item_id#
	function addMain($action) {

		if(count($action) == 2) {
			$query = new Query();
			$IC = new Item();
			$item_id = $action[1];

			$query->checkDbExistance($this->db_mediae);

			// Image main_media
			if($this->validateList(array("main_media"), $item_id)) {
				$uploads = $IC->upload($item_id, array("input_name" => "main_media", "variant" => "main"));
				if($uploads) {
					$query->sql("DELETE FROM ".$this->db_mediae." WHERE item_id = $item_id AND variant = '".$uploads[0]["variant"]."'");
					$query->sql("INSERT INTO ".$this->db_mediae." VALUES(DEFAULT, $item_id, '".$uploads[0]["name"]."', '".$uploads[0]["format"]."', '".$uploads[0]["variant"]."', '".$uploads[0]["width"]."', '".$uploads[0]["height"]."', 0)");

					return array(
						"item_id" => $item_id, 
						"media_id" => $query->lastInsertId(), 
						"variant" => $uploads[0]["variant"], 
						"format" => $uploads[0]["format"], 
						"width" => $uploads[0]["width"], 
						"height" => $uploads[0]["height"]
					);
				}
			}
		}

		return false;
	}


	// delete image - 3 parameters exactly
	// /admin/page/deleteImage/#item_id#/#variant#
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

}

?>