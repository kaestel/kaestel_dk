<?php
/**
* @package framework
*/

/**
* typeWordpuzzle
* I <em>t</em>hink <em>h</em>e <em>i</em>s the <em>n</em>ew <em>k</em>ing!
*
* inline TEMPLATES
*
* itemtype.list -> itemtype class
* itemtype.view -> itemtype class
* itemtype.edit -> itemtype class
*/
class TypeWordpuzzle {
	
	public $limits;
	public $itemtype;
	public $item_name;
	public $items_name;

	/**
	* Default settings
	*/
	function __construct() {
		$this->translater = new Translation(__FILE__);
		$this->validator = new Validator($this);

		$this->varnames["text"] = $this->translater->translate("Word puzzle");
		$this->validator->rule("text", "arr");

		$this->vars = getVars($this->varnames);

		$this->db = UT_ITE_WPZ;

		$this->limits["list"] = 30;
		$this->limits["preview"] = 12;

		$this->itemtype = "wordpuzzle";
		
		$this->type_name = $this->translater->translate("Word puzzle");
		$this->types_name = $this->translater->translate("Word puzzles");

	}

	/**
	* Get selected item(s)
	* Loops through $item->item and adds itemtype values
	*
	* @param object $item Item object
	* @return $item
	*/
	function getItem($item) {
		$query = new Query();

		foreach($item->item["id"] as $key => $value) {
			$query->sql("SELECT id, text FROM ".$this->db." WHERE item_id = ".$value);
			$item->item["text"][$key] = $query->getQueryResult(0, "text");
		}
		return $item;
	}

	/**
	* List items, compiles the info for this itemtype in list view and returns HTML
	*
	* @param String $list_type Optional listtype (CSS specified types)
	* @return String HTML
	*/
	function listItems($link=false, $validate=false) {
		global $page;
		global $HTML;

		$item = $page->getObject("Item");

		$_ = '';
		$_ .= $HTML->head($this->translater->translate("Items"));

		if($item->item()) {
			$item = $this->getItem($item);
			$_ .= Generic::listItemsExtended($link, $validate, $item->item["id"], array($item->item["text"], $item->item["itemtype"]), array($this->types_name, $this->translater->translate("Search")), array("max", "search"));
		}
		else {
			$_ .= Generic::listItems($link, $validate, false, $this->translater->translate("Word puzzle items"));
		}

		return $_;
	}

	/**
	* View item, compiles the info for this itemtype in item view and returns HTML
	*
	* @return String HTML
	*/
	function viewItem() {
		global $page;
		global $HTML;

		$item = $page->getObject("Item");
		$item = $this->getItem($item);

		$_ = "";
		$_ .= $HTML->inputHidden("id", $item->item["id"][0]);
		$_ .= $HTML->inputHidden("page_status", "edit");

		$_ .= $HTML->block($this->varnames["text"], $item->item["text"][0]);
		$_ .= $HTML->separator();
		$_ .= $HTML->smartButton($this->translater->translate("Edit"), array($page->url,"edit"), "edit", "fright");

		return $_;
	}

	/**
	* Edit item, compiles the info for this itemtype in item edit view and returns HTML
	*
	* @return String HTML
	*/
	function editItem() {
		global $page;
		global $HTML;

		$item = $page->getObject("Item");
		$item = $this->getItem($item);
		
		$strings = stringOr($this->vars["text"], $item->item["text"][0]);
		if(!is_array($strings)) {
			$strings = preg_split('/<em>[a-zA-Z0-9]<\/em>/', $strings);
		}

		$_ = "";
		$_ .= $HTML->inputHidden("id", $item->item["id"][0]);
		$_ .= $HTML->inputHidden("page_status", "update");

		$_ .= $HTML->block($this->varnames["text"], false);
		$_ .= $HTML->input(false, "text[0]", $strings[0], "inline init:expand");
		$_ .= "<em>t</em>";
		$_ .= $HTML->input(false, "text[1]", $strings[1], "inline init:expand");
		$_ .= "<em>h</em>";
		$_ .= $HTML->input(false, "text[2]", $strings[2], "inline init:expand");
		$_ .= "<em>i</em>";
		$_ .= $HTML->input(false, "text[3]", $strings[3], "inline init:expand");
		$_ .= "<em>n</em>";
		$_ .= $HTML->input(false, "text[4]", $strings[4], "inline init:expand");
		$_ .= "<em>k</em>";
		$_ .= $HTML->input(false, "text[5]", $strings[5], "inline init:expand");

		$_ .= $HTML->smartButton($this->translater->translate("Update"), array($page->url,"update"), "update", "fright");

		return $_;
	}

