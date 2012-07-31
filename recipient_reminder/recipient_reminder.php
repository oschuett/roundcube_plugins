<?php
/**
* Asks for confirmation when special recipients or many recipients are used.
* @license GNU GPLv3+
* @author Ole Schütt
*/


class recipient_reminder extends rcube_plugin{
  public $task = 'mail';

  function init(){
    $rcmail = rcmail::get_instance();
    if($rcmail->action == 'compose')
      $this->include_script('recipient_reminder.js');
  }

}

?>
