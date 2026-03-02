<?php
$html = '<ul><li>Feature 1</li><li>Feature 2 &nbsp;</li></ul><p>Description.</p>';
$descMarkup = $html;
$descMarkup = str_replace(['<li>', '</li>', '<p>', '</p>', '<br>', '<br/>', '<br />'], ["\n", "\n", "\n", "\n", "\n", "\n", "\n"], $descMarkup);
$descMarkup = html_entity_decode($descMarkup);
$descMarkup = strip_tags($descMarkup);
$features = array_filter(array_map('trim', explode("\n", $descMarkup)));
print_r($features);
