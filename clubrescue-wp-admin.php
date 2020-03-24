<?php
	/** Step 2 (from text above). */
	add_action( 'admin_menu', 'CRWP_menu' );

	/** Step 1. */
	function CRWP_menu() {
		add_options_page( 'C.R-WP', 'C.R-WP', 'manage_options', 'cr-wp', 'CRWP_options' );
	}

    function CRWP_options()
    {
        ?>
            <div class="wrap">
            <div id="icon-options-general" class="icon32"></div>
           
            <!-- run the settings_errors() function here. -->
            <?php settings_errors(); ?>
            <h1>Club.Rescue-WordPress</h1>
           
            <?php
                $active_tab = "shortcodes";
                if(isset($_GET["tab"]))
                {
                    if($_GET["tab"] == "shortcodes")
                    {
                        $active_tab = "shortcodes";
                    }
                    else
                    {
                        $active_tab = "database";
                    }
                }
            ?>
           
            <h2 class="nav-tab-wrapper">
                <a href="?page=cr-wp&tab=shortcodes" class="nav-tab <?php if($active_tab == 'shortcodes'){echo 'nav-tab-active';} ?> "><?php _e('Shortcodes', 'sandbox'); ?></a>
                <a href="?page=cr-wp&tab=database" class="nav-tab <?php if($active_tab == 'database'){echo 'nav-tab-active';} ?>"><?php _e('Database', 'sandbox'); ?></a>
            </h2>

            <form method="post" action="options-general.php?page=resq-wordpress" enctype="multipart/form-data">
                <?php
               
                    settings_fields("header_section");
                   
                    do_settings_sections("CRWP_options");
               
                    submit_button();
                   
                ?>          
            </form>
        </div>
        <?php
    }
/**
            if($_GET["tab"] == "shortcodes")
            {
                echo "De volgende shortcodes zijn beschikbaar om ResQ tabbelen te integereren in Wordpress:"
                echo "[resq_userattributes] geeft alle attributen van het lid weer incl. pasfoto."
                echo "[resq_activiteiten] geeft alle historische en geplande activiteiten van het lid weer."
                echo "[resq_verenigingsdiplomas] geeft alle interne toekenningen van het lid weer."
                echo "[resq_bondsdiplomas] geeft alle externe diploma's en PvB's van het lid weer."
                echo "[resq_bondsfuncties] geeft eventuele bondsfuncties van het lid weer."
                echo "[resq_acties_wijzigen] geeft alle formulieren weer die voor het lid beschikbaar zijn uit de categorie wijzigen."
                echo "[resq_acties_strandbewaking] geeft alle formulieren weer die voor het lid beschikbaar zijn uit de categorie strandbewaking."
                echo "[resq_acties_kader] geeft alle formulieren weer die voor het lid beschikbaar zijn uit de categorie kader."
                echo "[resq_declaraties_inkopen] geeft alle door het lid ingediende declaraties weer uit de categorie inkopen."
                echo "[resq_declaraties_reiskosten] geeft alle door het lid ingediende declaraties weer uit de categorie reiskosten."
                echo "[resq_declaraties_overtochten] geeft alle door het lid ingediende declaraties weer uit de categorie overtochten."
            }
**/
    add_action("admin_menu", "add_new_menu_items");
	
/**
    function display_options()
    {
        add_settings_section("header_section", "Header Options", "display_header_options_content", "theme-options");

        if(isset($_GET["tab"]))
        {
            if($_GET["tab"] == "header-options")
            {
                add_settings_field("header_logo", "Logo Url", "display_logo_form_element", "theme-options", "header_section");
                register_setting("header_section", "header_logo");

                add_settings_field("background_picture", "Picture File Upload", "background_form_element", "theme-options", "header_section");
                register_setting("header_section", "background_picture", "handle_file_upload");
            }
            else
            {
                add_settings_field("advertising_code", "Ads Code", "display_ads_form_element", "theme-options", "header_section");      
                register_setting("header_section", "advertising_code");
            }
        }
        else
        {
            add_settings_field("header_logo", "Logo Url", "display_logo_form_element", "theme-options", "header_section");
            register_setting("header_section", "header_logo");
           
            add_settings_field("background_picture", "Picture File Upload", "background_form_element", "theme-options", "header_section");
            register_setting("header_section", "background_picture", "handle_file_upload");
        }
       
    }

    function handle_file_upload($options)
    {
        if(!empty($_FILES["background_picture"]["tmp_name"]))
        {
            $urls = wp_handle_upload($_FILES["background_picture"], array('test_form' => FALSE));
            $temp = $urls["url"];
            return $temp;  
        }

        return get_option("background_picture");
    }


    function display_header_options_content(){echo "The header of the theme";}
    function background_form_element()
    {
        ?>
            <input type="file" name="background_picture" id="background_picture" value="<?php echo get_option('background_picture'); ?>" />
            <?php echo get_option("background_picture"); ?>
        <?php
    }
    function display_logo_form_element()
    {
        ?>
            <input type="text" name="header_logo" id="header_logo" value="<?php echo get_option('header_logo'); ?>" />
        <?php
    }
    function display_ads_form_element()
    {
        ?>
            <input type="text" name="advertising_code" id="advertising_code" value="<?php echo get_option('advertising_code'); ?>" />
        <?php
    }

    add_action("admin_init", "display_options");
**/
?>