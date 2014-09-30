<?php

/**
 * Instagrizzle
 * Get media from public Instagram accounts
 *
 * @author      Jack McDade
 * @version     1.0
 * @link        http://github.com/jackmcdade/instagrizzle
 */

class Plugin_instagrizzle extends Plugin
{

	/**
	 * Get Instagram media
	 * @return array parsed response from a public Instagram feed
	 */
	public function index()
	{
		$username = $this->fetch('username');
		$limit    = $this->fetch('limit', false, 'is_numeric');
        $offset   = $this->fetch('offset', 0, 'is_numeric');

		$media = $this->tasks->getMedia($username, $limit, $offset);

		return Parse::tagLoop($this->content, $media);
	}

	/**
	 * Dump and die the available data
	 * @return array
	 */
	public function debug()
	{
		$media = $this->tasks->getMedia($this->fetch('username'));

		rd($media);
	}
}