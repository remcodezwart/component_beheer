<?php

class SupplierModel
{
	public static function getAllSuppliers($page = null)
	{
		if ($page === null || !is_numeric($page) || 0 >= $page) {
            $offset = 0;   
        } else {
            $offset = ($page-1)*5;
        }

		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM supplier WHERE active = 1 LIMIT :start, 5";
        $query = $database->prepare($sql);
        $query->bindParam(':offset', $offset, PDO::PARAM_INT);
        $query->execute();

        $suppliers = $query->fetchALL();
        return Filter::XSSFilter($suppliers);
	} 

	public static function getSupplier($id)
	{
		if (empty($id)) {
			Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
			return false;
		}

		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM supplier WHERE active = :active AND id = :id";
        $query = $database->prepare($sql);
        $query->execute(array(':active' => 1, ':id' => $id));

        $supplier = $query->fetch();

        return Filter::XSSFilter($supplier);
	} 

	public static function addSuppliers($name)
	{
		if (empty($name)) {
			Session::add('feedback_negative', Text::get('SUPPLIER'));
			return false;
		}

		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO supplier (name) VALUES(:name)";
        $query = $database->prepare($sql);
        $query->execute(array(':name' => $name));
	} 

	public static function editSupplier($name, $id)
	{
		if (empty($id)) {
			Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
			return false;
		}

		if (empty($name)) {
			Session::add('feedback_negative', Text::get('SUPPLIER_NO_NAME'));
			return false;
		}

		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE supplier SET name = :name WHERE id = :id";
        $query = $database->prepare($sql);
        $query->execute(array(':name' => $name, ':id' => $id));
	}

	public static function deleteSupplier($id)
	{
		if (empty($id)) {
			Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
			return false;
		}

		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE supplier SET active = :active WHERE id = :id";
        $query = $database->prepare($sql);
        $query->execute(array(':active' => 0, ':id' => $id));
	}
}
