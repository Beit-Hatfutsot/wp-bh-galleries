var $ = jQuery,
	BH_upload = (function() {

		var self = {};

		/**
		 * params
		 */
		var params = {

			// step1
			max_img_width				: 1280,
			max_img_height				: 1280,
			thumb_width					: 300,
			thumb_height				: 300,

			tmp_resized_img				: '',
			tmp_thumbnail				: '',
			tmp_resized_img_width		: '',
			tmp_resized_img_height		: '',

			ias							: '',

			ias_browser_support_msg		: 'The File APIs are not fully supported in this browser',
			ias_file_type_msg			: 'Please upload an image file',
			step1_upload_failed_msg		: 'Upload has been failed, please try again',
			step1_upload_success_msg	: 'Upload completed successfully',

			resized_img					: '',
			thumbnail					: '',

			// step2
			name						: '',
			email						: '',
			country						: '',
			subjects					: '',
			unassigned_subjects			: '',
			title						: '',
			year						: '',
			description					: '',

			// step 3
			institution					: '',
			city						: '',
			coordinator_name			: '',
			coordinator_email			: '',
			age							: '',

		};

		/**
		 * init
		 *
		 * @since		1.0.0
		 * @param		N/A
		 * @return		N/A
		 */
		self.init = function() {

			initStep1();
			initStep2();
			initStep3();

			// trigger steps actions
			$('.btn-submit-step1 .submit-step').click(step1);
			$('.btn-submit-step2 .submit-step').click(step2);
			$('.btn-submit-step3 .submit-step').click(step3);
			$('.btn-submit-step4 .submit-step').click(step4);

			$('.btn-submit .clear').click(function() {

				var className = $(this).parent('.btn-submit').attr('class');

				if (className != 'btn-submit btn-submit-step1') {
					transition(1);
				}

				setTimeout(function(){

					switch (className) {
						case 'btn-submit btn-submit-step4' :
							clearStep(4);

						case 'btn-submit btn-submit-step3' :
							clearStep(3);

						case 'btn-submit btn-submit-step2' :
							clearStep(2);

						case 'btn-submit btn-submit-step1' :
							clearStep(1);
					}

					// other content to remove
					clearStep('other');

				}, BH_general.params.duration);

			});

			// fancybox
			var target = $('.terms-label').next()[0];

			$('a#terms-link').fancybox({
				type			: 'inline',
				width			: 550,
				height			: 'auto',
				autoDimensions	: false,
				centerOnScroll	: true,
				onClosed		: function() {
					$('.terms-label').after(target);
				}
			});

		};

		/**
		 * initStep1
		 *
		 * @since		1.0.0
		 * @param		N/A
		 * @return		N/A
		 */
		var initStep1 = function() {

			// upload image file - drag & drop
			var dropTarget = document.getElementById('drag-drop-area');

			dropTarget.addEventListener('dragover',		dragOver,			false);
			dropTarget.addEventListener('dragleave',	dragLeave,			false);
			dropTarget.addEventListener('drop',			fileDragDropSelect,	false);

			// upload image file - browse
			$('.step1 #browse-button').click(function(){
				$('.step1 input[type="file"]').trigger('click');
			});
			document.getElementById('fileToUpload').addEventListener('change', fileBrowseSelect, false);

		};

		/**
		 * initStep2
		 *
		 * @since		1.0.0
		 * @param		N/A
		 * @return		N/A
		 */
		var initStep2 = function() {

			// init form chosen fields
			$('.step2 .chosen-select').chosen({
				enable_split_word_search	: true,
				search_contains				: true,
				width						: '100%'
			});

			// form validation indicators
			// required input fields
			$('.step2 .field-wrap.required input, .step2 .field-wrap.required textarea').keyup(function() {
				if ($(this).val().length < 3) {
					$(this).parent().find('.glyphicon-remove-circle').removeClass('hidden');
					$(this).parent().find('.glyphicon-ok-circle').addClass('hidden');
				} else {
					$(this).parent().find('.glyphicon-remove-circle').addClass('hidden');
					$(this).parent().find('.glyphicon-ok-circle').removeClass('hidden');
				}

				validate_form(2);
			});

			// validate unassigned subjects field
			$('.step2 input#unassigned_subjects').keyup(function() {
				if ($(this).val().length < 3 && $('select#subject').next().children('ul').children('li.search-choice').length < 1) {
					$('select#subject').parent().find('.glyphicon-remove-circle').removeClass('hidden');
					$('select#subject').parent().find('.glyphicon-ok-circle').addClass('hidden');
				} else {
					$('select#subject').parent().find('.glyphicon-remove-circle').addClass('hidden');
					$('select#subject').parent().find('.glyphicon-ok-circle').removeClass('hidden');
				}

				validate_form(2);
			});

			// required chosen fields
			$('.step2 .chosen-select').on('change', function(evt, params) {
				// multiple select
				if ($(this).next().hasClass('chosen-container-multi')) {
					if ($(this).next().children('ul').children('li.search-choice').length == 1 && params.deselected && $('.step2 input#unassigned_subjects').val().length < 3) {
						$(this).parent().find('.glyphicon-remove-circle').removeClass('hidden');
						$(this).parent().find('.glyphicon-ok-circle').addClass('hidden');

						validate_form(2);

						// return
						return;
					}
				}

				// single select or multiple select with at least 1 value
				$(this).parent().find('.glyphicon-remove-circle').addClass('hidden');
				$(this).parent().find('.glyphicon-ok-circle').removeClass('hidden');

				validate_form(2);
			});

			// update unassigned subjects field value according to chosen:no_results event
			$('.step2 .chosen-select').on('chosen:no_results', function(evt, params) {
				// multiple select
				if ($(this).next().hasClass('chosen-container-multi')) {
					$('.step2 input#unassigned_subjects').parent().slideDown(BH_general.params.duration);
					$('.step2 input#unassigned_subjects').val( $(this).next().find('li.search-field input').val() );

					// validate chosen field according to new value
					if ($('.step2 input#unassigned_subjects').val().length < 3 && $(this).next().children('ul').children('li.search-choice').length < 1) {
						$(this).parent().find('.glyphicon-remove-circle').removeClass('hidden');
						$(this).parent().find('.glyphicon-ok-circle').addClass('hidden');
					} else {
						$(this).parent().find('.glyphicon-remove-circle').addClass('hidden');
						$(this).parent().find('.glyphicon-ok-circle').removeClass('hidden');
					}

					validate_form(2);
				}
			});

			// competition checkbox toggling
			var competition_cb = $('.step2 #competition'),
				competitionStep = $('.step2 .submit-step-next'),
				uploadStep = $('.step2 .submit-step-upload');

			competition_cb.on('change', function() {
				if ($(this).prop('checked')) {
					// expose 'next' button to step 3
					competitionStep.show();
					uploadStep.hide();
				}
				else {
					// expose 'upload' button to step 4
					competitionStep.hide();
					uploadStep.show();
				}
			});

		};

		/**
		 * initStep3
		 *
		 * @since		1.0.0
		 * @param		N/A
		 * @return		N/A
		 */
		var initStep3 = function() {

			// init form chosen fields
			$('.step3 .chosen-select').chosen({
				enable_split_word_search	: true,
				search_contains				: true,
				width						: '100%'
			});

			// form validation indicators
			// required input fields
			$('.step3 .field-wrap.required input').keyup(function() {
				if ($(this).val().length < 3) {
					$(this).parent().find('.glyphicon-remove-circle').removeClass('hidden');
					$(this).parent().find('.glyphicon-ok-circle').addClass('hidden');
				} else {
					$(this).parent().find('.glyphicon-remove-circle').addClass('hidden');
					$(this).parent().find('.glyphicon-ok-circle').removeClass('hidden');
				}

				validate_form(3);
			});

			// required chosen fields
			$('.step3 .chosen-select').on('change', function(evt, params) {
				// single select or multiple select with at least 1 value
				$(this).parent().find('.glyphicon-remove-circle').addClass('hidden');
				$(this).parent().find('.glyphicon-ok-circle').removeClass('hidden');

				validate_form(3);
			});

		};

		/**
		 * step1
		 *
		 * @since		1.0.0
		 * @param		N/A
		 * @return		N/A
		 */
		var step1 = function() {

			$('.btn-submit-step1 .loader').show();

			params.resized_img = params.tmp_resized_img;
			params.thumbnail = params.tmp_thumbnail;

			$('.btn-submit-step1 .loader').hide();
			clearStep(1);
			showMsg(1, params.step1_upload_success_msg);

			transition(2);

		};

		/**
		 * step2
		 *
		 * @since		1.0.0
		 * @param		e (jQuery event)
		 * @return		N/A
		 */
		var step2 = function(e) {

			// store step inputs
			params.name					= $('.step2 input#name').val();
			params.email				= $('.step2 input#email').val();
			params.country				= $('.step2 select#country').val();
			params.subjects				= $('.step2 select#subject').val();
			params.unassigned_subjects	= $('.step2 input#unassigned_subjects').val();
			params.title				= $('.step2 input#title').val();
			params.year					= $('.step2 select#year').val();
			params.description			= $('.step2 #description').val();

			// get target button
			var target = $(e.target);

			if (target.hasClass('submit-step-next')) {
				transition(3);
			}
			else {
				// disable upload button
				$('.btn-submit-step2 .submit-step').unbind('click');

				$('.btn-submit-step2 .loader').show();

				uploadPhoto(2);

				// enable upload button
				$('.btn-submit-step2 .submit-step').click(step2);
			}

		};

		/**
		 * step3
		 *
		 * @since		1.0.0
		 * @param		N/A
		 * @return		N/A
		 */
		var step3 = function() {

			// disable upload button
			$('.btn-submit-step3 .submit-step').unbind('click');

			$('.btn-submit-step3 .loader').show();

			// store step inputs
			params.institution			= $('.step3 input#institution').val();
			params.city					= $('.step3 input#city').val();
			params.coordinator_name		= $('.step3 input#coordinator_name').val();
			params.coordinator_email	= $('.step3 input#coordinator_email').val();
			params.age					= $('.step3 select#age').val();

			uploadPhoto(3);

			// enable upload button
			$('.btn-submit-step3 .submit-step').click(step3);

		};

		/**
		 * step4
		 *
		 * @since		1.0.0
		 * @param		N/A
		 * @return		N/A
		 */
		var step4 = function() {

			$('.btn-submit-step4 .loader').show();

			$('.btn-submit-step4 .loader').hide();

			transition(1);
			clearStep(4);
			clearStep(3);
			clearStep(2);
			clearStep(1);
			clearStep('other');

		};

		/********************/
		/* step 1 functions */
		/********************/

		/**
		 * dragOver
		 *
		 * @since		1.0.0
		 * @param		e (jquery event)
		 * @return		N/A
		 */
		var dragOver = function(e) {

			clearStep(1);
			clearStep('other');

			e.stopPropagation();
			e.preventDefault();
			e.dataTransfer.dropEffect = 'copy';

			$('.step1 #drag-drop-area').addClass('hover');

		};

		/**
		 * dragLeave
		 *
		 * @since		1.0.0
		 * @param		e (jquery event)
		 * @return		N/A
		 */
		var dragLeave = function(e) {

			$('.step1 #drag-drop-area').removeClass('hover');

		};

		/**
		 * fileDragDropSelect
		 *
		 * @since		1.0.0
		 * @param		e (jquery event)
		 * @return		N/A
		 */
		var fileDragDropSelect = function(e) {

			e.stopPropagation();
			e.preventDefault();

			if (window.File && window.FileReader && window.FileList && window.Blob) {

				var files = e.dataTransfer.files;
				if (!fileSelect(files)) {
					showMsg(1, params.ias_file_type_msg);
					$('.step1 #drag-drop-area').removeClass('hover');

					// return
					return false;
				}

				setTimeout(function(){
					$('.btn-submit-step1').slideDown(BH_general.params.duration)
				}, BH_general.params.duration);

				$('.step1 #drag-drop-area').removeClass('hover');

				// return
				return true;

			} else {

				showMsg(1, params.ias_browser_support_msg);

				$('.step1 #drag-drop-area').removeClass('hover');

				// return
				return false;
			}

		};

		/**
		 * fileBrowseSelect
		 *
		 * @since		1.0.0
		 * @param		e (jquery event)
		 * @return		N/A
		 */
		var fileBrowseSelect = function(e) {

			if (window.File && window.FileReader && window.FileList && window.Blob) {

				var files = e.target.files;
				if (!fileSelect(files)) {
					showMsg(1, params.ias_file_type_msg);

					// return
					return false;
				}

				setTimeout(function(){
					$('.btn-submit-step1').slideDown(BH_general.params.duration)
				}, BH_general.params.duration);

				// return
				return true;

			} else {

				//var file = document.getElementById('fileToUpload').value;
				//$('.step1 #filename').html('File name: ' + file);

				showMsg(1, params.ias_browser_support_msg);

				// return
				return false;

			}

		};

		/**
		 * fileSelect
		 *
		 * @since		1.0.0
		 * @param		files (array)
		 * @return		N/A
		 */
		var fileSelect = function(files) {

			var	file,
				result = false;

			for (var i = 0; file = files[i]; i++) {
				// if the file is not an image, continue
				if (!file.type.match('image.*')) {
					continue;
				}

				$('.step1 .drag-drop-inside').hide();

				previewImage(file, $('.step1 .image-preview'));
				previewImage(file, $('.step2 .photo-details-preview'));
				previewImage(file, $('.step3 .photo-details-preview'));
				previewImage(file, $('.step4 .photo-share-preview'));
				resizeImage(file);

				setTimeout(function(){
					initSelection();
				}, BH_general.params.duration * 2);

				result = true;

				// read only the first uploaded image
				break;
			}

			// return
			return result;

		};

		/**
		 * previewImage
		 *
		 * @since		1.0.0
		 * @param		file (string)
		 * @param		elem (jquery)
		 * @return		N/A
		 */
		var previewImage = function(file, elem) {

			var reader = new FileReader();

			reader.onload = function(e) {

				var div = document.createElement('div');
				div.className = 'image-wrapper';
				div.innerHTML = '<img src="' + reader.result + '" />';
				elem.append(div);

			}

			reader.readAsDataURL(file);

		};

		/**
		 * resizeImage
		 *
		 * @since		1.0.0
		 * @param		file (string)
		 * @return		N/A
		 */
		var resizeImage = function(file) {

			var reader = new FileReader();

			reader.onload = function(e) {

				var tempImg = new Image();
				tempImg.src = reader.result;
				tempImg.onload = function() {
					var tempW = tempImg.width;
					var tempH = tempImg.height;
					if (tempW > tempH) {
						if (tempW > params.max_img_width) {
							tempH *= params.max_img_width / tempW;
							tempW = params.max_img_width;
						}
					} else {
						if (tempH > params.max_img_height) {
							tempW *= params.max_img_height / tempH;
							tempH = params.max_img_height;
						}
					}

					// save resized image dimensions for later use
					params.tmp_resized_img_width = tempW;
					params.tmp_resized_img_height = tempH;

					var canvas = document.createElement('canvas');
					canvas.width = tempW;
					canvas.height = tempH;
					var ctx = canvas.getContext("2d");
					ctx.drawImage(this, 0, 0, tempW, tempH);
					params.tmp_resized_img = canvas.toDataURL("image/jpeg");
				}

			}

			reader.readAsDataURL(file);

		};

		/**
		 * initSelection
		 *
		 * @since		1.0.0
		 * @param		N/a
		 * @return		N/A
		 */
		var initSelection = function() {

			// get image dimensions and initial selection area
			var w = $('.step1 .image-preview img').width(),
				h = $('.step1 .image-preview img').height(),
				x1 = w/2,
				y1 = h/2;

			// init image area selection
			params.ias = $('.step1 .image-preview img').imgAreaSelect({
				handles			: 'corners',
				aspectRatio		: '1:1',
				fadeDuration	: BH_general.params.duration,
				instance		: true,
				onSelectEnd		: function(img, selection) {
					buildThumbnail(params.tmp_resized_img, selection.x1, selection.y1, selection.width, selection.height);
				}
			});

			// show image area selection
			params.ias.setOptions({ show: true, x1: x1, y1: y1, x2: x1+1, y2: y1+1 });
			params.ias.animateSelection(x1-100, y1-100, x1+99, y1+99, BH_general.params.duration);

			// initial thumbnail
			buildThumbnail(params.tmp_resized_img, x1-100, y1-100, 200, 200);

		};

		/**
		 * buildThumbnail
		 *
		 * @since		1.0.0
		 * @param		file (string)
		 * @param		x1
		 * @param		y1
		 * @param		w
		 * @param		h
		 * @return		N/A
		 */
		var buildThumbnail = function(file, x1, y1, w, h) {

			// calculate real coordinates for thumbnail creation
			var file_width		= params.tmp_resized_img_width,
				file_height		= params.tmp_resized_img_height,
				preview_width	= $('.step1 .image-preview img').width(),
				preview_height	= $('.step1 .image-preview img').height(),

				factor			= (file_width > file_height) ? file_width/preview_width : file_height/preview_height,

				selection_x1	= Math.round(factor * x1),
				selection_y1	= Math.round(factor * y1),
				selection_w		= Math.round(factor * w),
				selection_h		= Math.round(factor * h);

			// create thumbnail
			var tempImg = new Image();
			tempImg.src = file;
			tempImg.onload = function() {
				var canvas = document.createElement('canvas');
				canvas.width = params.thumb_width;
				canvas.height = params.thumb_height;
				var ctx = canvas.getContext("2d");
				ctx.drawImage(tempImg, selection_x1, selection_y1, selection_w, selection_h, 0, 0, params.thumb_width, params.thumb_height);
				params.tmp_thumbnail = canvas.toDataURL("image/jpeg");
			}

		};

		/**********************/
		/* step 2/3 functions */
		/**********************/

		/**
		 * validate_form
		 *
		 * @since		1.0.0
		 * @param		step (int)
		 * @return		N/A
		 */
		var validate_form = function(step) {

			// get number of invalid fields
			var not_valid_fields = $('.step'+step+' .field-wrap.required .glyphicon-ok-circle.hidden').length;

			(not_valid_fields) ? $('.btn-submit-step'+step).slideUp(BH_general.params.duration) : $('.btn-submit-step'+step).slideDown(BH_general.params.duration);

		};

		/**
		 * resetForm
		 *
		 * @since		1.0.0
		 * @param		e (jquery event)
		 * @return		N/A
		 */
		var resetForm = function(e) {

			e.wrap('<form>').closest('form').get(0).reset();
			e.unwrap();

		};

		/**
		 * uploadPhoto
		 *
		 * @since		1.0.0
		 * @param		step (int)
		 * @return		N/A
		 */
		var uploadPhoto = function(step) {

			$.ajax({
				type: 'post',
				dataType: 'json',
				url: _BH_General.ajaxurl,
				data: {
					action					: 'upload_photo',
					step					: step,
					nonce					: $('.step'+step).data('nonce'),
					image					: params.resized_img,
					thumbnail				: params.thumbnail,
					name					: params.name,
					email					: params.email,
					country					: params.country,
					subjects				: params.subjects,
					unassigned_subjects		: params.unassigned_subjects,
					title					: params.title,
					year					: params.year,
					description				: params.description,
					institution				: params.institution,
					city					: params.city,
					coordinator_name		: params.coordinator_name,
					coordinator_email		: params.coordinator_email,
					age						: params.age,
					lang					: _BH_General.settings.lang,
				},
				success: function(response) {
					if (!$.isEmptyObject(response)) {
						if (response.status == 0 || response.status == 1) {
							// prepare facebook Share
							prepareFbShare(response.url);

							// clear upload proccess
							transition(4);

							// reload images grid with new uploaded image
							BH_filters.set(response.country, response.year, response.subjects);
						} else {
							// showMsg(1, params.step1_upload_failed_msg);
						}
					}
				},
				complete: function(jqXHR, textStatus) {
					$('.btn-submit-step'+step+' .loader').hide();
				}
			});

		};

		/********************/
		/* step 4 functions */
		/********************/

		/**
		 * prepareFbShare
		 *
		 * @since		1.0.0
		 * @param		url (string)
		 * @return		N/A
		 */
		var prepareFbShare = function(url) {

			// vars
			var btn = $('.btn-submit-step4 .fb-share-button');

			// facebook share button
			btn.attr('data-href', url);
			btn.children('a').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + url + '&amp;src=sdkpreparse');

		};

		/***************************/
		/* general steps functions */
		/***************************/

		/**
		 * transition
		 *
		 * @since		1.0.0
		 * @param		step (int)
		 * @return		N/A
		 */
		var transition = function(step) {

			if (step > 1) {

				$('.upload-form .step-title-wrap, .upload-form .step-indicator-wrap').css({'margin-top': '-25px'});
				$('.upload-form .step').slideUp(BH_general.params.duration);

				setTimeout(function(){
					$('.upload-form .step-title, .upload-form .step-indicator').removeClass('active');
					$('.upload-form .step-title' + step + ', .upload-form .step-indicator' + step).addClass('active');

					$('.upload-form .step-title-wrap').css({'margin-top': '0'});
					$('.upload-form .step-indicator-wrap').css({'margin-top': '10px'});
					$('.upload-form .step' + step).slideDown(BH_general.params.duration);

				}, BH_general.params.duration);

			} else {

				$('.upload-form').slideUp(BH_general.params.duration);
				setTimeout(function(){
					$('.upload-form .step-title, .upload-form .step-indicator').removeClass('active');
					$('.upload-form .step-title1, .upload-form .step-indicator1').addClass('active');

					$('.upload-form .step').hide();
					$('.upload-form .step1').show();
				}, BH_general.params.duration);

			}

		};

		/**
		 * showMsg
		 *
		 * @since		1.0.0
		 * @param		step (int)
		 * @param		msg (string)
		 * @return		N/A
		 */
		var showMsg = function(step, msg) {

			$('.step-msg' + step).html(msg);

		};

		/**
		 * clearStep
		 *
		 * @since		1.0.0
		 * @param		step (int)
		 * @return		N/A
		 */
		var clearStep = function(step) {

			switch (step) {

				case 1 :	// step1

					// remove current image area selection if exists any
					if (params.ias != '') {
						params.ias.cancelSelection();
					}

					// remove image preview content
					$('.step1 .image-preview').html('');

					// reset step message
					$('.step-msg1').html('');

					// reset file input
					resetForm($('.step1 input[type="file"]'));
					$('.step1 #filename').html('');

					// restore drag & drop area
					$('.step1 .drag-drop-inside').show();

					// reset step1 params
					params.tmp_resized_img		= '';
					params.tmp_thumbnail			= '';

					// slideUp submit button
					$('.btn-submit-step1').slideUp(BH_general.params.duration);

					break;

				case 2 :	// step2

					// reset inputs
					params.name					= '';
					params.email				= '';
					params.country				= '';
					params.subjects				= '';
					params.unassigned_subjects	= '';
					params.title				= '';
					params.year					= '';
					params.description			= '';

					// slideUp submit button
					$('.btn-submit-step2').slideUp(BH_general.params.duration);

					// reset common fields
					$('.step2 input, .step2 textarea').val('');

					// reset chosen fields
					$('.step2 .chosen-select option').prop('selected', false);
					$('.step2 .chosen-select').trigger('chosen:updated');

					// reset competition checkbox
					$('.step2 #competition').prop('checked', false);

					// remove validation indicators
					$('.step2 .glyphicon-remove-circle').addClass('hidden');
					$('.step2 .glyphicon-ok-circle').addClass('hidden');

					// reset next/upload buttons
					$('.step2 .submit-step-next').hide();
					$('.step2 .submit-step-upload').show();

					break;

				case 3 :	// step3

					// reset inputs
					params.institution			= '';
					params.city					= '';
					params.coordinator_name		= '';
					params.coordinator_email	= '';
					params.age					= '';

					// slideUp submit button
					$('.btn-submit-step3').slideUp(BH_general.params.duration);

					// reset common fields
					$('.step3 input').val('');

					// reset chosen fields
					$('.step3 .chosen-select option').prop('selected', false);
					$('.step3 .chosen-select').trigger('chosen:updated');

					// remove validation indicators
					$('.step3 .glyphicon-remove-circle').addClass('hidden');
					$('.step3 .glyphicon-ok-circle').addClass('hidden');

					break;

				case 4 :	// step4

					break;

				case 'other' :	// other content to remove

					// remove image preview content within step2/3
					$('.step2 .photo-details-preview, .step3 .photo-details-preview').html('');

					// remove image preview content within step4
					$('.step4 .photo-share-preview').html('');

			}

		};

		/**
		 * loaded
		 *
		 * @since		1.0.0
		 * @param		N/A
		 * @return		N/A
		 */
		self.loaded = function() {

			$(window).resize(alignments).resize();

		};

		/**
		 * alignments
		 *
		 * @since		1.0.0
		 * @param		N/A
		 * @return		N/A
		 */
		var alignments = function() {};

		// return
		return self;

	}

());

$.extend($.imgAreaSelect.prototype, {
	animateSelection: function(x1, y1, x2, y2, duration) {
		var fx = $.extend($('<div/>')[0], {
			ias: this,
			start: this.getSelection(),
			end: { x1: x1, y1: y1, x2: x2, y2: y2 }
		});

		$(fx).animate({
			cur: 1
		},
		{
			duration: duration,
			step: function(now, fx) {
				var start = fx.elem.start, end = fx.elem.end,
					curX1 = Math.round(start.x1 + (end.x1 - start.x1) * now),
					curY1 = Math.round(start.y1 + (end.y1 - start.y1) * now),
					curX2 = Math.round(start.x2 + (end.x2 - start.x2) * now),
					curY2 = Math.round(start.y2 + (end.y2 - start.y2) * now);
				fx.elem.ias.setSelection(curX1, curY1, curX2, curY2);
				fx.elem.ias.update();
			}
		});
	}
});

BH_upload.init();
$(window).load(BH_upload.loaded());