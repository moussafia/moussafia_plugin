<?php 
/*
Plugin Name:  contacts-plugin
Plugin URI: http://www.moussafia.com
Description: Développez un plugin avec WordPress
Version: 1.2.23
Author: moussafia mohammed
Author URI: http://www.moussafia.com
*/


// Ajouter le menu du plugin dans l'administration
add_action('admin_menu', 'mon_plugin_menu');
function mon_plugin_menu() {
    add_menu_page('contacts-plugin',// The title of the page
     'contacts-plugin', //The text to display in the menu.
     'manage_options', //The minimum user capability required to access the page.
      'mon-plugin', //he slug for the menu item.
      'mon_plugin_page', //The function that displays the content of the page.
       'dashicons-admin-plugins' //The icon that will be displayed next to the menu item.
    );
  
    add_action('wp_dashboard_setup', 'mon_plugin_add_dashboard_widget');
  }

  
// Ajouter la page de paramètres du plugin
function mon_plugin_page() {
	?>
<script src="https://cdn.tailwindcss.com"></script>

<div class="flex justify-center w-full">

    <div class="container mx-auto my-4 px-4 lg:px-20">

        <div class="w-full p-3 my-2 md:px-12 lg:w-9/12 lg:pl-20 lg:pr-40 mr-auto rounded-2xl ">
            <div class="flex pb-8 justify-center">
                <h5 class="font-serif font-bold  text-2xl">Send us a message</h5>
            </div>
            <form action="<?php echo admin_url('admin-post.php'); ?>" method="post" id="contact-form">
            <input type="hidden" name="action" value="mon_plugin_submit_form">
                <div class="relative z-0 w-full mb-6 group">
                    <label for="floating_email" class="">Your email</label>
                    <input type="email" name="email" id="email" class="w-full py-2.5 px-0" required>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-6 group">
                        <label for="floating_your_name">Your name</label>
                        <input type="text" name="your_name" id="your_name" class="block py-2.5 px-0 w-full "
                         required>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <label for="floating_last_name" class="mb-2">Sujet</label>
                        <input type="text" name="sujet" id="sujet" class="block py-2.5 px-0 w-full"
                         required>
                    </div>
                </div>
                <div class="grid ">
                    <div class="relative z-0 w-full mb-6 group">
                        <label for="floating_company" class="">message</label>
                        <textarea type="text" name="message" id="message" class="block py-2.5 px-0 w-full"
                         required></textarea>
                    </div>
                </div>
                <div class="flex justify-center">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Send
                        Message
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .fail{
        border-color: red !important;
    }
    </style>
<script>

    const form = document.getElementById('contact-form');

    const firstName = form.elements["your_name"];
    const email = form.elements["email"];
    const sujet = form.elements['sujet']
    const message = form.elements["message"];
    form.addEventListener("submit", function(event) {
        let valid = true;
        // Check first name
        if (!firstName.value.match(/^[A-Za-z\s]+$/)) {
            firstName.classList.add("fail");
            valid = false;
        } else {
            firstName.classList.remove("fail");
        }

        // Check email
        if (!email.value.match(/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/)) {
            email.classList.add("fail");
            valid = false;
        } else {
            email.classList.remove("fail");
        }
        // Check sujet
        if (!sujet.value.match(/^[A-Za-z\s]+$/)) {
            message.classList.add("fail");
            valid = false;
        } else {
            message.classList.remove("fail");
        }


        // Check message
        if (!message.value.match(/^[A-Za-z0-9\s.,!?]+$/)) {
            message.classList.add("fail");
            valid = false;
        } else {
            message.classList.remove("fail");
        }
        if (valid==false) {
            event.preventDefault();
        }
    });


</script>
<?php
}


add_action('admin_post_mon_plugin_submit_form', 'mon_plugin_handle_form_submission');
function mon_plugin_handle_form_submission() {
    global $wpdb;

    $nom = sanitize_text_field($_POST['your_name']);
    $email = sanitize_email($_POST['email']);
    $sujet = sanitize_text_field($_POST['sujet']);
    $message = sanitize_textarea_field($_POST['message']);
    $date = current_time('mysql');

    // // Validation using regular expressions
    if (!preg_match('/^[a-zA-Z\s]+$/', $nom) && !preg_match('/^[a-zA-Z\s]+$/', $sujet) && !preg_match('/^[a-zA-Z\s]+$/', $message)) {
       
    }
    $table_name = $wpdb->prefix . 'mon_plugin_messages';

    $wpdb->insert(
        $table_name,
        array(
            'nom' => $nom,
            'email' => $email,
            'sujet' => $sujet,
            'message' => $message,
            'date' => $date,
            )
    );

    wp_redirect(admin_url('admin.php?page=mon-plugin&message=sent'));
    exit;
}

// Display message after form submission
add_action('admin_notices', 'display_message_succes');
function display_message_succes() {
  if(isset($_GET['message']) && $_GET['message'] == 'sent') {
    ?>
<div class="notice notice-success is-dismissible">
    <p><?php _e('Message sent successfully!', 'mon-plugin'); ?></p>
</div>
<?php
    }
  }
 

function mon_plugin_add_dashboard_widget() {
  wp_add_dashboard_widget('mon_plugin_dashboard_widget',//a unique ID for the widget.
   'moussafia Plugin Messages', //the name or title of the widget
   'mon_plugin_dashboard_widget'// the name of the function that will generate the widget's content.
);
}

function mon_plugin_dashboard_widget() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'mon_plugin_messages';
    $results = $wpdb->get_results("SELECT * FROM $table_name");

    if (!empty($results)) {
        echo '<table class="wp-list-table widefat fixed striped">';
        echo '<thead><tr>';
        echo '<th>' . __('ID', 'mon-plugin') . '</th>';
        echo '<th>' . __('Name', 'mon-plugin') . '</th>';
        echo '<th>' . __('Email', 'mon-plugin') . '</th>';
        echo '<th>' . __('Subject', 'mon-plugin') . '</th>';
        echo '<th>' . __('Message', 'mon-plugin') . '</th>'; //load_plugin_textdomain(text,text-domaine)
        echo '<th>' . __('Date', 'mon-plugin') . '</th>';
        echo '</tr></thead><tbody>';

        foreach ($results as $row) {
            echo '<tr>';
            echo '<td>' . $row->id . '</td>';
            echo '<td>' . $row->nom . '</td>';
            echo '<td>' . $row->email . '</td>';
            echo '<td>' . $row->sujet . '</td>';
            echo '<td>' . $row->message . '</td>';
            echo '<td>' . $row->date . '</td>';
            echo '</tr>';
        }

        echo '</tbody></table>';
    } else {
        echo '<p>' . __('No messages found.', 'mon-plugin') . '</p>';
    }
}
// Add the shortcode for the contact form
function contact_us_plugin_shortcode() {
    ob_start();
    mon_plugin_page();
    return ob_get_clean();
}
add_shortcode( 'contact_us_form', 'contact_us_plugin_shortcode' );