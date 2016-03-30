<?php
/**
 * class for display author info div
 *
 * @file
 * @ingroup Extensions
 *
 * @author Pierre Boutet
 */

class WfAuthorDiv {


	protected static function getTags() {
		return array(
			'__lastTutorials__' => 'lastTuto',
			'__topTutorials__' => 'top'
		);
	}

	protected static function getSearchEngine() {
		return SearchEngine::create();
	}


	public static function addParser( $input, $type = 'top', $number = 4 ) {
		
		$title = $input->getTitle();

		$page = WikiPage::factory( $title );


		$creator = $page->getCreator();

		$data = [];
		$data['creatorId'] = $creator->getId();
		$data['creatorUrl'] = $creator->getUserPage()->getLinkURL();
		$data['creatorName'] = $creator->getName();

		$avatar = new wAvatar( $data['creatorId'], 'ml' );
		$data['creatorAvatar'] = $avatar->getAvatarURL();

		$data['creator'] = $creator->getRealName();

		$out = '<div class="tuto-details-author-box">';
		$out .= '<div class="row">';

		$out .= '<div class="col-md-4 col-sm-4 col-xs-4">';
		$out .= '<div class="tuto-details-author-photo">';
		$out .= '<a class="image" href="'.$data['creatorUrl'].'">'.$data['creatorAvatar'].'</a>';
		$out .= '</div>';
		$out .= '</div>';

		$out .= '<div class="col-md-8 col-sm-8 col-xs-8">';
		$out .= '<div class="tuto-details-author-name">' . $data['creator'] . '</div>';
		$out .= '</div>';

		$out .= '</div>';
		$out .= '</div>';

		return array( $out, 'noparse' => true, 'isHTML' => true );
	}

}