<?php
/**
* This file contains customized HTML-element output functions
*/
class HTML extends HTMLCore {

	function frontendComments($item, $add_path) {
		global $page;

		$_ = '';

		$_ .= '<div class="comments i:comments item_id:'.$item["item_id"].'"';
		$_ .= '	data-comment-add="'.$page->validPath($add_path).'"';
		$_ .= '	data-csrf-token="'.session()->value("csrf").'"';
		$_ .= '	>';
		$_ .= '	<h2 class="comments">Comments</h2>';
		if($item["comments"]):
			$_ .= '<ul class="comments">';
			foreach($item["comments"] as $comment):
			$_ .= '<li class="comment comment_id:'.$comment["id"].'" itemprop="comment" itemscope itemtype="https://schema.org/Comment">';
				$_ .= '<ul class="info">';
					$_ .= '<li class="published_at" itemprop="datePublished" content="'.date("Y-m-d", strtotime($comment["created_at"])).'">'.date("Y-m-d, H:i", strtotime($comment["created_at"])).'</li>';
					$_ .= '<li class="author" itemprop="author">'.$comment["nickname"].'</li>';
				$_ .= '</ul>';
				$_ .= '<p class="comment" itemprop="text">'. $comment["comment"].'</p>';
			$_ .= '</li>';
			endforeach;
		$_ .= '</ul>';
		else:
		$_ .= '<p>No comments yet</p>';
		endif;
		$_ .= '</div>';
		
		return $_;

	}
	
	function frontendOffer($item, $url) {

		$_ = '';

		if($item["prices"]) {

			global $page;

			$offer_key = arrayKeyValue($item["prices"], "type", "offer");
			$default_key = arrayKeyValue($item["prices"], "type", "default");

			$_ .= '<ul class="offer" itemscope itemtype="http://schema.org/Offer">';
				$_ .= '<li class="name" itemprop="name" content="'.$item["name"].'"></li>';
				$_ .= '<li class="currency" itemprop="priceCurrency" content="'.$page->currency().'"></li>';

				if($offer_key !== false) {
					$_ .= '<li class="price default">'.formatPrice($item["prices"][$default_key]).($item["subscription_method"] && $item["prices"][$default_key]["price"] ? ' / '.$item["subscription_method"]["name"] : '').'</li>';
					$_ .= '<li class="price offer" itemprop="price" content="'.$item["prices"][$offer_key]["price"].'">'.formatPrice($item["prices"][$offer_key]).($item["subscription_method"] && $item["prices"][$default_key]["price"] ? ' / '.$item["subscription_method"]["name"] : '').'</li>';
				}
				else {
					$_ .= '<li class="price" itemprop="price" content="'.$item["prices"][$default_key]["price"].'">'.formatPrice($item["prices"][$default_key]).($item["subscription_method"] && $item["prices"][$default_key]["price"] ? ' / '.$item["subscription_method"]["name"] : '').'</li>';
				}

				$_ .= '<li class="url" itemprop="url" content="'.$url.'"></li>';
			$_ .= '</ul>';
	
		}

		return $_;
	}


	function articleInfo($item, $url, $media = false, $sharing = false) {

		
		$_ = '';
		
		$_ .= '<ul class="info">';
		$_ .= '	<li class="published_at" itemprop="datePublished" content="'. date("Y-m-d", strtotime($item["published_at"])) .'">'. date("Y-m-d, H:i", strtotime($item["published_at"])) .'</li>';
		$_ .= '	<li class="modified_at" itemprop="dateModified" content="'. date("Y-m-d", strtotime($item["modified_at"])) .'"></li>';
		$_ .= '	<li class="author" itemprop="author">'. $item["user_nickname"] .'</li>';
		$_ .= '	<li class="main_entity'. ($sharing ? ' share' : '') .'" itemprop="mainEntityOfPage" content="'. SITE_URL.$url .'"></li>';
		$_ .= '	<li class="publisher" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">';
		$_ .= '		<ul class="publisher_info">';
		$_ .= '			<li class="name" itemprop="name">kaestel.dk</li>';
		$_ .= '			<li class="logo" itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">';
		$_ .= '				<span class="image_url" itemprop="url" content="'. SITE_URL .'/img/logo-large.png"></span>';
		$_ .= '				<span class="image_width" itemprop="width" content="720"></span>';
		$_ .= '				<span class="image_height" itemprop="height" content="405"></span>';
		$_ .= '			</li>';
		$_ .= '		</ul>';
		$_ .= '	</li>';
		$_ .= '	<li class="image_info" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">';

		if($media):
			$_ .= '		<span class="image_url" itemprop="url" content="'. SITE_URL .'/images/'. $item["item_id"] .'/'. $media["variant"] .'/720x.'. $media["format"] .'"></span>';
			$_ .= '		<span class="image_width" itemprop="width" content="720"></span>';
			$_ .= '		<span class="image_height" itemprop="height" content="'. floor(720 / ($media["width"] / $media["height"])) .'"></span>';
		else:
			$_ .= '		<span class="image_url" itemprop="url" content="'. SITE_URL .'/img/logo-large.png"></span>';
			$_ .= '		<span class="image_width" itemprop="width" content="720"></span>';
			$_ .= '		<span class="image_height" itemprop="height" content="405"></span>';
		endif;

		$_ .= '	</li>';
		$_ .= '</ul>';

		return $_;

	}


}

// create standalone instance to make HTML available without model
$HTML = new HTML();

?>