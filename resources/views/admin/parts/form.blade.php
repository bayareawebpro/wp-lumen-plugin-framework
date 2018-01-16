<h2><?php esc_attr_e( 'Form Elements: Fieldset and Input Field', 'wp_admin_style' ); ?></h2>

<fieldset>
    <legend class="screen-reader-text"><span>Fieldset Example</span></legend>
    <label for="users_can_register">
        <input name="" type="checkbox" id="users_can_register" value="1" />
        <span><?php esc_attr_e( 'Checkbox description with legend class .screen-reader-text', 'wp_admin_style' ); ?></span>
    </label>
</fieldset>

<fieldset>
    <legend class="screen-reader-text"><span>input type="radio"</span></legend>
    <label title='g:i a'>
        <input type="radio" name="example" value="" />
        <span><?php esc_attr_e( 'Radio description with legend class .screen-reader-text', 'wp_admin_style' ); ?></span>
    </label><br>
    <label title='g:i a'>
        <input type="radio" name="example" value="" />
        <span><?php esc_attr_e( 'Radio description #2 with legend class .screen-reader-text', 'wp_admin_style' ); ?></span>
    </label>
</fieldset>

<h2><?php esc_attr_e( 'Form Elements: Input Fields', 'wp_admin_style' ); ?></h2>

<input type="text" value=".regular-text" class="regular-text" /><br>
<input type="text" value=".small-text" class="small-text" /><br>
<input type="text" value=".large-text" class="large-text" /><br>
<input type="text" value=".all-options" class="all-options" /><br>
<input type="text" value="This is what text looks like here…" class="regular-text" />
<span class="description"><?php esc_attr_e( 'This is a description for a form element.', 'wp_admin_style' ); ?></span><br>
<input type="text" value="…and text formatted as code." class="regular-text code" /><br>

<h2><?php esc_attr_e( 'Form Elements: Select', 'wp_admin_style' ); ?></h2>

<select name="" id="">
    <option selected="selected" value="">Example option</option>
    <option value="">Example option</option>
</select>


<h2><?php esc_attr_e( 'Form Elements: Textarea', 'wp_admin_style' ); ?></h2>

<textarea id="" name="" cols="80" rows="10">no class</textarea><br>
<textarea id="" name="" cols="80" rows="10" class="large-text">.large-text</textarea><br>
<textarea id="" name="" cols="80" rows="10" class="all-options">.all-options</textarea>


<ul>
    <li><code>checked( $checked, $current = TRUE, $echo = TRUE );</code></li>
    <li><code>selected( $selected, $current = TRUE, $echo = TRUE );</code></li>
    <li><code>disabled( $disabled, $current = TRUE, $echo = TRUE );</code></li>
</ul>

<?php
$checked = $selected = $disabled = $value = NULL;
?>
<input type="checkbox" value="1" name="checkbox" <?php checked( $value, '1', TRUE ); ?> /><br>
<select name="select">
    <option value="1" <?php selected( $value, '1', TRUE ); ?>>1</option>
    <option value="2" <?php selected( $value, '2', TRUE ); ?>>2</option>
    <option value="3" <?php selected( $value, '3', TRUE ); ?>>3</option>
    <option value="4" <?php selected( $value, '4', TRUE ); ?>>4</option>
    <option value="5" <?php selected( $value, '5', TRUE ); ?>>5</option>
</select><br>
<input type="text" name="disabled_textbox" <?php disabled( $value, 'disabled', TRUE ); ?> />


