<?php

namespace hasscms\base\ui\widgets;

use Yii;
use yii\bootstrap\Alert;

class ActiveForm extends \yii\bootstrap\ActiveForm {
	public function init() {
		parent::init ();
		$alertClass = "alert" . "-" . $this->options['id'];
		Alert::begin ( [
				'options' => [
						'class' => 'hide alert-dismissable ' . $alertClass
				],
				'closeButton' => [ ]
		] );
		echo '<p>Alert!</p>';
		Alert::end ();


		$js = <<<JS
$('form#{$this->options['id']}').on('beforeSubmit', function(e, form) {
 	var form = $(form);
	if(form.find('.has-error').length) {
		return false;
	}
	$.ajax({
		url: form.attr('action'),
		type: 'post',
		data: form.serialize(),
		success: function(response) {

			if(response['error'] == true){
				$('.$alertClass').addClass('alert-danger');
				$('.$alertClass i').addClass(' fa-ban');
			} else {
				$('.$alertClass').addClass('alert-success');
				$('.$alertClass i').addClass(' fa-check');
			}

			$('.$alertClass p').html(response['message']);
			$('.$alertClass').removeClass('hide');
		}
	});
  return false;
}).on('submit', function(e){
    e.preventDefault();
});
JS;
		$this->view->registerJs ( $js );
	}

}