	/**
	* New item, compiles the info for this itemtype in item view and returns HTML
	*
	* @param String $list_type Optional listtype (CSS specified types)
	* @return String HTML
	*/
	function newItem() {
		global $page;
		global $HTML;

		$_ = "";
		$_ .= $HTML->head("New item");

		$_ .= $HTML->inputHidden("itemtype_id", $this->itemtype);

		$_ .= $HTML->block($this->varnames["text"], false);
		$_ .= $HTML->input(false, "text[0]", stringOr($this->vars["text"][0]), "inline init:expand");
		$_ .= "<em>t</em>";
		$_ .= $HTML->input(false, "text[1]", stringOr($this->vars["text"][1]), "inline init:expand");
		$_ .= "<em>h</em>";
		$_ .= $HTML->input(false, "text[2]", stringOr($this->vars["text"][2]), "inline init:expand");
		$_ .= "<em>i</em>";
		$_ .= $HTML->input(false, "text[3]", stringOr($this->vars["text"][3]), "inline init:expand");
		$_ .= "<em>n</em>";
		$_ .= $HTML->input(false, "text[4]", stringOr($this->vars["text"][4]), "inline init:expand");
		$_ .= "<em>k</em>";
		$_ .= $HTML->input(false, "text[5]", stringOr($this->vars["text"][5]), "inline init:expand");

		$_ .= $HTML->smartButton($this->translater->translate("Save"), array($page->url,"save"), "save", "fright");

		return $_;
	}

	/**
	* Save new item, based on submitted values
	*
	* @return bool
	* @uses Message
	*/
	function saveItem($item_id) {
		if($this->validator->validateAll()) {
			$query = new Query();
			$text = $this->vars['text'];
			$wordpuzzle = $text[0]."<em>t</em>";
			$wordpuzzle .= $text[1]."<em>h</em>";
			$wordpuzzle .= $text[2]."<em>i</em>";
			$wordpuzzle .= $text[3]."<em>n</em>";
			$wordpuzzle .= $text[4]."<em>k</em>";
			$wordpuzzle .= $text[5];

			$vars = "''";
			$vars .= ", '$wordpuzzle'";
			$vars .= ", '$item_id'";
			$vars .= ", '".Session::getLanguageISO()."'";

			if($query->sql("INSERT INTO ".$this->db." VALUES($vars)",true)) {
				messageHandler()->addStatusMessage($this->translater->translate("Wordpuzzle saved"));
				return $item_id;
			}
			else {
				messageHandler()->addErrorMessage($query->dbError());
				return false;
			}
		}
		else {
			messageHandler()->addErrorMessage($this->translater->translate("Please complete missing information"));
			return false;
		}
	}


	/**
	* Update item, based on submitted values
	*
	* @return bool
	* @uses Message
	*/
	function updateItem() {
		global $id;

		if($this->validator->validateAll()) {
			$query = new Query();
			$text = $this->vars['text'];
			$wordpuzzle = $text[0]."<em>t</em>";
			$wordpuzzle .= $text[1]."<em>h</em>";
			$wordpuzzle .= $text[2]."<em>i</em>";
			$wordpuzzle .= $text[3]."<em>n</em>";
			$wordpuzzle .= $text[4]."<em>k</em>";
			$wordpuzzle .= $text[5];
			
			$vars .= "text='$wordpuzzle'";
			if($query->sql("UPDATE ".$this->db." SET $vars WHERE item_id = $id", true)) {
				messageHandler()->addStatusMessage($this->translater->translate("Wordpuzzle updated"));
				return true;
			}
			else {
				messageHandler()->addErrorMessage($query->dbError());
				return false;
			}
		}
		else {
			messageHandler()->addErrorMessage($this->translater->translate("Please complete missing information"));
			return false;
		}
	}

}

?>