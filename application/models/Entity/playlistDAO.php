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

	
}
?>