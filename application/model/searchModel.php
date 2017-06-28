<?php

class searchModel
{
    public static function search($terms)
    {
    	$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM components WHERE name LIKE :terms OR specs LIKE :terms OR description LIKE :terms";
        $query = $database->prepare($sql);

        $query->execute(
        	array(':terms' => '%'.$terms.'%')
        );

        $results = $query->fetchAll();

        if (Request::post('json') == true) {
            Session::remove('searchResults');
            header('Content-Type: application/json');
            echo json_encode(Filter::XSSFilter($results));
            exit;
        }

        return Filter::XSSFilter($results);
    }
}