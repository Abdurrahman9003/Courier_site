<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Model {

    public function send() {	
		// Load form validation library
        $this->load->library('form_validation');
        
        // Validate form fields
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('message', 'Message', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed
            echo "Validation failed";
            return;
        }

        // Get reCAPTCHA response token
        $recaptchaResponse = $this->input->post('g-recaptcha-response');
        $secretKey = '6LdkVHwqAAAAAIB9qL264df_wHn2k3WOUvtKU026';

        // Verify reCAPTCHA response
        $verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaResponse");
        $responseData = json_decode($verifyResponse);

        // Log the reCAPTCHA response for debugging
        log_message('debug', 'reCAPTCHA response: ' . json_encode($responseData));

        if ($responseData && $responseData->success) {
            // reCAPTCHA verified, save the form data
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'subject' => $this->input->post('subject'),
                'message' => $this->input->post('message')
            );

            // Insert data into the database
            if ($this->db->insert('Contact', $data)) {
                echo "ok";  // Return success message to AJAX
            } else {
                // Database insertion failed
                log_message('error', 'Database insert failed');
                echo "An error occurred while saving data. Please try again.";
            }
        } else {
            // reCAPTCHA verification failed
            log_message('error', 'reCAPTCHA verification failed: ' . json_encode($responseData));
            echo "reCAPTCHA verification failed. Please try again.";
        }
    }
}
?>



