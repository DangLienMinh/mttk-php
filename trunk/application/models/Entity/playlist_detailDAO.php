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
		$playlistDetail->setMp3($data['music']);
		$this->em->persist($playlistDetail);
		$this->em->flush();
	}

	public function layPlaylistSongs($id)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("select title,mp3 from playlist_detail where playlist_id=? order by title");
		$sth->bindValue(1, $id);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}
}
?>