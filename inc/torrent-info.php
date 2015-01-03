<?php
//get torrent seeders/leechers
class Torrent_Info_WP{
	public function __construct(){
		add_filter( 'single_template', array( $this, 'save_info' ) );
	}
	public function save_info($tpl){
		global $post;
		$magnet = get_post_meta( $post->ID, 'magnet_link', true );
		parse_str($magnet,$magnet_array);
		$hash = str_replace('urn:btih:', '', $magnet_array['magnet:?xt']);
		if(empty($hash) || $hash == false || $hash == null){
			$hash = get_torrent_hash(get_post_meta( $post->ID, 'torrent_file', true ));
		}
		$response = wp_remote_retrieve_body( wp_remote_get('http://bitsnoop.com/api/trackers.php?hash='.$hash.'&json=1') );
		$response = json_decode($response);
		$seeders = 0;
		$leechers = 0;
		foreach ($response as $infos) {
			$seeders = intval($infos->NUM_SEEDERS) + $seeders;
			$leechers = intval($infos->NUM_LEECHERS) + $leechers;
		}
		$infos = $seeders . '/' . $leechers;
		update_post_meta( $post->ID, 'torrent_info', $infos );
		return $tpl;
	}
}
new Torrent_Info_WP();
