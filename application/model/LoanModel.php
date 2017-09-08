<?php


class LoanModel
{
	public static function getAllLoans($page = 0)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

		if ($page === null || !is_numeric($page) || 0 >= $page) {
            $offset = 0;   
        } else {
            $offset = ($page-1)*5;
        }

        $sql = "SELECT loaned.* ,components.name, location.address ,location.id as locationId, components.id as componentId FROM loaned 
        INNER JOIN location ON
			loaned.location_id = location.id
        INNER JOIN components ON
			loaned.component_id = components.id WHERE loaned.active = 1
        LIMIT :offset, 5";

        $query = $database->prepare($sql);

        $query->bindParam(':offset', $offset, PDO::PARAM_INT);

        $query->execute();
        $loaned = $query->fetchAll();

        return Filter::XSSFilter($loaned);
	}

	public static function getLoan($id)
	{
		if ($id === null || !is_numeric($id) ) {
			Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
			return false;
			exit;
		}

		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT loaned.* ,components.name, location.address ,location.id as locationId, components.id as componentId FROM loaned 
        INNER JOIN location ON
			loaned.location_id = location.id
        INNER JOIN components ON
			loaned.component_id = components.id WHERE loaned.active = 1 AND loaned.id = :id";

        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));
        $loan = $query->fetch();

        return Filter::XSSFilter($loan);
	}

	public static function delete($id)
	{
		if ($id === null || !is_numeric($id) ) {
			Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
			return false;
			exit;
		}

		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE loaned SET active = 0 WHERE id=:id";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));

        if ($query->rowCount() !== 1) {
            Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
            return false;
        }
        return true;
	}

	public static function completedLoan($id)
	{
		if ($id === null || !is_numeric($id) ) {
			Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
			return false;
			exit;
		}

		$loanAmount = self::getLoan($id);

		if (self::delete($id)) {
			self::updateComloc($loanAmount->component_id, $loanAmount->amount, $loanAmount->location_id);
	        return true;
	        exit;
		}
		Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
	    return false;
	}

	public static function edit($id, $locationId, $amount, $barcode) 
	{
		if ($id === null || !is_numeric($id) ) {
			Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
			return false;
			exit;
		}

		$old = self::getLoan($id);

		$amountDiference =  $amount - $old->amount;
		
		$validate = locationModel::getSomeComloc($id, $locationId);

		if (0 > ($old->amount-$amountDiference)  ) {
            Session::add('feedback_negative', Text::get('NOT_ENOUGH_COMPONENTS'));
            return false;
            exit;
        }

		if ($old->location_id !== $locationId) {
			if (self::completedLoan($id)) {
				ComponentModel::loanComponent($id, $locationId, $amount, $barcode);
			}
		} else {
			self::updateComloc($old->component_id, $amountDiference, $locationId);
			$database = DatabaseFactory::getFactory()->getConnection();

			$sql = "UPDATE loaned SET barcode = :barcode, amount = :amount, location_id = :location WHERE id=:id";
	        $query = $database->prepare($sql);
	        $query->execute(array(':id' => $id, ':barcode' => $barcode, ':amount' => $amount, ':location' => $locationId));

	    	mutationModel::addMutation($old->component_id ,$locationId ,$amountDiference ,"Onderdeel extra/minder geleend");

	        if ($query->rowCount() !== 1) {
	            Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
	            return false;
	        }
	    }
        return true;
	}

	public static function updateComloc($componentId, $amount, $locationId)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

		$sql = "UPDATE comloc SET amount = amount + :amount WHERE location_id=:locationId AND component_id  = :componentId";
	    $query = $database->prepare($sql);

	    $query->bindParam(':amount', $amount, PDO::PARAM_INT);
	    $query->bindParam(':locationId', $locationId, PDO::PARAM_INT);
	    $query->bindParam(':componentId', $componentId, PDO::PARAM_INT);

	    $query->execute();

	    mutationModel::addMutation($componentId ,$locationId ,$amount ,"Onderdeel terug gebracht/lening geanuleerd");

	    if ($query->rowCount() !== 1) {
            Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
            return false;
        }

	    return true;
	}

}