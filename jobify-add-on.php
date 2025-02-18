<?php

/*
Plugin Name: WP All Import - Jobify Add-On
Plugin URI: http://www.wpallimport.com/
Description: Supporting imports into the Jobify theme.
Version: 1.0.9
Author: Soflyy
*/


include "rapid-addon.php";

$jobify_addon = new RapidAddon( 'Jobify Add-On', 'jobify_addon' );

$jobify_addon->disable_default_images();

$jobify_addon->add_field(
	'_job_location',
	'Location',
	'radio',
	array(
		'search_by_address' => array(
			'Search by Address',
			$jobify_addon->add_options(
				$jobify_addon->add_field(
					'job_address',
					'Job Address',
					'text'
				),
				'Google Geocode API Settings',
				array(
					$jobify_addon->add_field(
						'address_geocode',
						'Request Method',
						'radio',
						array(
							'address_no_key' => array(
								'No API Key',
								'Limited number of requests.'
							),
							'address_google_developers' => array(
								'Google Maps Standard API Key - <a href="https://developers.google.com/maps/documentation/geocoding/get-api-key#key">Get free API key</a>',
								$jobify_addon->add_field(
									'address_google_developers_api_key',
									'API Key',
									'text'
								),
								'Up to 2500 requests per day and 5 requests per second.'
							),
							'address_google_for_work' => array(
								'Google Maps Premium Client ID & Digital Signature - <a href="https://developers.google.com/maps/premium/">Sign up for Google Maps Premium Plan</a>',
								$jobify_addon->add_field(
									'address_google_for_work_client_id',
									'Google Maps Premium Client ID',
									'text'
								),
								$jobify_addon->add_field(
									'address_google_for_work_digital_signature',
									'Google Maps Premium Digital Signature',
									'text'
								),
								'Up to 100,000 requests per day and 10 requests per second'
							)
						) // end Request Method options array
					), // end Request Method nested radio field

				) // end Google Geocode API Settings fields
			) // end Google Gecode API Settings options panel
		), // end Search by Address radio field
		'search_by_coordinates' => array(
			'Search by Coordinates',
			$jobify_addon->add_field(
				'job_lat',
				'Latitude',
				'text',
				null,
				'Example: 34.0194543'
			),
			$jobify_addon->add_options(
				$jobify_addon->add_field(
					'job_lng',
					'Longitude',
					'text',
					null,
					'Example: -118.4911912'
				),
				'Google Geocode API Settings',
				array(
					$jobify_addon->add_field(
						'coord_geocode',
						'Request Method',
						'radio',
						array(
							'coord_no_key' => array(
								'No API Key',
								'Limited number of requests.'
							),
							'coord_google_developers' => array(
								'Google Maps Standard API Key - <a href="https://developers.google.com/maps/documentation/geocoding/get-api-key#key">Get free API key</a>',
								$jobify_addon->add_field(
									'coord_google_developers_api_key',
									'API Key',
									'text'
								),
								'Up to 2500 requests per day and 5 requests per second.'
							),
							'coord_google_for_work' => array(
								'Google Maps Premium Client ID & Digital Signature - <a href="https://developers.google.com/maps/premium/">Sign up for Google Maps Premium Plan</a>',
								$jobify_addon->add_field(
									'coord_google_for_work_client_id',
									'Google Maps Premium Client ID',
									'text'
								),
								$jobify_addon->add_field(
									'coord_google_for_work_digital_signature',
									'Google Maps Premium Digital Signature',
									'text'
								),
								'Up to 100,000 requests per day and 10 requests per second'
							)
						) // end Geocode API options array
					), // end Geocode nested radio field

				) // end Geocode settings
			) // end coordinates Option panel
		) // end Search by Coordinates radio field
	) // end Job Location radio field
);

$jobify_addon->add_field( '_company_name', 'Company Name', 'text' );

$jobify_addon->add_field( '_company_tagline', 'Company Tagline', 'text' );

$jobify_addon->add_field( '_company_description', 'Company Description', 'text' );

$jobify_addon->add_field( '_application', 'Application Email or URL', 'text', null, 'This field is required for the "application" area to appear beneath the listing.');

$jobify_addon->add_field( '_company_website', 'Company Website', 'text' );

$jobify_addon->add_field( '_company_logo', 'Company Logo', 'image');

$jobify_addon->add_field( 'company_featured_image', 'Featured Image', 'image');

// field is _company_video, will 'image' add_field support videos?

