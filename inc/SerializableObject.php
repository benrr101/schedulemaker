<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULEMAKER - Serializable Object
//
// @file	inc/SerializableObject.php
// @descrip	Basically this is an inheritable class that provides JSON decode
//			and encode functionality
// @author	Benjamin Russell (benrr101@csh.rit.edu)
//			Encode/Decode functions by (5hunter5@mail.ru) [http://www.php.net/manual/en/function.json-encode.php#96248]
////////////////////////////////////////////////////////////////////////////

abstract class SerializableObject {
	// METHODS /////////////////////////////////////////////////////////////
	public function jsonEncode() {
		foreach($this as $key=>$value) {
			if($value instanceof SerializableObject) {
				$value = json_decode($value->jsonEncode());
			}
			$json->$key = $value;
		}
		return json_encode($json);
	}
}
