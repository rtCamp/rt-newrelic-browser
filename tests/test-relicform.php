<?php

class RelicFormValidateTest extends WP_UnitTestCase {

	function test_form_validation_1() {
		$relic_object = new Rt_Newrelic();
		$relic_data = array(
		'relic-account-email' => 'rohan.veer@rtcamp.com',
		'relic-first-name' => 'rohan123',
		'relic-last-name' => 'veer',
		'rtp-relic-form-submit' => 'submit',
		'relic-account-name' => 'test',
		'rtp-relic-form-name' => 'rtp-add-account'
		);
		$validation_array = $relic_object->rtp_relic_validate_form( $relic_data );
		$this->assertEquals( FALSE, $validation_array['valid'] );
		}

	function test_form_validation_2() {
		$relic_object = new Rt_Newrelic();
		$relic_data = array(
		'relic-account-email' => 'rohan.veer@rtcamp.com',
		'relic-first-name' => 'rohan',
		'relic-last-name' => 'veer',
		'rtp-relic-form-submit' => 'submit',
		'relic-account-name' => 'test',
		'rtp-relic-form-name' => 'rtp-add-account'
		);
		$validation_array = $relic_object->rtp_relic_validate_form( $relic_data );
		$this->assertEquals( TRUE, $validation_array['valid'] );
		}

	function test_form_validation_3() {
		$relic_object = new Rt_Newrelic();
		$relic_data = array(
		'relic-account-email' => 'rohan.veer@rtcamp.com',
		'relic-first-name' => 'rohan',
		'relic-last-name' => 'veer12',
		'rtp-relic-form-submit' => 'submit',
		'relic-account-name' => 'test',
		'rtp-relic-form-name' => 'rtp-add-account'
		);
		$validation_array = $relic_object->rtp_relic_validate_form( $relic_data );
		$this->assertEquals( FALSE, $validation_array['valid'] );
		}

	function test_form_validation_4() {
		$relic_object = new Rt_Newrelic();
		$relic_data = array(
		'relic-account-email' => 'rohan.@veer@rtcamp.com',
		'relic-first-name' => 'rohan',
		'relic-last-name' => 'veer',
		'rtp-relic-form-submit' => 'submit',
		'relic-account-name' => 'test',
		'rtp-relic-form-name' => 'rtp-add-account'
		);
		$validation_array = $relic_object->rtp_relic_validate_form( $relic_data );
		$this->assertEquals( FALSE, $validation_array['valid'] );
		}

	function test_form_validation_5() {
		$relic_object = new Rt_Newrelic();
		$relic_data = array(
		'relic-account-email' => 'rohan.veer@rtcamp.com',
		'relic-first-name' => 'rohan',
		'relic-last-name' => 'veer',
		'rtp-relic-form-submit' => 'submit',
		'relic-account-name' => '',
		'rtp-relic-form-name' => 'rtp-add-account'
		);
		$validation_array = $relic_object->rtp_relic_validate_form( $relic_data );
		$this->assertEquals( FALSE, $validation_array['valid'] );
		}

}

