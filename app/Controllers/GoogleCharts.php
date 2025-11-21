<?php namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;


class GoogleCharts extends Controller
{

    public function index() {

        $db      = \Config\Database::connect();
        //$builder = $db->table('users');   

        $query_s = "SELECT COUNT(id) as count,DAY(created_at) as day_date FROM users_ex WHERE MONTH(created_at) = '" . date('m') . "'
        AND YEAR(created_at) = '" . date('Y') . "'
      GROUP BY DAY(created_at)";
      //var_dump($query_s);
        $query = $db->query("SELECT COUNT(id) as count,DAY(created_at) as day_date FROM users_ex WHERE MONTH(created_at) = '" . date('m') . "'
        AND YEAR(created_at) = '" . 2019 . "'
      GROUP BY DAY(created_at)");
      $data['day_wise'] = $query->getResult();
//var_dump($data); die();        
	    return view('home',$data);
    }
    
    public function price() {

        $db      = \Config\Database::connect();
        //$builder = $db->table('users');   

        $query = $db->query("SELECT 'oxpalm' as itemname, thedate, price_per_unit from grocery WHERE item_name like '%quaker%'");
    $data['item_wise'] = $query->getResult();
//var_dump($data); die();        
	    return view('home',$data);
    }
    
    public function itemprice() {
        $item = $_POST['itemname'];
        $db      = \Config\Database::connect();
        //$builder = $db->table('users');   

        $query = $db->query("SELECT item_name as itemname, thedate, price_per_unit from grocery WHERE item_name like '%".$item."%' order by thedate asc");
    $data['item_wise'] = $query->getResult();
	    //return view('home',$data);
	    print(json_encode($data));
    }
    
    public function getlistofdates()
    {
      $db = \Config\Database::connect();
      //$builder = $db->table('users');   
      $query = $db->query("SELECT distinct(thedate) from grocery order by thedate asc");
    $data['thedates'] = $query->getResult();
	    //return view('home',$data);
	    print(json_encode($data));
    }
    
    public function viadates()
    {
      $db = \Config\Database::connect();
      //$builder = $db->table('users');   
      $query = $db->query("SELECT distinct(thedate) from grocery order by thedate asc");
    $data['thedates'] = $query->getResult();
	    return view('bydates',$data);
	    //print(json_encode($data));
    }
    
    
    public function getitemsbydateajax()
    {
      $thedate = $_POST['thedate'];
      $db = \Config\Database::connect();
      //$builder = $db->table('users');   
      $query = $db->query("SELECT thedate, store_name, item_name, price_per_unit, n_units from grocery where thedate='$thedate' order by PK asc");
    $data['itemslist'] = $query->getResult();
	    print(json_encode($data));
    }

}