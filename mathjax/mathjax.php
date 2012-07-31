<?php

/**
* Includes MathJax to render Latex-formulas in messages.
*
* @license GNU GPLv3+
* @author Ole Schütt
*/

class mathjax extends rcube_plugin
{
	public $task = 'mail';
	function init()
	{
		$rcmail = rcmail::get_instance();
		if ($rcmail->action == 'show' || $rcmail->action == 'preview') {
			$config = 'MathJax.Hub.Config({
						extensions: ["tex2jax.js"],
						jax: ["input/TeX", "output/HTML-CSS"],
						tex2jax: {
						skipTags: ["<pre>"],
						inlineMath: [ ["$","$"], ["\\\\(","\\\\)"] ],
						displayMath: [ ["$$","$$"], ["\\\\[","\\\\]"] ],
						processEscapes: true
					  },
					  "HTML-CSS": { availableFonts: ["TeX"] }
					  });
					  MathJax.Hub.Configured();';
			
			/* For details about MathJax see:
			*  http://www.mathjax.org/docs/2.0/configuration.html
			*  http://www.mathjax.org/docs/2.0/config-files.html
			*  http://www.mathjax.org/docs/2.0/options/tex2jax.html
			*/
			
			$rcmail->output->add_script($config, 'head_top');
			$url = 'http://cdn.mathjax.org/mathjax/latest/MathJax.js?delayStartupUntil=configured';
			$rcmail->output->include_script($url);
	   	}
	}
		
}

//EOF
