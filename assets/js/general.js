var $ = jQuery,
	BH_general = (function() {

		var self = {};

		/**
		 * params
		 */
		self.params = {

			// general
			duration : 400,

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
			var mobile_menu = $('[data-toggle="offcanvas"]'),
				content = $('.content-offcanvas'),
				sidebar = $('.sidebar-offcanvas');

			// toggle mobile menu
			mobile_menu.click(function() {
				content.toggleClass('active');
				sidebar.toggleClass('active');
			});

			// jQuery extentions
			$.fn.setAllToMaxHeight = function() {
				return this.height( Math.max.apply(this, $.map(this, function(e) { return $(e).height() })) );
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

			// vars
			var logo = $('.desktop-logo .logo-wrap'),
				loader = $('.images-grid .loader'),
				filters = $('.main-content header, .sidebar-filters');

			logo.css({top: 0, margin: 0});

			if ($('body').hasClass('rtl')) {
				logo.css({right: 0});
			} else {
				logo.css({left: 0});
			}

			loader.css({margin: 0});
			filters.show();

		};

		/**
		 * alignment
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

BH_general.init();
$(window).load(BH_general.loaded());