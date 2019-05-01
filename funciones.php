<?php

  function ordernar_por_ranking($array) {
    usort($array, 'comp_rank');
    return $array;
  }

  function comp_rank($a, $b) {
    return $a["ranking"] - $b["ranking"];
  }

?>
