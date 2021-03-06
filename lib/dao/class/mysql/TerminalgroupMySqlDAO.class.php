<?php
/**
 * Class that operate on table 'terminalgroup'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2011-12-29 14:21
 */
class TerminalgroupMySqlDAO implements TerminalgroupDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return TerminalgroupMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM terminalgroup WHERE groupid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM terminalgroup';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM terminalgroup ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param terminalgroup primary key
 	 */
	public function delete($groupid){
		$sql = 'DELETE FROM terminalgroup WHERE groupid = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($groupid);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param TerminalgroupMySql terminalgroup
 	 */
	public function insert($terminalgroup){
		$sql = 'INSERT INTO terminalgroup (groupname, enterprisename, parent) VALUES (?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($terminalgroup->groupname);
		$sqlQuery->set($terminalgroup->enterprisename);
		$sqlQuery->setNumber($terminalgroup->parent);

		$id = $this->executeInsert($sqlQuery);	
		$terminalgroup->groupid = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param TerminalgroupMySql terminalgroup
 	 */
	public function update($terminalgroup){
		$sql = 'UPDATE terminalgroup SET groupname = ?, enterprisename = ?, parent = ? WHERE groupid = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($terminalgroup->groupname);
		$sqlQuery->set($terminalgroup->enterprisename);
		$sqlQuery->setNumber($terminalgroup->parent);

		$sqlQuery->setNumber($terminalgroup->groupid);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM terminalgroup';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByGroupname($value){
		$sql = 'SELECT * FROM terminalgroup WHERE groupname = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByEnterprisename($value){
		$sql = 'SELECT * FROM terminalgroup WHERE enterprisename = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByParent($value){
		$sql = 'SELECT * FROM terminalgroup WHERE parent = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByGroupname($value){
		$sql = 'DELETE FROM terminalgroup WHERE groupname = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByEnterprisename($value){
		$sql = 'DELETE FROM terminalgroup WHERE enterprisename = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByParent($value){
		$sql = 'DELETE FROM terminalgroup WHERE parent = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return TerminalgroupMySql 
	 */
	protected function readRow($row){
		$terminalgroup = new Terminalgroup();
		
		$terminalgroup->groupid = $row['groupid'];
		$terminalgroup->groupname = $row['groupname'];
		$terminalgroup->enterprisename = $row['enterprisename'];
		$terminalgroup->parent = $row['parent'];

		return $terminalgroup;
	}
	
	protected function getList($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		$ret = array();
		for($i=0;$i<count($tab);$i++){
			$ret[$i] = $this->readRow($tab[$i]);
		}
		return $ret;
	}
	
	/**
	 * Get row
	 *
	 * @return TerminalgroupMySql 
	 */
	protected function getRow($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		if(count($tab)==0){
			return null;
		}
		return $this->readRow($tab[0]);		
	}
	
	/**
	 * Execute sql query
	 */
	protected function execute($sqlQuery){
		return QueryExecutor::execute($sqlQuery);
	}
	
		
	/**
	 * Execute sql query
	 */
	protected function executeUpdate($sqlQuery){
		return QueryExecutor::executeUpdate($sqlQuery);
	}

	/**
	 * Query for one row and one column
	 */
	protected function querySingleResult($sqlQuery){
		return QueryExecutor::queryForString($sqlQuery);
	}

	/**
	 * Insert row to table
	 */
	protected function executeInsert($sqlQuery){
		return QueryExecutor::executeInsert($sqlQuery);
	}
}
?>