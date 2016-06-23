<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$plugin_info = array(
    'pi_name'         => 'Hop HTML2Markdown',
    'pi_version'      => '1.0',
    'pi_author'       => 'Louis Dekeister (Hop Studios)',
    'pi_author_url'   => 'http://www.hopstudios.com/',
    'pi_description'  => 'Convert HTML to markdown',
    'pi_usage'        => Hop_html2markdown::usage()
);

require PATH_THIRD.'hop_html2markdown/lib/vendor/autoload.php';
use League\HTMLToMarkdown\HtmlConverter;

class Hop_html2markdown
{

    public $return_data = "";

    /**
     * Tag pair to convert HTML to markdown {exp:hop_html2markdown}
     */
    public function __construct()
    {
        $content = ee()->TMPL->tagdata;

        $convert_parameters = array();

        $strip_tags = ee()->TMPL->fetch_param('strip_tags');
        if ($strip_tags == "yes" || $strip_tags == "y" || $strip_tags == "true")
        {
            $convert_parameters['strip_tags'] = TRUE;
        }

        $remove_nodes = ee()->TMPL->fetch_param('remove_nodes');
        if ($remove_nodes != null && $remove_nodes != "")
        {
            // This is a list of tags to remove when converting from HTML to markdown
            // "div span table"...
            $convert_parameters['remove_nodes'] = $remove_nodes; 
        }

        $converter = new HtmlConverter($convert_parameters);
        $markdown = $converter->convert($content);

        $htmlspecialchars = ee()->TMPL->fetch_param('htmlspecialchars');
        if ($htmlspecialchars == "yes" || $htmlspecialchars == "y" || $htmlspecialchars == "true")
        {
            $markdown = htmlspecialchars($markdown);
        }

        $this->return_data = $markdown;
    }

    public static function usage()
    {
        ob_start();  ?>

Hop HTML2Markdown converts HTML content to markdown syntax.

--

{exp:hop_html2markdown}
<p><b>Some HTML</b> <i>content</i> with <a href="#">links</a> and stuff.</p>
{/exp:hop_html2markdown}

OPTIONS:

- strip_tags="yes"
Strip HTML tags that don't have a Markdown equivalent while preserving the content inside them

- remove_nodes="span div table"
Strip tags and their content, pass a space-separated list of tags

- htmlspecialchars="yes"
Uses htmlspecialchars() just before outputing the content. Might be useful if you need to copy/paste the entire code. This would display HTML tags that weren't converted.

This add-on is using https://github.com/thephpleague/html-to-markdown. Thanks to them for providing such a great library.
    <?php
        $buffer = ob_get_contents();
        ob_end_clean();

        return $buffer;
    }
}
