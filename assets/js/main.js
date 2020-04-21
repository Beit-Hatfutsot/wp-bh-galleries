var $ = jQuery,
	BH_main = (function() {

		var self = {};

		/**
		 * params
		 */
		var params = {

			image_max_width		: 300,
			cols				: '',		// number of images per row
			col_width			: '',

		};

		/**
		 * init
		 *
		 * @since		1.0.0
		 * @param		N/A
		 * @return		N/A
		 */
		self.init = function() {

			// vars
			var form = $('.upload-form');

			// toggle upload form
			$(document).on('click', '.upload .content .camera, .upload .content .glyphicon-camera', function() {
				// scroll to top (if upload form is hidden)
				if (!form.is(':visible')) {
					$('html, body').animate({
						scrollTop: 0
					}, BH_general.params.duration);
				}
				// toggle upload form
				form.stop().slideToggle(BH_general.params.duration);
			});

			// expand photo
			$(document).on('click', '.images-grid li.photo', function() {
				expandPhoto($(this));
			});

			// close expanded photo
			$(document).on('click', '.images-grid li.expanded .close-photo', function() {
				closePhotos();
			});

		};

		/**
		 * expandPhoto
		 *
		 * @since		1.0.0
		 * @param		photo (jquery)
		 * @return		N/A
		 */
		var expandPhoto = function(photo) {

			if (photo.hasClass('active')) {
				closePhotos();
				return;
			}

			// remove any expanded photo in the grid
			closePhotos();

			// mark photo as active
			photo.addClass('active');

			// create a new expanded li element
			var expanded_li = document.createElement('li');
			expanded_li.className = 'expanded';
			expanded_li.style.display = 'none';

			var photo_data = JSON.parse(photo.attr('photo-data')),
				subjects_ids = photo_data['subjects_ids'],
				subjects_logos = subjects_ids ? get_subjects_logos(subjects_ids) : '';

			var expanded_li_content =
				'<div class="photo-image">' +
					'<img src="' + photo_data['image'] + '" alt="' + photo_data['user_name'] + '" />' +
				'</div>' +

				'<div class="photo-details">' +
					( (photo_data['title']) ? '<h2>' + photo_data['title'] + '</h2>' : '' ) +
					'<div class="user-meta">' + _BH_General.strings.by_str + ' <span class="user">' + photo_data['user_name'] + '</span>, <span class="year">' + photo_data['year'] + '</span></div>' +
					'<div class="photo-meta">' +
						( (photo_data['subjects_parents']) ? '<div class="subjects">' + _BH_General.strings.subject_str + ': ' + photo_data['subjects'] + ' |&nbsp;</div>' : '' ) +
						'<div class="country">' + _BH_General.strings.country_str + ': ' + photo_data['country'] + '</div>' +
					'</div>' +
					( (photo_data['description']) ? '<div class="description">' + photo_data['description'] + '</div>' : '' ) +
					( subjects_logos ? '<div class="subjects-logos">' + subjects_logos + '</div>' : '' ) +
				'</div>' +

				'<div class="close-photo"><span class="glyphicon glyphicon-remove"></span></div>';

			expanded_li.innerHTML = expanded_li_content;

			setTimeout(function() {

				$('.images-grid li.expanded').remove();

				// calculate the right position to expand photo and scroll
				var photo_position = $('.images-grid ul li').index(photo) + 1;
				var photo_row = Math.ceil(photo_position / params.cols);

				var position = photo_row * params.cols -1;
				position = (position > ($('.images-grid ul li').length-1)) ? ($('.images-grid ul li').length-1) : position;

				// expand photo
				$('.images-grid ul li:eq(' + position + ')').after(expanded_li);
				$('.images-grid li.expanded').slideDown(BH_general.params.duration);

				// scroll
				$('html, body').animate({
					scrollTop: photo_row * params.col_width
				}, BH_general.params.duration);

			}, BH_general.params.duration);

		};

		/**
		 * get_subjects_logos
		 *
		 * Returns HTML merkup for subjects logos
		 *
		 * @since		1.1.2
		 * @param		subjects_ids (array)
		 * @return		(string)
		 */
		var get_subjects_logos = function(subjects_ids) {

			// vars
			var output = '';

			if (subjects_ids) {
				$.each(subjects_ids, function(i, id) {
					if (id in _BH_General.subjects_logos && _BH_General.subjects_logos[id].logos.length) {
						output += '<ul id="subject-logos-' + id + '" class="subject-logos">';

						$.each(_BH_General.subjects_logos[id].logos, function(j, logo) {
							if (logo.logo) {
								output += '<li>';
								output += logo.link.length ? '<a href="' + logo.link + '" target="_blank">' : '';
								output += '<img src="' + logo.logo + '" />';
								output += logo.link.length ? '</a>' : '';
								output += '</li>';
							}
						});

						output += '</ul>';
					}
				});
			}

			// return
			return output;

		};

		/**
		 * closePhotos
		 *
		 * @since		1.0.0
		 * @param		N/A
		 * @return		N/A
		 */
		var closePhotos = function() {

			$('.images-grid li.photo').removeClass('active');
			$('.images-grid li.expanded').slideUp(BH_general.params.duration);

		};

		/**
		 * loaded
		 *
		 * @since		1.0.0
		 * @param		N/A
		 * @return		N/A
		 */
		self.loaded = function() {

			$('.images-grid .loader').hide();
			$('.images-grid ul').fadeIn(BH_general.params.duration);

			$(window).resize(alignments).resize();

		};

		/**
		 * alignments
		 *
		 * @since		1.0.0
		 * @param		N/A
		 * @return		N/A
		 */
		var alignments = function() {

			// align images grid
			var grid_width = $('.images-grid').width();

			params.cols = Math.ceil(grid_width / params.image_max_width);
			params.col_width = grid_width / params.cols;

			$('.images-grid li.photo').width(params.col_width).height(params.col_width);

		};

		// return
		return self;

	}

());

BH_main.init();
$(window).load(BH_main.loaded());