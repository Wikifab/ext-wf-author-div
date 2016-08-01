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

		if ( ! $creator) {
			// this occur when creating a new page
			return array( '', 'noparse' => true, 'isHTML' => true );
		}

		$data = [];
		$data['creatorId'] = $creator->getId();
		$data['creatorUrl'] = $creator->getUserPage()->getLinkURL();
		$data['creatorName'] = $creator->getName();

		$avatar = new wAvatar( $data['creatorId'], 'ml' );
		$data['creatorAvatar'] = $avatar->getAvatarURL();

		$data['creator'] = $creator->getRealName();
		if ( ! $data['creator']) {
			$data['creator'] = $creator->getName();
		}

		$out = '<span class="tuto-details-author-box">';
		$out .= '<a class="image" href="'.$data['creatorUrl'].'">'.$data['creatorAvatar'].'</a>';
		$out .= '<a class="name" href="'.$data['creatorUrl'].'">'.'<span class="tuto-details-author-name">' . $data['creator'] . '</span>'.'</a>';
		$out .= '</span>';


		return array( $out, 'noparse' => true, 'isHTML' => true );
	}

}