$jobify_addon->add_field( 'video_type', 'Company Video', 'radio',
    array(
        'external' => array(
            'Externally Hosted',
            $jobify_addon->add_field( '_company_video_url', 'Video URL', 'text')
        ),
        'local' => array(
            'Locally Hosted',
            $jobify_addon->add_field( '_company_video_id', 'Upload Video', 'file')
)));

$jobify_addon->add_field( '_job_expires', 'Listing Expiry Date', 'text', null, 'Import date in any strtotime compatible format.');

$jobify_addon->add_field( '_filled', 'Filled', 'radio',
    array(
        '0' => 'No',
        '1' => 'Yes'
    ),
    'Filled listings will no longer accept applications.'
);

$jobify_addon->add_field( '_featured', 'Featured Listing', 'radio',
    array(
        '0' => 'No',
        '1' => 'Yes'
    ),
    'Featured listings will be sticky during searches, and can be styled differently.'
);

$jobify_addon->add_options(
        null,
        'Social Media Options',
        array(
            $jobify_addon->add_field( '_company_facebook', 'Company Facebook', 'text' ),
            $jobify_addon->add_field( '_company_twitter', 'Company Twitter', 'text' ),
            $jobify_addon->add_field( '_company_linkedin', 'Company LinkedIn', 'text' ),
            $jobify_addon->add_field( '_company_google', 'Company Google+', 'text' ),
        )
);

$jobify_addon->set_import_function( 'jobify_addon_import' );

$jobify_addon->admin_notice(
    'The Jobify Add-On requires WP All Import <a href="http://www.wpallimport.com/order-now/?utm_source=free-plugin&utm_medium=dot-org&utm_campaign=jobify" target="_blank">Pro</a> or <a href="http://wordpress.org/plugins/wp-all-import" target="_blank">Free</a>, and the <a href="https://astoundify.com/go/wp-all-import-buy-jobify/">Jobify</a> theme.',
    array(
        'themes' => array( 'Jobify' )
) );

$jobify_addon->run( array(
        'themes' => array( 'Jobify' ),
        'post_types' => array( 'job_listing' )
) );

