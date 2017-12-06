<?php

class Cache {
	public static function save($id, $data, $path = null) {
		$cache_path = ($path) ? realpath($path) : __DIR__;
		$cache_file = $cache_path.'/cache_'.$id;

		$fh = fopen($cache_file, 'w');

		fwrite($fh, json_encode($data));

		fclose($fh);
	}

	public static function get($id, $path = null) {
		$cache_path = ($path) ? realpath($path) : __DIR__;
		$cache_file = $cache_path.'/cache_'.$id;

		if (!file_exists($cache_file)) {
			return false;
		}

		return file_get_contents($cache_file);
	}

}
