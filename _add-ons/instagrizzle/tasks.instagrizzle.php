<?php

class Tasks_instagrizzle extends Tasks
{
	/**
	 * Get and filter Instagram media from a public account
	 * @param  string  $username Instagram username
	 * @param  int     $limit    limit the number of items returned
	 * @param  integer $offset   offset the items returned
	 * @return array             the items
	 */
	public function getMedia($username, $limit = false, $offset = 0)
	{
		// clear old cache
		$this->cache->purgeOlderThan($this->fetchConfig('cache_length'));
		
		// fetch from cache if available
		$media = $this->cache->getYAML($username);

		// no cache. sad trombone. let's scrape new data.
		if ( ! $media) {

			$media = $this->scrape($username);

			// store in cache
			$this->cache->putYAML($username, $media);

		}

		// offset results
		if ($offset > 0) {
		    $media = array_splice($media, $offset);
		}

		// limit results
		if ($limit) {
			$media = array_slice($media, 0, $limit);
		}

		return $media;
	}

	// Quick and dirty Instagram scraper
	public function scrape($username)
	{
		$source = file_get_contents('http://instagram.com/' . $username);
		$shards = explode('window._sharedData = ', $source);
		$json_response = explode(';</script>', $shards[1]);
		$response_array = json_decode($json_response[0], TRUE);
		$nodes = array_get($response_array, 'entry_data:ProfilePage:0:user:media:nodes');

		$data = array();

		foreach ($nodes as $node) {
			$url = 'https://instagram.com/p/' . $node['code'];
			$image = $node['display_src'];

			$data[] = $node + array(
				'url' => $url,
				'link' => $url,
				'image' => $image,
				'images' => array(
					'high_resolution' => array('url' => $image),
					'low_resolution' => array('url' => $image)
				)
			);
		}

		return $data;
	}
}