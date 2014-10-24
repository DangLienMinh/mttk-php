<?php
namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;

class Playlist_detailDAO
{
	private $em;
	function __construct($em) {
       $this->em=$em;
    }

	public function addMusic($data)
	{
		$playlistDetail = new Playlist_detail;
		$playlist_id = $this->em->getReference('Entity\Playlist',(int)$data['id']);
		$playlistDetail->setPlaylist_id($playlist_id);
		$playlistDetail->setTitle($data['title']);
		$playlistDetail->setMusic($data['music']);
		$this->em->persist($playlistDetail);
		$this->em->flush();
	}


	
}
?>