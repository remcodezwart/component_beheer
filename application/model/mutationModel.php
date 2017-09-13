<?php

class mutationModel
{
	public static function addMutation($componentId, $locationId, $amount, $reason)
	{
		if (empty($componentId) || ComponentModel::getComponent($componentId) === false || empty($amount) || empty($reason) || empty($locationId) || LocationModel::getLocation($locationId) === false) {

			Session::add('feedback_negative', Text::get('MUTANT_CREATION_FAILED'));
			return false;
			exit;
		}


		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO mutations (user_id, component_id,location_id,amount,reason,date) VALUES(:user, :component,:location,:amount,:reason, NOW())";
        $query = $database->prepare($sql);

        $query->execute(
        	array(
        		':component' => $componentId, 
        		':location' => $locationId, 
        		':amount' => $amount, 
        		':reason' => $reason,
        		':user' => Session::get('user_id')
        	)
        );

        if ($query->rowcount() === 1) {
       		Session::add('feedback_positive', Text::get('MUTANT_CREATION_SUCCES'));
        	return true;
        }

        Session::add('feedback_negative', Text::get('MUTANT_CREATION_FAILED'));
        return false;
	}

	public static function getMutation($page = null,$startdate = null,$enddate = null)
	{
        if ($page === null || !is_numeric($page) || 0 >= $page) {
            $offset = 0;   
        } else {
            $offset = ($page-1)*5;
        }

        

		$database = DatabaseFactory::getFactory()->getConnection();
        $where = "";
        if (!empty($startdate) && !empty($enddate)) {
            $date1 = date("Y-m-d",strtotime($startdate));
            $date2 = date("Y-m-d",strtotime($enddate));
            $where = "WHERE mutations.date >= :date1 AND mutations.date <= :date2";
        }

        $sql = "SELECT mutations.*,users.user_id,users.user_name, location.id,location.address,components.id,components.name FROM mutations 
        INNER JOIN components ON
        	mutations.component_id = components.id 
        INNER JOIN location ON	
			mutations.location_id = location.id
		INNER JOIN users ON	
			mutations.user_id = users.user_id ".
            $where
        ." LIMIT :offset, 5";

        $query = $database->prepare($sql);
        $query->bindParam(':offset', $offset, PDO::PARAM_INT);
        if (!empty($startdate) && !empty($enddate)) {
            $query->bindParam(':date1', $date1, PDO::PARAM_STR);
            $query->bindParam(':date2', $date2, PDO::PARAM_STR);
        }
        $query->execute();

        $mutations = $query->fetchALL();
        
        return Filter::XSSFilter($mutations);
    }
}