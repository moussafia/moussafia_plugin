<?php 
/*
Plugin Name:  moussafia plugin
Plugin URI: http://www.moussafia.com
Description: je suis une apprenante a Youcode et c'est mon 1er plugin 
Version: 1.0
Author: moussafia mohammed
Author URI: http://www.moussafia.com
*/

// Ajouter le menu du plugin dans l'administration
add_action('admin_menu', 'mon_plugin_menu');
function mon_plugin_menu() {
    add_menu_page('moussafia plugin', 'moussafia plugin', 'manage_options', 'mon-plugin', 'mon_plugin_page', 'dashicons-admin-plugins');
  
    add_action('wp_dashboard_setup', 'mon_plugin_add_dashboard_widget');
  }
  
// Ajouter la page de paramètres du plugin
function mon_plugin_page() {
	?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />

    <div class="flex justify-center items-center w-screen h-screen bg-white">
        
        <div class="container mx-auto my-4 px-4 lg:px-20">
    
            <div class="w-full p-8 my-4 md:px-12 lg:w-9/12 lg:pl-20 lg:pr-40 mr-auto rounded-2xl shadow-2xl">
                <div class="flex">
                    <h1 class="font-bold uppercase text-5xl">Send us a <br /> message</h1>
                </div>                  
    
<!--     
    
    <form >
    <input type="hidden" name="action" value="mon_plugin_submit_form">
        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 mt-5">
          <input class="w-full bg-gray-100 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline"
            type="text" placeholder="First Name*" name="first_name"  />
      
          <input class="w-full bg-gray-100 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline"
            type="text" placeholder="Last Name*" name="last_name"  />
      
          <input class="w-full bg-gray-100 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline"
            type="email" placeholder="Email*" name="email"  />

          <input class="w-full bg-gray-100 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline"
            type="text" placeholder="Sujet*" name="sujet"  />
        </div>
      
        <div class="my-4">
          <textarea placeholder="Message*" class="w-full h-32 bg-gray-100 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline" name="message" ></textarea>
        </div>
      
        <div class="my-2 w-1/2 lg:w-1/4">
          <button class="uppercase text-sm font-bold tracking-wide bg-blue-900 text-gray-100 p-3 rounded-lg w-full focus:outline-none focus:shadow-outline" type="submit">
            Send Message
          </button>
        </div>
      
      </form>
	 -->








      
<form action="<?php echo admin_url('admin-post.php'); ?>" method="post" id="contact-form">
  <div class="relative z-0 w-full mb-6 group">
      <input type="email"  name="email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
      <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
  </div>
  <div class="grid md:grid-cols-2 md:gap-6">
    <div class="relative z-0 w-full mb-6 group">
        <input type="text" name="first_name" id="floating_first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="floating_first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">First name</label>
    </div>
    <div class="relative z-0 w-full mb-6 group">
        <input type="text" name="sujet" id="floating_last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="floating_last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Sujet</label>
    </div>
  </div>
  <div class="grid md:grid-cols-2 md:gap-6">
    <div class="relative z-0 w-full mb-6 group">
        <textarea type="text" name="message" id="floating_company" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required ></textarea>
        <label for="floating_company" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">message</label>
    </div>
  </div>
  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Send Message
</button>
</form>

    </div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
<script>
  window.addEventListener('DOMContentLoaded', function() {

const form = document.getElementById('contact-form');

const firstName = form.elements["first_name"];
const lastName = form.elements["last_name"];
const email = form.elements["email"];
const message = form.elements["message"];

form.addEventListener("submit", function(event) {
  let valid = true;
  // Check first name
  if (!firstName.value.match(/^[A-Za-z]+$/)) {
    firstName.classList.add("border", "border-red-500");
    valid = false;
  } else {
    firstName.classList.remove("border", "border-red-500");
  }

  // Check last name
  if (!lastName.value.match(/^[A-Za-z]+$/)) {
    lastName.classList.add("border", "border-red-500");
    valid = false;
  } else {
    lastName.classList.remove("border", "border-red-500");
  }

  // Check email
  if (!email.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
    email.classList.add("border", "border-red-500");
    valid = false;
  } else {
    email.classList.remove("border", "border-red-500");
  }

  // Check message
  if (!message.value.match(/^[A-Za-z]+$/)) {
    message.classList.add("border", "border-red-500");
    valid = false;
  } else {
    message.classList.remove("border", "border-red-500");
  }

  if (!valid) {
    event.preventDefault();
  }
});



  });
</script>
	<?php
}


add_action('admin_post_mon_plugin_submit_form', 'mon_plugin_handle_form_submission');
function mon_plugin_handle_form_submission() {
    global $wpdb;

    $nom = sanitize_text_field($_POST['first_name']) . ' ' . sanitize_text_field($_POST['last_name']);
    $email = sanitize_email($_POST['email']);
    $sujet = sanitize_text_field($_POST['sujet']);
    $message = sanitize_textarea_field($_POST['message']);
    $date = current_time('mysql');

    // Validation using regular expressions
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
add_action('admin_notices', 'mon_plugin_display_message');
function mon_plugin_display_message() {
  if(isset($_GET['message']) && $_GET['message'] == 'sent') {
    ?>
        <div class="notice notice-success is-dismissible">
          <p><?php _e('Message sent successfully!', 'mon-plugin'); ?></p>
        </div>
        <?php
    }
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
        echo '<th>' . __('Message', 'mon-plugin') . '</th>';
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


function mon_plugin_add_dashboard_widget() {
  wp_add_dashboard_widget('mon_plugin_dashboard_widget', 'moussafia Plugin Messages', 'mon_plugin_dashboard_widget');
}

