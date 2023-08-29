<?php
function duplicate_post($post_id) {
  $post = get_post($post_id);

  if (!$post) {
      return;
  }

  $new_post = array(
      'post_title' => $post->post_title . ' (Copy)',
      'post_content' => $post->post_content,
      'post_status' => 'draft', // Você pode definir o status desejado
      'post_type' => $post->post_type,
  );

  $new_post_id = wp_insert_post($new_post);

  if ($new_post_id) {
      // Copia as meta informações do post original
      $meta_data = get_post_custom($post_id);
      foreach ($meta_data as $key => $values) {
          foreach ($values as $value) {
              add_post_meta($new_post_id, $key, $value);
          }
      }
  }

  return $new_post_id;
}

function add_duplicate_post_button() {
  global $post;
  // if ($post && $post->post_type !== 'post') {
  //     return;
  // }

  echo '<div id="duplicate-action" class="misc-pub-section">';
  echo '<a href="' . esc_url(add_query_arg(array('duplicate' => $post->ID), admin_url('post.php'))) . '">' . esc_html__('Duplicate Post', 'duplicate-post') . '</a>';
  echo '</div>';
}

add_action('post_submitbox_misc_actions', 'add_duplicate_post_button');



function handle_duplicate_post($post_id) {
  if (!isset($_GET['duplicate'])) {
      return;
  }

  $original_post_id = absint($_GET['duplicate']);
  $new_post_id = duplicate_post($original_post_id);

  if ($new_post_id) {
      wp_redirect(admin_url('post.php?action=edit&post=' . $new_post_id));
      exit;
  }
}

add_action('save_post', 'handle_duplicate_post');

?>