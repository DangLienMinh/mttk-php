<?php
namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;

class PlaylistDAO
{
	private $em;
	function __construct($em) {
       $this->em=$em;
    }

	public function layDSPlaylist($email)
	{
		$query = $this->em->createQuery("SELECT p.Playlist_id,p.Playlist_name FROM Entity\Playlist p WHERE p.email = ?1");
		$query->setParameter(1, $email);
		$results=$query->getResult();
		return $results;
	}

	public function addMusic($data)
	{
		$playlistDetail = new Playlist_detail;
		$playlist_id = $this->em->getReference('Entity\Playlist',$data['id']);

		$playlistDetail->setPlaylist_id($playlist_id);
		$playlistDetail->setTitle($data['title']);
		$playlistDetail->setMusic($data['music']);
		$this->em->persist($playlistDetail);
		$this->em->flush();
	}


	public function createPlaylist($data)
	{
		$playlist = new Playlist;
		$privacy = $this->em->getReference('Entity\Privacy_type',$data['privacy']);
		$user = $this->em->getReference('Entity\User',$data['email']);
		$playlist->setPlaylist_name($data['playlistName']);
		$playlist->setEmail($user);
		$playlist->setPrivacy_type_id($privacy);
		$this->em->persist($playlist);
		$this->em->flush();
	}

	public function removePlaylist($playlist_id)
	{
	    $playlist = $this->em->getReference('Entity\Playlist', $playlist_id);
	    $this->em->remove($playlist);
	    $this->em->flush();
	}
}
?>