<?php

/**
* Plays audio attachments inside the message window unsing the <audio>-tag.
*
* @license GNU GPLv3+
* @author Ole Schütt
*/

class audio_attachments extends rcube_plugin
{
	public $task = 'mail';
	
	private $message;
	
	function init(){
		$rcmail = rcmail::get_instance();
		if ($rcmail->action == 'show' || $rcmail->action == 'preview') {
			$this->add_hook('message_load', array($this, 'message_load'));
			$this->add_hook('template_object_messagebody', array($this, 'html_output'));
		}
	}
	
	/**
	* Stores a reference to the message object
	*/
	function message_load($p){
		$this->message = $p['object'];
	}
	
	/**
	* This callback function adds a <audio> tag for each audio attachment
	* @see http://www.w3schools.com/html/html_sounds.asp
	*/
	function html_output($p){
		foreach ((array)$this->message->attachments as $attachment){
			if(!preg_match('/^audio\//', $attachment->mimetype))
				continue;
			
			$html  = "\n".'<hr><div style="text-align:center">';
			$html .= '<h4>'.$attachment->filename.'</h4>';
			$html .= '<audio controls="controls"><source src="';
			$html .= $this->message->get_part_url($attachment->mime_id);
			$html .= '" type="';
			$html .= $attachment->mimetype;
			$html .= $this->message->get_part_url($attechment->mime_id);
			$html .= '" />';
			$html .= '<embed height="50px" width="100px" src="';
			$html .= $this->message->get_part_url($attachment->mime_id);
			$html .= '" />';
			$html .= '</audio></div>';
			
			$p['content'] .= $html;			
		}
		return $p;
	}

}

//EOF