function jobify_addon_import( $post_id, $data, $import_options, $article ) {

    global $jobify_addon;

    // all fields except for slider and image fields
    $fields = array(
        '_company_name',
        '_company_tagline',
        '_company_description',
        '_application',
        '_company_website',
        '_filled',
        '_featured',
        '_company_facebook',
        '_company_twitter',
        '_company_linkedin',
        '_company_google'
    );

    // update everything in fields arrays
    foreach ( $fields as $field ) {

        if ( empty( $article['ID'] ) or $jobify_addon->can_update_meta( $field, $import_options ) ) {

            update_post_meta( $post_id, $field, $data[$field] );

        }
    }

    // set featured image
    $field = 'company_featured_image';

    if ( empty( $article['ID'] ) or $jobify_addon->can_update_image( $import_options ) ) {

        $attachment_id = $data[$field]['attachment_id'];

        set_post_thumbnail( $post_id, $attachment_id );

        $url = wp_get_attachment_url( $attachment_id );

        update_post_meta( $post_id, '_featured_image', $url );

    }

    // update logo
    $fields = array(
        '_company_logo',
    );

    if ( empty( $article['ID'] ) or $jobify_addon->can_update_image( $import_options ) ) {

        foreach ( $fields as $field ) {

            $attachment_id = $data[$field]['attachment_id'];

            $url = wp_get_attachment_url( $attachment_id );

            update_post_meta( $post_id, $field, $url );

        }

    }

    // update video

    if ( empty( $article['ID'] ) or $jobify_addon->can_update_meta( '_company_video', $import_options ) ) {

        if ( $data['video_type'] == 'external' ) {

            update_post_meta( $post_id, '_company_video', $data['_company_video_url'] );

        } elseif ( $data['video_type'] == 'local' ) {

            $attachment_id = $data['_company_video_id']['attachment_id'];

            $url = wp_get_attachment_url( $attachment_id );

            update_post_meta( $post_id, '_company_video', $url );
        }
    }


    // update listing expiration date
    $field = '_job_expires';

    $date = $data[$field];

    $date = strtotime( $date );

    if ( empty( $article['ID'] ) or $jobify_addon->can_update_meta( $field, $import_options ) ) {

        if ( !empty( $date ) ) {

            $date = date( 'Y-m-d', $date );

            update_post_meta( $post_id, $field, $date );

        }

    }

    // update job location
	$field   = 'job_address';
	
	// Define fields so that no error log entries are generated later.
	$latitude = null;
	$longitude = null;
	$formatted_address = null;
	$street_number = null;
	$street = null;
	$city = null;
	$state_short = null;
	$state_long = null;
	$zip = null;
	$country_short = null;
	$country_long = null;
	$job_location = null;
	$api_key = null;
	$geo_status = null;
	$geocoding_failed = false;

    $address = $data[$field];

    $lat  = $data['job_lat'];

    $long = $data['job_lng'];

    //  build search query
    if ( $data['_job_location'] == 'search_by_address' ) {

    	$search = ( !empty( $address ) ? 'address=' . rawurlencode( $address ) : null );

    } else {

    	$search = ( !empty( $lat ) && !empty( $long ) ? 'latlng=' . rawurlencode( $lat . ',' . $long ) : null );

    }

    // build api key
    if ( $data['_job_location'] == 'search_by_address' ) {

    	if ( $data['address_geocode'] == 'address_google_developers' && !empty( $data['address_google_developers_api_key'] ) ) {

	        $api_key = '&key=' . $data['address_google_developers_api_key'];

	    } elseif ( $data['address_geocode'] == 'address_google_for_work' && !empty( $data['address_google_for_work_client_id'] ) && !empty( $data['address_google_for_work_signature'] ) ) {

	        $api_key = '&client=' . $data['address_google_for_work_client_id'] . '&signature=' . $data['address_google_for_work_signature'];

	    }

    } else {

    	if ( $data['coord_geocode'] == 'coord_google_developers' && !empty( $data['coord_google_developers_api_key'] ) ) {

	        $api_key = '&key=' . $data['coord_google_developers_api_key'];

	    } elseif ( $data['coord_geocode'] == 'coord_google_for_work' && !empty( $data['coord_google_for_work_client_id'] ) && !empty( $data['coord_google_for_work_signature'] ) ) {

	        $api_key = '&client=' . $data['coord_google_for_work_client_id'] . '&signature=' . $data['coord_google_for_work_signature'];

	    }

    }

	// Store _job_location value for later use

    if ( $data['_job_location'] == 'search_by_address' ) {

    	$job_location = $address;

    } else {

    	$job_location = $lat . ', ' . $long;

    }

    // if all fields are updateable and $search has a value
    if (  empty( $article['ID'] ) or ( $jobify_addon->can_update_meta( $field, $import_options ) && $jobify_addon->can_update_meta( '_job_location', $import_options ) && !empty ( $search ) ) ) {

		// build $request_url for api call
        $request_url = 'https://maps.googleapis.com/maps/api/geocode/json?' . $search . $api_key;
        $curl        = curl_init();

        curl_setopt( $curl, CURLOPT_URL, $request_url );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );

        $jobify_addon->log( '- Getting location data from Geocoding API: '.$request_url );

        $json = curl_exec( $curl );

        curl_close( $curl );

        // parse api response
        if ( !empty( $json ) ) {

			$details = json_decode( $json, true );
			
			if ( array_key_exists( 'status', $details ) ) {
				if ( $details['status'] == 'INVALID_REQUEST' || $details['status'] == 'ZERO_RESULTS' || $details['status'] == 'REQUEST_DENIED' ) {
					$geocoding_failed = true;
					goto invalidrequest;
				}
			}

            $address_data = array();

			foreach ( $details['results'][0]['address_components'] as $type ) {
				// Went for type_name here to try to make the if statement a bit shorter,
				// and hopefully clearer as well
				$type_name = $type['types'][0];

				if ($type_name == "administrative_area_level_1" || $type_name == "administrative_area_level_2" || $type_name == "country") {
					// short_name & long_name must be stored for these three field types, as
					// the short & long names are stored by WP Job Manager
					$address_data[ $type_name . "_short_name" ] = $type['short_name'];
					$address_data[ $type_name . "_long_name" ] = $type['long_name'];
				} else {
					// The rest of the data from Google Maps can be returned in long format,
					// as the other fields only store data in that format
					$address_data[ $type_name ] = $type['long_name'];
				}

			}

			// It's a long list, but this is what WP Job Manager stores in the database
			$geo_status = ($details['status'] == "ZERO_RESULTS") ? 0 : 1;

			$latitude  = $details['results'][0]['geometry']['location']['lat'];

            $longitude = $details['results'][0]['geometry']['location']['lng'];

        	$formatted_address = $details['results'][0]['formatted_address'];

			$street_number = $address_data['street_number'];

			$street = $address_data['route'];

        	$city = $address_data['locality'];

        	$country_short = $address_data['country_short_name'];

			$country_long = $address_data['country_long_name'];

        	$zip = $address_data['postal_code'];

			// Important because the "geolocation_state_short" & "geolocation_state_long" fields
			// can get data from "administrative_area_level_1" or "administrative_area_level_2",
			// depending on the address that's provided
			$state_short = !empty( $address_data['administrative_area_level_1_short_name'] ) ? $address_data['administrative_area_level_1_short_name'] : $address_data['administrative_area_level_2_short_name'];

			$state_long = !empty( $address_data['administrative_area_level_1_long_name'] ) ? $address_data['administrative_area_level_1_long_name'] : $address_data['administrative_area_level_2_long_name'];

			// Checks for empty location elements

        	if ( empty( $zip ) ) {

			    $jobify_addon->log( '<b>WARNING:</b> Google Maps has not returned a Postal Code for this job location.' );

        	}

        	if ( empty( $country_short ) && empty( $country_long ) ) {

			    $jobify_addon->log( '<b>WARNING:</b> Google Maps has not returned a Country for this job location.' );

        	}

        	if ( empty( $state_short ) && empty( $state_long ) ) {

			    $jobify_addon->log( '<b>WARNING:</b> Google Maps has not returned a State for this job location.' );

        	}

        	if ( empty( $city ) ) {

			    $jobify_addon->log( '<b>WARNING:</b> Google Maps has not returned a City for this job location.' );

        	}

        	if ( empty( $street_number ) ) {

			    $jobify_addon->log( '<b>WARNING:</b> Google Maps has not returned a Street Number for this job location.' );

        	}

        	if ( empty( $street ) ) {

			    $jobify_addon->log( '<b>WARNING:</b> Google Maps has not returned a Street Name for this job location.' );

        	}

        } else {
			$jobify_addon->log( '<b>WARNING:</b> Could not retrieve response data from Google Maps API.' );
		}

    }

    // List of location fields to update
	$fields = array(
		'geolocation_lat' => $latitude,
		'geolocation_long' => $longitude,
		'geolocation_formatted_address' => $formatted_address,
		'geolocation_street_number' => $street_number,
		'geolocation_street' => $street,
		'geolocation_city' => $city,
		'geolocation_state_short' => $state_short,
		'geolocation_state_long' => $state_long,
		'geolocation_postcode' => $zip,
		'geolocation_country_short' => $country_short,
		'geolocation_country_long' => $country_long,
		'_job_location' => $job_location
	);

    $jobify_addon->log( '- Updating location data' );

	// Check if "geolocated" field should be created or deleted
	if ($geo_status == "0") {
		delete_post_meta( $post_id, "geolocated" );
	} elseif ($geo_status == "1") {
		update_post_meta( $post_id, "geolocated", $geo_status );
	} else {
		// Do nothing, it's possible that we didn't get a response from the Google Maps API
	}

    foreach ( $fields as $key => $value ) {

        if ( ( empty( $article['ID'] ) or $jobify_addon->can_update_meta( $key, $import_options ) ) && !is_null($value) ) {
			// If the field can be updated, and the value isn't NULL, update the field
            update_post_meta( $post_id, $key, $value );
        } elseif ( empty( $article['ID'] ) or $jobify_addon->can_update_meta( $key, $import_options ) ) {
			// Else, if the value for the field returns NULL, delete the field
			delete_post_meta( $post_id, $key, $value );
		} else {
			// Else, do nothing
		}
	}
	
	invalidrequest:

	if ( $geocoding_failed ) {
		delete_post_meta( $post_id, "geolocated" );
		$jobify_addon->log( "WARNING Geocoding failed with the status: " . $details['status'] );
		if ( array_key_exists( 'error_message', $details ) ) {
			$jobify_addon->log( "WARNING Geocoding error message: " . $details['error_message'] );
		}
	}

}

add_action( 'pmxi_before_post_import', 'wpai_jobify_ensure_location_data_is_imported', 10, 1 );

function wpai_jobify_ensure_location_data_is_imported ($import_id) {

	$import = new PMXI_Import_Record();
	$import_object = $import->getById($import_id);
	$post_type = $import_object->options['custom_type'];
	
	if ($post_type == "job_listing") {
		remove_all_actions('job_manager_job_location_edited');
	}

}