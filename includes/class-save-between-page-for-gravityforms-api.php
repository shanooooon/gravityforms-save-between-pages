<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if (class_exists("GFForms")) {

	GFForms::include_addon_framework();

	class Save_Between_Pages_for_GravityForms_API extends GFAddOn {

		/**
		 * Set variables
		 */
		protected $_version                  = "0.1.0";
		protected $_min_gravityforms_version = "1.7.9999";
		protected $_slug                     = "Save_Between_Pages_for_GravityForms";
		protected $_title                    = "Save Between Pages for Gravity Forms";
		protected $_short_title              = "Save Between Pages";

		/**
		 * Frontend initiates
		 */
		public function init_frontend(){
            parent::init_frontend();

            // Start Session
			if(!session_id()) {
				session_start();
			}

			// Add Actions
			$this->add_actions();
        } // END init_frontend ()

		/**
		 * Lights, camera, ACTION
		 */
		private function add_actions () {
			add_action( 'gform_post_paging', array( $this, 'post_paging' ), 10, 3 );
			add_action( 'gform_after_submission', array( $this, 'after_submission' ), 10, 2 );
		} // End add_actions ()

		/**
		 * Add the user's form entry data
		 */
		private function add_entry ( $entry ) {
			$this->delete_entry( $entry['form_id'] );
			$entry_id = GFAPI::add_entry( $entry );
			$_SESSION[ 'gform_sayg_entry_id_' . $entry['form_id'] ] = $entry_id;
		} // END add_entry ()

		/**
		 * Action: After form entry created
		 */
		public function after_submission ( $entry, $form ) {
			if ( isset($_SESSION[ 'gform_sayg_entry_id_' . $form['id'] ]) ) {
				$this->update_entry($entry);
				$this->delete_entry( $form['id'] );
			}
		} // END after_submission ()

		/**
		 * Create settings fields
		 */
        public function form_settings_fields($form) {
            return array(
                array(
                    "title"  => "Save Between Pages for Gravity Forms",
                    "fields" => array(
                        array(
                            "label"   => "Save Between Pages",
                            "type"    => "checkbox",
                            "name"    => "progressively_save",
                            "tooltip" => "Progressively save user the entries on multi-page forms between each page",
                            "choices" => array(
                                array(
                                    "label" => "Enabled",
                                    "name"  => "progressively_save"
                                )
                            )
                        ),
                    )
                )
            );
        } // END form_settings_fields ()

		/**
		 * Delete entry
		 */
		private function delete_entry ( $form_id ) {
			$entry_id = ( isset( $_SESSION[ 'gform_sayg_entry_id_' . $form_id ] ) ) ? $_SESSION[ 'gform_sayg_entry_id_' . $form_id ] : NULL;
			$deleted_entry = GFAPI::delete_entry( $entry_id );
			unset( $_SESSION[ 'gform_sayg_entry_id_' . $form_id ] );
		} // END delete_entry ()

		/**
		 * Build Entry Object
		 */
		private function get_entry ( $form ) {
			global $post;
			$entry['form_id']    = $form['id'];
			$entry['user_agent'] = RGForms::get( 'HTTP_USER_AGENT', $_SERVER );
			$entry['post_id']    = $post->ID;
			foreach ($_POST as $key => $value) {
				if ( strpos($key, 'input_') !== FALSE ) {
					$field_id = str_replace( '_', '.', str_replace( 'input_', '', $key ) );
					$entry[ (string) $field_id ] = $value;
				}
			}
			return $entry;
		} // END get_entry ()

		/**
		 * Action: Posting between form pages
		 */
		public function post_paging ( $form, $source_page_number, $current_page_number ) {
			$this->tidy_up( $form['id'] );
			$settings = $this->get_form_settings($form);
			if ( isset( $settings['progressively_save'] ) && $settings['progressively_save'] ) {
				$entry = $this->get_entry( $form );
				if ( !isset($_SESSION[ 'gform_sayg_entry_id_' . $form['id'] ]) ) {
					$this->add_entry($entry);
				} else {
					$this->update_entry($entry);
				}
			}
		} // END post_paging ()

		/**
		 * Tidy Up sessions and unwated entries
		 */
		private function tidy_up ( $form_id ) {
			$entry_id = ( isset( $_SESSION[ 'gform_sayg_entry_id_' . $form_id ] ) ) ? $_SESSION[ 'gform_sayg_entry_id_' . $form_id ] : NULL;
			$entry = GFAPI::get_entry( $entry_id );
			if ( is_wp_error($entry) ) {
				$this->delete_entry( $form_id );
			}
		} // END tidy_up ()

		/**
		 * Update the user's form entry data
		 */
		private function update_entry ( $entry ) {
			$entry_id = ( isset( $_SESSION[ 'gform_sayg_entry_id_' . $entry['form_id'] ] ) ) ? $_SESSION[ 'gform_sayg_entry_id_' . $entry['form_id'] ] : NULL;
			$updated_entry = GFAPI::update_entry( $entry, $entry_id );
		} // END update_entry ()
	}

}