<?php

function retrieve_id_from_link($link) {
  $link_exploded = explode('/', $link);
  return $link_exploded[count($link_exploded) - 2];
}
