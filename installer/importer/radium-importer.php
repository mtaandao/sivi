<?php

/**
 * Class Radium_Theme_Importer
 *
 * This class provides the capability to import demo content as well as import widgets and Mtaandao menus
 *
 * @since 2.2.0
 *
 * @category RadiumFramework
 * @package  NewsCore MN
 * @author   Franklin M Gitonga
 * @link     http://radiumthemes.com/
 *
 */
class Radium_Theme_Importer {

	/**
	 * Holds a copy of the object for easy reference.
	 *
	 * @since 2.2.0
	 *
	 * @var object
	 */
	public $theme_options_file;

	/**
	 * Holds a copy of the object for easy reference.
	 *
	 * @since 2.2.0
	 *
	 * @var object
	 */
	public $widgets;

	/**
	 * Holds a copy of the object for easy reference.
	 *
	 * @since 2.2.0
	 *
	 * @var object
	 */
	public $content_demo;

	/**
	 * Flag imported to prevent duplicates
	 *
	 * @since 2.2.0
	 *
	 * @var object
	 */
	public $flag_as_imported = array();

    /**
     * Holds a copy of the object for easy reference.
     *
     * @since 2.2.0
     *
     * @var object
     */
    private static $instance;

    /**
     * Constructor. Hooks all interactions to initialize the class.
     *
     * @since 2.2.0
     */
    public function __construct() {

        self::$instance = $this;
        
        $this->theme_options_file = $this->demo_files_path . $this->theme_options_file_name;
        $this->widgets = $this->demo_files_path . $this->widgets_file_name;
        $this->content_demo = $this->demo_files_path . $this->content_demo_file_name;
		 
        add_action( 'admin_menu', array($this, 'add_admin') );

    }

	/**
	 * Add Panel Page
	 *
	 * @since 2.2.0
	 */
    public function add_admin() {

        add_submenu_page('panel', "Import Demo Data", "Import Demo Data", 'switch_themes', 'radium_demo_installer', array($this, 'demo_installer'));

    }

