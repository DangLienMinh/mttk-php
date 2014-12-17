<?php
namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Tools\Pagination\Paginator;
class reportadminDAO
{
	private $em;
	function __construct($em) {
       $this->em=$em;
    }

    //get report gender of user of mymusic
	public function getGenderGraph()
	{
		$query = $this->em->createQuery("SELECT p.gender,count(p.profile_id) as number FROM Entity\profile p GROUP BY p.gender");
		$result=$query->getResult();
		return $result;
	}
	
	//add new status report by other user
	public function addReportStatus($data)
	{
		$report = new Reportadmin;
		$user = $this->em->getReference('Entity\User',$data['email']);
		$status = $this->em->getReference('Entity\Status',$data['status_id']);
		$report->setReason($data['reason']);
		$report->setEmail($user);
		$report->setStatus_id($status);
		$this->em->persist($report);
		$this->em->flush();
	}

	//the user report about the status is removed
	public function solvedUserReport($report_id)
	{
		$report = $this->em->getReference('Entity\Reportadmin', $report_id);
	    $this->em->remove($report);
	    $this->em->flush();
	}

	//notify the user that reports stautus that their report is canceled
	public function notifyCancelReport($status,$user){
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL notifyCancelReport(?,?)");
		$sth->bindValue(1, $status);
		$sth->bindValue(2,$user);
		$sth->execute();
	}

	//notify the user that reports stautus that their report is accepted
	public function notifyAcceptReport($status,$user){
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL notifyAcceptReport(?,?)");
		$sth->bindValue(1, $status);
		$sth->bindValue(2, $user);
		$sth->execute();
	}

	//get current day new status updated
	public function getDayNewStatus(){
		$cnn=$this->em->getConnection();
        $sth = $cnn->prepare("SELECT count(*) as soStatus from status where 
		DAY(CURDATE())=DAY(created_at) and MONTH(CURDATE())=MONTH(created_at) and YEAR(CURDATE())=YEAR(created_at);");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
	}

	//get current day new status reported
	public function getDayNewReport(){
		$cnn=$this->em->getConnection();
        $sth = $cnn->prepare("SELECT count(p.report_id) as soReport from reportadmin p WHERE 
		DAY(CURDATE())=DAY(p.created_at) and MONTH(CURDATE())=MONTH(p.created_at) and YEAR(CURDATE())=YEAR(p.created_at)");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
	}

	//get current day new user register
	public function getDayNewUser(){
		$cnn=$this->em->getConnection();
        $sth = $cnn->prepare("SELECT count(*) as soUser from user where 
		DAY(CURDATE())=DAY(created_at) and MONTH(CURDATE())=MONTH(created_at) and YEAR(CURDATE())=YEAR(created_at);");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
	}

	//get current day new fanclub created
	public function getDayNewFanclub(){
		$cnn=$this->em->getConnection();
        $sth = $cnn->prepare("SELECT count(*) as soFanclub from fanclub where 
		DAY(CURDATE())=DAY(created_at) and MONTH(CURDATE())=MONTH(created_at) and YEAR(CURDATE())=YEAR(created_at)");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
	}

	//get number of user register in current year
	public function getUserGraph(){
		$cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL getUserGraph()");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
	}

	//get number of facnlub create in current year
	public function getFanclubGraph(){
		$cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL getFanclubGraph()");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
	}

	//get number of status update in current year
	public function getStatusGraph(){
		$cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL getStatusGraph()");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
	}

	//count all the status report
	public function count_report(){
		$cnn=$this->em->getConnection();
        $sth = $cnn->prepare("SELECT count(*) as checked from reportadmin where status_id is not null");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result[0]['checked'];
	}

	//get report status with pagination
	public function fetch_report_pagination($start,$limit){
		$qb = $this->em->createQueryBuilder();
		$qb->select('u')
            ->from('\Entity\Reportadmin', 'u')
            ->orderBy('u.status_id','DESC')
            ->setMaxResults($limit)
            ->setFirstResult($start);

		$query = $qb->getQuery();
		$paginator = new Paginator($query);
		return $paginator;
	}

	//count all the user
	public function count_user(){
		$cnn=$this->em->getConnection();
        $sth = $cnn->prepare("SELECT count(*) as checked from user");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result[0]['checked'];
	}

	//get user with pagination
	public function fetch_user_pagination($start,$limit){
		$qb = $this->em->createQueryBuilder();
		$qb->select('u')
            ->from('\Entity\User', 'u')
            ->orderBy('u.created_at','DESC')
            ->setMaxResults($limit)
            ->setFirstResult($start);

		$query = $qb->getQuery();
		$paginator = new Paginator($query);
		return $paginator;
	}
}

?>