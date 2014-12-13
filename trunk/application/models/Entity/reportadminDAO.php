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

	public function getGenderGraph()
	{
		$query = $this->em->createQuery("SELECT p.gender,count(p.profile_id) as number FROM Entity\profile p GROUP BY p.gender");
		$result=$query->getResult();
		return $result;
	}
	
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

	public function solvedUserReport($report_id)
	{
		$report = $this->em->getReference('Entity\Reportadmin', $report_id);
	    $this->em->remove($report);
	    $this->em->flush();
	}

	public function notifyCancelReport($status,$user){
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL notifyCancelReport(?,?)");
		$sth->bindValue(1, $status);
		$sth->bindValue(2,$user);
		$sth->execute();
	}

	public function notifyAcceptReport($status,$user){
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL notifyAcceptReport(?,?)");
		$sth->bindValue(1, $status);
		$sth->bindValue(2, $user);
		$sth->execute();
	}


	public function addReportFanclub($data)
	{
		$report = new Reportadmin;
		$user = $this->em->getReference('Entity\User',$data['email']);
		$fanclub = $this->em->getReference('Entity\Fanclub',$data['fanclub_id']);
		$report->setReason($data['reason']);
		$report->setEmail($user);
		$report->setFanclub_id($fanclub);
		$this->em->persist($report);
		$this->em->flush();
	}

	public function getDayNewStatus(){
		$cnn=$this->em->getConnection();
        $sth = $cnn->prepare("SELECT count(*) as soStatus from status where 
		DAY(CURDATE())=DAY(created_at) and MONTH(CURDATE())=MONTH(created_at) and YEAR(CURDATE())=YEAR(created_at);");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
	}

	public function getDayNewReport(){
		$cnn=$this->em->getConnection();
        $sth = $cnn->prepare("SELECT count(p.report_id) as soReport from reportadmin p WHERE 
		DAY(CURDATE())=DAY(p.created_at) and MONTH(CURDATE())=MONTH(p.created_at) and YEAR(CURDATE())=YEAR(p.created_at)");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
	}

	public function getDayNewUser(){
		$cnn=$this->em->getConnection();
        $sth = $cnn->prepare("SELECT count(*) as soUser from user where 
		DAY(CURDATE())=DAY(created_at) and MONTH(CURDATE())=MONTH(created_at) and YEAR(CURDATE())=YEAR(created_at);");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
	}

	public function getDayNewFanclub(){
		$cnn=$this->em->getConnection();
        $sth = $cnn->prepare("SELECT count(*) as soFanclub from fanclub where 
		DAY(CURDATE())=DAY(created_at) and MONTH(CURDATE())=MONTH(created_at) and YEAR(CURDATE())=YEAR(created_at)");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
	}

	public function getUserGraph(){
		$cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL getUserGraph()");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
	}

	public function getFanclubGraph(){
		$cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL getFanclubGraph()");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
	}

	public function getStatusGraph(){
		$cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL getStatusGraph()");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
	}

	/*ublic function getReportStatus()
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("SELECT * from reportadmin where status_id is not null order by status_id");
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}*/

	public function count_report(){
		$cnn=$this->em->getConnection();
        $sth = $cnn->prepare("SELECT count(*) as checked from reportadmin where status_id is not null");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result[0]['checked'];
	}

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

	public function count_user(){
		$cnn=$this->em->getConnection();
        $sth = $cnn->prepare("SELECT count(*) as checked from user");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result[0]['checked'];
	}


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