    /**
     * [demo_installer description]
     *
     * @since 2.2.0
     *
     * @return [type] [description]
     */
    public function demo_installer() {

        ?>
        <div class="admin-panel">
			<div class="top-nav">
				<div class="logo"></div>
				<div class="right-info"></div>
				<div class="clear"></div>
			</div>
			<div class="admin-panel-content full-content installer-content">
				<h2>Import Demo Data</h2>
				<div id="form-div">
				   <div id="icon-tools" class="icon32"><br></div>
						
						<!--<div class="weblusivepanel-item" style="margin-bottom:20px">
							<h3>General information</h3>
							<div class="option-item">
							<p class="tie_message_hint">Importing demo data (post, pages, images, theme settings, ...) is the easiest way to setup your theme. It will
							allow you to quickly edit everything instead of creating content from scratch. When you import the data following things will happen:</p>

							  <ul style="padding-left: 20px;list-style-position: inside;list-style-type: square;}">
								  <li>No existing posts, pages, categories, images, custom post types or any other data will be deleted or modified .</li>
								  <li>No Mtaandao settings will be modified .</li>
								  <li>Posts, pages, some images, some widgets and menus will get imported .</li>
								  <li>Images will be downloaded from our server, these images are copyrighted and are for demo use only .</li>
								  <li>Please click import only once and wait, it can take a couple of minutes</li>
							  </ul>
							 </div>
						 </div>-->
						<h3>Installation</h3>
						<div class="info2"><p class="tie_message_hint">You can skip any step of the 3 following options. In case if you want everything imported - 
						please make sure to follow the steps sequence.</p></div>
						<form method="post">
							<input type="hidden" name="demononce" value="<?php echo mn_create_nonce('radium-demo-code'); ?>" />
							<div class="weblusivepanel-item installer-block">
								<h3>Install Demo Content</h3>
								<div class="option-item">
									<span class="label">Sample content (Step 1)</span>
									<select name="scimporttype" class="mpanel-select">
										<option value="">Choose one</option>
										<option value="visualcomposer">Regular version (Visual composer) </option>
										<option value="regular">Regular version (native shortcode generator)</option>
									</select>
									<input name="scimport" class="mpanel-save mpanel-proceed" type="submit" value="Proceed" />
									<?php $success = isset($_SESSION['step1']) ? $_SESSION['step1'] : ''; if ($success == 'success'):?>
										<div class="message warning"><p>You have already imported the sample content</p></div>
									<?php endif?>
								</div>
								<div class="option-item">
									<span class="label">Theme panel options (Step 2)</span>
									<input name="tpoimport" class="mpanel-save mpanel-proceed" type="submit" value="Proceed" />
									<?php $success = isset($_SESSION['step2']) ? $_SESSION['step2'] : ''; if ($success == 'success'):?>
										<div class="message warning"><p>You have already imported the theme panel sample data</p></div>
									<?php endif?>
								</div>
								<div class="option-item">
									<span class="label">Sample widgets (Step 3)</span>
									<input name="swimport" class="mpanel-save mpanel-proceed" type="submit" value="Proceed" />
									<?php $success = isset($_SESSION['step3']) ? $_SESSION['step3'] : ''; if ($success == 'success'):?>
										<div class="message warning"><p>You have already imported the sample widgets</p></div>
									<?php endif?>
								</div>
							</div>
						</form>
				</div>
			</div>
		</div> 
        <?php
		
		$scimport = isset($_REQUEST['scimport']) ? $_REQUEST['scimport'] : '';
		$tpoimport = isset($_REQUEST['tpoimport']) ? $_REQUEST['tpoimport'] : '';
		$swimport = isset($_REQUEST['swimport']) ? $_REQUEST['swimport'] : '';
		$scimporttype = isset($_REQUEST['scimporttype']) ? $_REQUEST['scimporttype'] : '';
		
        if('Proceed' == $scimport && check_admin_referer('radium-demo-code' , 'demononce')){
			if($scimporttype == ''){
				$_SESSION['step1'] = 'error';
				echo '<div class="message error installer-message"><p>You must choose the type of sample content to import to proceed.</p></div>';
			}
			else{
				$this->content_demo = $this->demo_files_path.$scimporttype.'/'.$this->content_demo_file_name;
				$this->set_demo_data( $this->content_demo );
				$this->set_demo_menus();
				$_SESSION['step1'] = 'success';
				echo '<div class="message success installer-message"><p>Sample content imported successfully.</p></div>';
			}
        }
		if('Proceed' == $tpoimport && check_admin_referer('radium-demo-code' , 'demononce')){
		
			$this->set_demo_theme_options( $this->theme_options_file ); //import before widgets incase we need more sidebars
			$_SESSION['step2'] = 'success';
			echo '<div class="message success installer-message"><p>Admin panel sample data imported successfully.</p></div>';
        }
		if('Proceed' == $swimport && check_admin_referer('radium-demo-code' , 'demononce')){
		
			$this->process_widget_import_file( $this->widgets );
			$_SESSION['step3'] = 'success';
			echo '<div class="message success installer-message"><p>Sample widgets imported successfully.</p></div>';
        }			

    }

    /**
     * add_widget_to_sidebar Import sidebars
     * @param  string $sidebar_slug    Sidebar slug to add widget
     * @param  string $widget_slug     Widget slug
     * @param  string $count_mod       position in sidebar
     * @param  array  $widget_settings widget settings
     *
     * @since 2.2.0
     *
     * @return null
     */
    public function add_widget_to_sidebar($sidebar_slug, $widget_slug, $count_mod, $widget_settings = array()){

        $sidebars_widgets = get_option('sidebars_widgets');

        if(!isset($sidebars_widgets[$sidebar_slug]))
           $sidebars_widgets[$sidebar_slug] = array('_multiwidget' => 1);

        $newWidget = get_option('widget_'.$widget_slug);

        if(!is_array($newWidget))
            $newWidget = array();

        $count = count($newWidget)+1+$count_mod;
        $sidebars_widgets[$sidebar_slug][] = $widget_slug.'-'.$count;

        $newWidget[$count] = $widget_settings;

        update_option('sidebars_widgets', $sidebars_widgets);
        update_option('widget_'.$widget_slug, $newWidget);

    }

