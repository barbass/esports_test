<?php

class ParseXml {
	protected $file = null;
	protected $data = [];

	public function __construct($file) {
		$this->file = $file;

		if (!file_exists($file)) {
			throw new \Exception('File not found ('.$file.')');
		}
	}

	public function parse() {
		$xml = new \XMLReader();
		try {
			$result = $xml->open($this->file, 'utf-8');
			if (!$result) {
				throw new \Exception('Error open xml ('.$file.')');
			}
		} catch (\Exception $e) {
			throw new \Exception('Error open xml ('.$file.')');
		}

		while ($xml->read()) {
			if ($xml->nodeType === \XMLReader::ELEMENT && $xml->name === 'video') {
				$row = simplexml_load_string($xml->readOuterXML());

				if ((int)$row['categoryId'] !== 14) {
					continue;
				}

				$id = (string)$row['id'];
				$title = (string)$row['title'];

				$id_arr = explode('-', $id);
				$date = date('Y-m-d', strtotime($id_arr[0]));

				$this->data[$date][] = [
					'title' => $title,
					'id' => $id,
					'link' =>' http://php.esports.cz/elhcheck/index.php?id='.$id,
				];

			}
		}
	}

	public function saveToCache() {
		return Cache::save('video_14', $this->data);
	}
}
