<?php
class Editor {
    /**
     * shows the editor
     * @param type $replaceWith the form element to replace it with the editor
     * usualy a <textarea> element  
     */
    public static function show($replaceWith)
    {
       echo "
                <script type='text/javascript'>
                    //<![CDATA[
                            CKEDITOR.replace( '".$replaceWith."',
                                                {
                                                    fullPage : true,
                                                    extraPlugins : 'docprops'
                                                });
                    //]]>
		</script>
            ";
    }
}
?>
