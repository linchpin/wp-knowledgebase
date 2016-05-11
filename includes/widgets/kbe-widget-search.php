<?php
/*===============
    KBE Search Articles Widget
 ===============*/
 
//========= Custom Knowledgebase Search Widget
add_action( 'widgets_init', 'kbe_search_widgets' );
function kbe_search_widgets() {
    register_widget( 'kbe_Search_Widget' );
}

//========= Custom Knowledgebase Search Widget Body
class kbe_Search_Widget extends WP_Widget {
    
    //=======> Widget setup
    function __construct() {
        parent::__construct(
            'kbe_search_widget', // Base ID
            __( 'Knowledgebase Search', 'kbe' ), // Name
            array(
                'description' => __('WP Knowledgebase search widget', 'kbe'), 
                'classname' => 'kbe'
            )
        );
    }
        
  //=======> How to display the widget on the screen.
    function widget($args, $widgetData) {
        
        //=======> Our variables from the widget settings.
        $kbe_widget_search_title = $widgetData['txtKbeSearchHeading'];
        
        //=======> widget body
        echo $args['before_widget'];
        echo '<div class="kbe_widget">';
        
        if($kbe_widget_search_title){
            echo '<h2>'.$kbe_widget_search_title.'</h2>';
        }
    ?>
        <form role="search" method="get" id="searchform" class="clearfix" action="<?php echo home_url( '/' ); ?>" autocomplete="off">
            <input type="text" onfocus="if (this.value == '<?php _e("Search Articles...", "kbe") ?>') {this.value = '';}" onblur="if (this.value == '')  {this.value = '<?php _e("Search Articles...", "kbe") ?>';}" value="<?php _e("Search Articles...", "kbe") ?>" name="s" id="s" />
            <input type="hidden" name="post_type" value="kbe_knowledgebase" />
        </form>
    <?php
        echo "</div>";
        echo $args['after_widget'];
    }
    
    //Update the widget 
    function update($new_widgetData, $old_widgetData) {
        $widgetData = $old_widgetData;
        //Strip tags from title and name to remove HTML 
        $widgetData['txtKbeSearchHeading'] = $new_widgetData['txtKbeSearchHeading'];
        return $widgetData;
    }
    
    function form($widgetData) {
        //Set up some default widget settings.
        $widgetData = wp_parse_args((array) $widgetData, array(
            'txtKbeSearchHeading' => '',
        ));
?>
        <p>
            <label for="<?php echo $this->get_field_id('txtKbeSearchHeading'); ?>"><?php _e('Title:'); ?></label>
            <input id="<?php echo $this->get_field_id('txtKbeSearchHeading'); ?>" class="widefat" name="<?php echo $this->get_field_name('txtKbeSearchHeading'); ?>" value="<?php echo $widgetData['txtKbeSearchHeading']; ?>" />
        </p>
<?php
    }
}
?>