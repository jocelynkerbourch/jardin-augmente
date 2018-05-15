<?php

class waterlevel {

	public function setRequest(){
		DB::exec("INSERT INTO waterlevels (state, waterlevel, waterlevel_date, updated_at, created_at) VALUES ('pending', NULL, NULL, NOW(), NOW())"); 
		return true;
	}

	public function getRequestId(){
		$request = null;
		foreach( DB::query("SELECT * FROM waterlevels WHERE state='pending'") as $row){ 
		       $request=$row['id'];
		} 
		return $request;
	}

	public function setWaterlevel($id,$waterlevel,$date){
		$sth = DB::prepare("UPDATE waterlevels SET state='done', waterlevel=:waterlevel, waterlevel_date=:date, updated_at=NOW() WHERE id=:id");
		$sth->bindParam(':id', $id, PDO::PARAM_INT);
		$sth->bindParam(':waterlevel', $waterlevel, PDO::PARAM_STR);
		$sth->bindParam(':date', $date, PDO::PARAM_STR);
		$sth->execute(); 
		return true;
	}

	public function getLastLevel(){
		$levels = [];
		foreach( DB::query("SELECT * FROM waterlevels WHERE state='done' ORDER BY waterlevel_date DESC LIMIT 0, 1") as $row){ 
		        $level = $this->makeLevel($row);
		} 
		return $level;
	}

	public function getLastLevels(){
		$levels = [];
		foreach( DB::query("SELECT * FROM waterlevels WHERE state='done' ORDER BY waterlevel_date DESC LIMIT 0, 10") as $row){ 
        	$levels[]=$this->makeLevel($row);
		} 
		return $levels;
	}

	private function makeLevel($row){
		$level=array();
		$level['level']=$row['waterlevel'];
		$level['date']=$row['waterlevel_date'];

		$color = 'afd7b4';
		if ($level['level']<120) $color = 'ffd162';
		if ($level['level']<100) $color = 'fb9692';
		$level['color']=$color;

		return $level;
	}

}