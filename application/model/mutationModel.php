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

	public static function getMutation()
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT mutations.*,users.user_id,users.user_name, location.id,location.address,components.id,components.name FROM mutations 
        INNER JOIN components ON
        	mutations.component_id = components.id 
        INNER JOIN location ON	
			mutations.location_id = location.id
		INNER JOIN users ON	
			mutations.user_id = users.user_id";

        $query = $database->prepare($sql);
        $query->execute();
        $mutations = $query->fetchALL();

        return Filter::XSSFilter($mutations);
	}	
}