<?php

  function user_can_see()
  {
    return $_SESSION['user']->is_a('member') || $_SESSION['user']->is_admin() ? true : false;
  }

?>
