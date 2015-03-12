  </section>

  <?php get_template_part('partials/scripts'); ?>

  <?php 
  if (is_tax( 'artist' )) { 
	  $artist_id = get_queried_object()->term_id;
	  $codez = Taxonomy_MetaData::get( 'artist', $artist_id, '_igv_codez');
	  if ($codez) {
		echo $codez;
	  }
	}
	?>


  </body>
</html>