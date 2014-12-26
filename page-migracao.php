<?php
//page migracao
$conecta = mysql_connect('localhost', 'codelhgl_techcd', 'MsTFiCL2!#tJ') or print (mysql_error());
mysql_select_db('codelhgl_techcdold', $conecta) or print(mysql_error());
$sql = 'SELECT * FROM produtos';
$result = mysql_query($sql, $conecta);

/* Escreve resultados até que não haja mais linhas na tabela */

while($consulta = mysql_fetch_array($result)) {
	$post = array(
	'post_content'   => $consulta['DESC_PROD'], // The full text of the post.
	'post_title'     => $consulta['DESC_PROD'], // The title of your post.
	'post_type'      => 'product',
	'post_status'    => 'publish'
	);
	$post = wp_insert_post( $post, false );
	if($post != false && $post != 0){
		var_dump($post);
		echo '<br><br>';
		$term = term_exists($consulta['CATEGORIA_WEB'], 'product_cat');
		if ($term !== 0 && $term !== null) {
			$term_obj = get_term_by('name', $consulta['CATEGORIA_WEB'], 'product_cat', OBJECT, false);
			wp_set_object_terms( $post, intval($term_obj->term_id), 'product_cat', true );
		}
		else{
			$term_obj = wp_insert_term( $consulta['CATEGORIA_WEB'], 'product_cat', false );
			if(is_object($term_obj)){
				var_dump($term_obj);
			}
			else{
				wp_set_object_terms( $post, intval($term_obj['term_id']), 'product_cat', true );
			}
		}
		if($consulta['SUB_CATEGORIA_WEB'] !== false && $consulta['SUB_CATEGORIA_WEB'] !== null && $consulta['SUB_CATEGORIA_WEB'] != 'NULL'){
			$parent = get_term_by('name', $consulta['CATEGORIA_WEB'], 'product_cat', OBJECT, false);
			$term = term_exists($consulta['SUB_CATEGORIA_WEB'], 'product_cat', $parent->term_id);
			if ($term !== 0 && $term !== null) {
				wp_set_object_terms($post, intval($term['term_id']), 'product_cat', true );
			}
			else{
				$term_obj = wp_insert_term(
				$consulta['SUB_CATEGORIA_WEB'], // the term
				'product_cat', // the taxonomy
				array(
					'parent'=> $parent->term_id,
				)
				);
				if(!is_object($term_obj)){
					wp_set_object_terms( $post, intval($term_obj['term_id']), 'product_cat', true );
				}
				//wp_set_object_terms( $post, intval($term_obj['term_id']), 'product_cat', true );
			}
		}
	    update_post_meta($post,'campos_antigos',$consulta);
		$wp_upload_dir = wp_upload_dir();
		$fileold = get_template_directory() . '/assets/images/FOTOS/'.$consulta['COD_PROD']. '.gif';
		if(!file_exists($fileold)){
			continue;
		}
		copy($fileold, $wp_upload_dir['path'] . '/' . $consulta['COD_PROD'] . '.gif');
		// $filename should be the path to a file in the upload directory.
		$filename = $wp_upload_dir['path'] . '/' . $consulta['COD_PROD'] . '.gif';
		// The ID of the post this attachment is for.
		// Check the type of file. We'll use this as the 'post_mime_type'.
		$filetype = wp_check_filetype( basename( $filename ), null );
		// Get the path to the upload directory.
		// Prepare an array of post data for the attachment.
		$attachment = array(
			'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ),
			'post_mime_type' => $filetype['type'],
			'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
			'post_content'   => '',
			'post_status'    => 'inherit'
		);
		// Insert the attachment.
		$attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );
		// Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		// Generate the metadata for the attachment, and update the database record.
		$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
		wp_update_attachment_metadata( $attach_id, $attach_data );
		set_post_thumbnail( $post, $attach_id );
	}
}
mysql_free_result($result);
mysql_close($conecta);
?>