    public function set_demo_data( $file ) {

	    if ( !defined('MN_LOAD_IMPORTERS') ) define('MN_LOAD_IMPORTERS', true);

        require_once ABSPATH . 'admin/includes/import.php';

        $importer_error = false;

        if ( !class_exists( 'MN_Importer' ) ) {

            $class_mn_importer = ABSPATH . 'admin/includes/class-mn-importer.php';
	
            if ( file_exists( $class_mn_importer ) ){

                require_once($class_mn_importer);

            } else {

                $importer_error = true;

            }

        }

        if ( !class_exists( 'MN_Import' ) ) {

            $class_mn_import = dirname( __FILE__ ) .'/mtaandao-importer.php';

            if ( file_exists( $class_mn_import ) ) 
                require_once($class_mn_import);
            else
                $importer_error = true;

        }

        if($importer_error){

            die("Error on import");

        } else {
			
            if(!is_file( $file )){

                echo "The XML file containing the dummy content is not available or could not be read .. You might want to try to set the file permission to chmod 755.<br/>If this doesn't work please use the Wordpress importer and import the XML file (should be located in your download .zip: Sample Content folder) manually ";

            } else {

               $mn_import = new MN_Import();
               $mn_import->fetch_attachments = true;
               $mn_import->import( $file );

         	}

    	}

    }

    public function set_demo_menus() {
	
		$locations = get_theme_mod( 'nav_menu_locations' ); // registered menu locations in theme
		$menus = mn_get_nav_menus(); // registered menus
		print_r ($menus);
		if($menus) {
			foreach($menus as $menu) { // assign menus to theme locations
				if( $menu->name == 'Primary navigation' ) {
					$locations['primary_nav'] = $menu->term_id;
				} else if( $menu->name == 'Footer navigation' ) {
					$locations['footer_nav'] = $menu->term_id;
				} else if( $menu->name == 'Top' ) {
					$locations['top_navigation'] = $menu->term_id;
				}
			}
		}
		 
		set_theme_mod('nav_menu_locations', $locations); // set menus to locations 
	
	}

    public function set_demo_theme_options( $file ) {

    	// File exists?
		if ( ! file_exists( $file ) ) {
			mn_die(
				__( 'Theme options Import file could not be found. Please try again.', 'radium' ),
				'',
				array( 'back_link' => true )
			);
		}

		// Get file contents and decode
		$data = file_get_contents( $file );
		
		$data = unserialize(base64_decode( $data));
		
		//$data = unserialize( trim($data, '###') );

		// Have valid data?
		// If no data or could not decode
		if ( empty( $data ) ) {
			mn_die(
				__( 'Theme options import data could not be read. Please try a different file.', 'radium' ),
				'',
				array( 'back_link' => true )
			);
		}

		// Hook before import
		//$data = apply_filters( 'radium_theme_import_theme_options', $data );

		//update_option($this->theme_option_name, $data);
		$refresh = 0;
		weblusive_save_settings ($data , $refresh );

    }

    /**
     * Available widgets
     *
     * Gather site's widgets into array with ID base, name, etc.
     * Used by export and import functions.
     *
     * @since 2.2.0
     *
     * @global array $mn_registered_widget_updates
     * @return array Widget information
     */
    function available_widgets() {

    	global $mn_registered_widget_controls;

    	$widget_controls = $mn_registered_widget_controls;

    	$available_widgets = array();

    	foreach ( $widget_controls as $widget ) {

    		if ( ! empty( $widget['id_base'] ) && ! isset( $available_widgets[$widget['id_base']] ) ) { // no dupes

    			$available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
    			$available_widgets[$widget['id_base']]['name'] = $widget['name'];

    		}

    	}

    	return apply_filters( 'radium_theme_import_widget_available_widgets', $available_widgets );

    }


