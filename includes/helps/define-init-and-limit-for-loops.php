<?php
function define_init_and_limits_for_loops($paged, $total_items, $total_pages, $itens_per_page) {
  if ($itens_per_page === 0) return [0, $total_items - 1];
  
  $init = ($itens_per_page * $paged) - $itens_per_page;
  $limit = ($itens_per_page * $paged) - 1;
  
  if ($limit > $total_items) {
    $init = ($itens_per_page * $total_pages) - $itens_per_page;
    $limit = $total_items - 1;
  }
  return [$init, $limit];
}
?>