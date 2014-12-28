<?php
$conecta = mysql_connect('localhost:3307', 'isohunt', '123') or print (mysql_error());
mysql_select_db('isohunt', $conecta) or print(mysql_error());
$sql = 'SELECT * FROM torrents';
$result = mysql_query($sql, $conecta);

/* Escreve resultados até que não haja mais linhas na tabela */
while($consulta = mysql_fetch_array($result)) {
	$post = array(
	'post_content'   => $consulta['name'], // The full text of the post.
	'post_title'     => $consulta['name'], // The title of your post.
	'post_type'      => 'post',
	'post_status'    => 'publish'
	);
	$post = wp_insert_post( $post, false );
	if($post != false && $post != 0){
		var_dump($post);
		$term = term_exists($consulta['tags'], 'category');
		if ($term !== 0 && $term !== null) {
			$term_obj = get_term_by('name', $consulta['tags'], 'category', OBJECT, false);
			wp_set_object_terms( $post, intval($term_obj->term_id), 'category', true );
		}
		else{
			$term_obj = wp_insert_term( $consulta['tags'], 'category', false );
			if(is_object($term_obj)){
				var_dump($term_obj);
			}
			else{
				wp_set_object_terms( $post, intval($term_obj['term_id']), 'category', true );
			}
		}
		 $params = array(
		 	'dn' => $consulta['name'],
		 	'xl' => $consulta['size'],
		 	'dl' => $consulta['size']
		 );
		 $magnetLink = 'magnet:?xt=urn:btih:' . $consulta['hash'] . '&amp;' . http_build_query($params, '', '&amp;');
		 update_post_meta( $post, 'magnet_link', $magnetLink, false);
	}
}
mysql_free_result($result);
mysql_close($conecta);
echo 'foi';
?>