    /**
     * Process import file
     *
     * This parses a file and triggers importation of its widgets.
     *
     * @since 2.2.0
     *
     * @param string $file Path to .wie file uploaded
     * @global string $widget_import_results
     */
    function process_widget_import_file( $file ) {

    	// File exists?
    	if ( ! file_exists( $file ) ) {
    		mn_die(
    			__( 'Widget Import file could not be found. Please try again.', 'radium' ),
    			'',
    			array( 'back_link' => true )
    		);
    	}

    	// Get file contents and decode
    	$data = file_get_contents( $file );
    	$data = json_decode( $data );

    	// Delete import file
    	//unlink( $file );

    	// Import the widget data
    	// Make results available for display on import/export page
    	$this->widget_import_results = $this->import_widgets( $data );

    }


    /**
     * Import widget JSON data
     *
     * @since 2.2.0
     * @global array $mn_registered_sidebars
     * @param object $data JSON widget data from .wie file
     * @return array Results array
     */
    public function import_widgets( $data ) {

    	global $mn_registered_sidebars;

    	// Have valid data?
    	// If no data or could not decode
    	if ( empty( $data ) || ! is_object( $data ) ) {
    		mn_die(
    			__( 'Widget import data could not be read. Please try a different file.', 'radium' ),
    			'',
    			array( 'back_link' => true )
    		);
    	}

    	// Hook before import
    	$data = apply_filters( 'radium_theme_import_widget_data', $data );

    	// Get all available widgets site supports
    	$available_widgets = $this->available_widgets();

    	// Get all existing widget instances
    	$widget_instances = array();
    	foreach ( $available_widgets as $widget_data ) {
    		$widget_instances[$widget_data['id_base']] = get_option( 'widget_' . $widget_data['id_base'] );
    	}

    	// Begin results
    	$results = array();

    	// Loop import data's sidebars
    	foreach ( $data as $sidebar_id => $widgets ) {

    		// Skip inactive widgets
    		// (should not be in export file)
    		if ( 'mn_inactive_widgets' == $sidebar_id ) {
    			continue;
    		}

    		// Check if sidebar is available on this site
    		// Otherwise add widgets to inactive, and say so
    		if ( isset( $mn_registered_sidebars[$sidebar_id] ) ) {
    			$sidebar_available = true;
    			$use_sidebar_id = $sidebar_id;
    			$sidebar_message_type = 'success';
    			$sidebar_message = '';
    		} else {
    			$sidebar_available = false;
    			$use_sidebar_id = 'mn_inactive_widgets'; // add to inactive if sidebar does not exist in theme
    			$sidebar_message_type = 'error';
    			$sidebar_message = __( 'Sidebar does not exist in theme (using Inactive)', 'radium' );
    		}

    		// Result for sidebar
    		$results[$sidebar_id]['name'] = ! empty( $mn_registered_sidebars[$sidebar_id]['name'] ) ? $mn_registered_sidebars[$sidebar_id]['name'] : $sidebar_id; // sidebar name if theme supports it; otherwise ID
    		$results[$sidebar_id]['message_type'] = $sidebar_message_type;
    		$results[$sidebar_id]['message'] = $sidebar_message;
    		$results[$sidebar_id]['widgets'] = array();

    		// Loop widgets
    		foreach ( $widgets as $widget_instance_id => $widget ) {

    			$fail = false;

    			// Get id_base (remove -# from end) and instance ID number
    			$id_base = preg_replace( '/-[0-9]+$/', '', $widget_instance_id );
    			$instance_id_number = str_replace( $id_base . '-', '', $widget_instance_id );

    			// Does site support this widget?
    			if ( ! $fail && ! isset( $available_widgets[$id_base] ) ) {
    				$fail = true;
    				$widget_message_type = 'error';
    				$widget_message = __( 'Site does not support widget', 'radium' ); // explain why widget not imported
    			}

    			// Filter to modify settings before import
    			// Do before identical check because changes may make it identical to end result (such as URL replacements)
    			$widget = apply_filters( 'radium_theme_import_widget_settings', $widget );

    			// Does widget with identical settings already exist in same sidebar?
    			if ( ! $fail && isset( $widget_instances[$id_base] ) ) {

    				// Get existing widgets in this sidebar
    				$sidebars_widgets = get_option( 'sidebars_widgets' );
    				$sidebar_widgets = isset( $sidebars_widgets[$use_sidebar_id] ) ? $sidebars_widgets[$use_sidebar_id] : array(); // check Inactive if that's where will go

    				// Loop widgets with ID base
    				$single_widget_instances = ! empty( $widget_instances[$id_base] ) ? $widget_instances[$id_base] : array();
    				foreach ( $single_widget_instances as $check_id => $check_widget ) {

    					// Is widget in same sidebar and has identical settings?
    					if ( in_array( "$id_base-$check_id", $sidebar_widgets ) && (array) $widget == $check_widget ) {

    						$fail = true;
    						$widget_message_type = 'warning';
    						$widget_message = __( 'Widget already exists', 'radium' ); // explain why widget not imported

    						break;

    					}

    				}

    			}

    			// No failure
    			if ( ! $fail ) {

    				// Add widget instance
    				$single_widget_instances = get_option( 'widget_' . $id_base ); // all instances for that widget ID base, get fresh every time
    				$single_widget_instances = ! empty( $single_widget_instances ) ? $single_widget_instances : array( '_multiwidget' => 1 ); // start fresh if have to
    				$single_widget_instances[] = (array) $widget; // add it

    					// Get the key it was given
    					end( $single_widget_instances );
    					$new_instance_id_number = key( $single_widget_instances );

    					// If key is 0, make it 1
    					// When 0, an issue can occur where adding a widget causes data from other widget to load, and the widget doesn't stick (reload wipes it)
    					if ( '0' === strval( $new_instance_id_number ) ) {
    						$new_instance_id_number = 1;
    						$single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
    						unset( $single_widget_instances[0] );
    					}

    					// Move _multiwidget to end of array for uniformity
    					if ( isset( $single_widget_instances['_multiwidget'] ) ) {
    						$multiwidget = $single_widget_instances['_multiwidget'];
    						unset( $single_widget_instances['_multiwidget'] );
    						$single_widget_instances['_multiwidget'] = $multiwidget;
    					}

    					// Update option with new widget
    					update_option( 'widget_' . $id_base, $single_widget_instances );

    				// Assign widget instance to sidebar
    				$sidebars_widgets = get_option( 'sidebars_widgets' ); // which sidebars have which widgets, get fresh every time
    				$new_instance_id = $id_base . '-' . $new_instance_id_number; // use ID number from new widget instance
    				$sidebars_widgets[$use_sidebar_id][] = $new_instance_id; // add new instance to sidebar
    				update_option( 'sidebars_widgets', $sidebars_widgets ); // save the amended data

    				// Success message
    				if ( $sidebar_available ) {
    					$widget_message_type = 'success';
    					$widget_message = __( 'Imported', 'radium' );
    				} else {
    					$widget_message_type = 'warning';
    					$widget_message = __( 'Imported to Inactive', 'radium' );
    				}

    			}

    			// Result for widget instance
    			$results[$sidebar_id]['widgets'][$widget_instance_id]['name'] = isset( $available_widgets[$id_base]['name'] ) ? $available_widgets[$id_base]['name'] : $id_base; // widget name or ID if name not available (not supported by site)
    			$results[$sidebar_id]['widgets'][$widget_instance_id]['title'] = isset($widget->title) ? $widget->title : __( 'No Title', 'radium' ); // show "No Title" if widget instance is untitled
    			$results[$sidebar_id]['widgets'][$widget_instance_id]['message_type'] = $widget_message_type;
    			$results[$sidebar_id]['widgets'][$widget_instance_id]['message'] = $widget_message;

    		}

    	}

    	// Hook after import
    	do_action( 'radium_theme_import_widget_after_import' );

    	// Return results
    	return apply_filters( 'radium_theme_import_widget_results', $results );

    }

}

?>