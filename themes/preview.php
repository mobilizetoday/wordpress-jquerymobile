<?php
if ( !defined('ABSPATH') ) {
	/** Set up WordPress environment */
	require_once(__DIR__.'/../../../../wp-load.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>jQMobile Preview</title>
	<?php wp_head(); ?>
</head>
<body>
<div data-role="page">
	<div class="ui-content ui-body-c" data-theme="c" data-form="ui-body-c" data-role="content" role="main">

		<p>Sample text and <a class="ui-link" data-form="ui-body-a" href="#" data-theme="a">links</a>.</p>

		<div data-role="fieldcontain">
		    <fieldset data-role="controlgroup">
			<li data-swatch="a" class="ui-li ui-li-divider ui-btn ui-bar-a ui-corner-top" data-role="list-divider" role="" data-form="ui-bar-a">List Header</li>

				<input type="radio" name="radio-choice-a" id="radio-choice-1-a" value="choice-1" checked="checked" />
				<label for="radio-choice-1-a" data-form="ui-btn-up-a" class="ui-corner-none">Radio 1</label>

				<input type="radio" name="radio-choice-a" id="radio-choice-2-a" value="choice-2"  />
				<label for="radio-choice-2-a" data-form="ui-btn-up-a">Radio 2</label>

				<input type="checkbox" name="checkbox-1" id="checkbox-1" class="custom" checked="checked" />
				<label for="checkbox-1" data-form="ui-btn-up-a">Checkbox</label>

		    </fieldset>
		</div>

		<div data-role="fieldcontain">
			<fieldset data-role="controlgroup" data-type="horizontal">
				<input type="radio" name="radio-view-a" id="radio-view-a-a" value="list" checked="checked"/>
				<label for="radio-view-a-a" data-form="ui-btn-up-a">On</label>
				<input type="radio" name="radio-view-a" id="radio-view-b-a" value="grid"  />
				<label for="radio-view-b-a" data-form="ui-btn-up-a">Off</label>
			</fieldset>
		</div>

		<div data-role="fieldcontain">
			<select name="select-choice-1" id="select-choice-1" data-native-menu="false" data-theme="a" data-form="ui-btn-up-a">
				<option value="standard">Option 1</option>
				<option value="rush">Option 2</option>
				<option value="express">Option 3</option>
				<option value="overnight">Option 4</option>
			</select>
		</div>

		<input type="text" value="Text Input" class="input" data-form="ui-body-a" />

		<div data-role="fieldcontain">
			<input type="range" name="slider" value="0" min="0" max="100" data-form="ui-body-a" data-theme="a" />
		</div>

		<button data-icon="star" data-theme="a" data-form="ui-btn-up-a">Button</button>
	</div>
</div>
</body>
</html>