<?php
	class Join extends CI_Controller
	{
		public $em;

	    function __construct()
	    {
	        parent::__construct();

	        // Not required if you autoload the library
	        $this->load->library('doctrine');

	        $this->em = $this->doctrine->em;

	        $user = new Entity\Test;

			$user->setName('josephatwild');

			$this->em->persist($user);
			$this->em->flush();
	    }
	}
?>