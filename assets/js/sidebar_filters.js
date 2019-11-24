var $ = jQuery,
	BH_filters = (function() {

		var self = {};

		/**
		 * params
		 */
		var params = {

			sidebarFilters		: $('.sidebar-filters'),
			countries			: $('.sidebar-filters').children('#countries'),
			years				: $('.sidebar-filters').children('#years'),
			subjects			: $('.sidebar-filters').children('#subjects'),
			subsubjects			: $('.sidebar-filters').children('#subsubjects'),
			container			: '',

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
			var	sidebarFilters = params.sidebarFilters,
				countries = params.countries,
				years = params.years,
				subjects = params.subjects,
				subsubjects = params.subsubjects;

			// initiate chosen plugin
			sidebarFilters.find('select').chosen({
				enable_split_word_search: true,
				search_contains: true,
				width: '100%',
			});

			// create loader container
			createLoader();

			// handle subject selection
			subjects.change(get_subsubjects);

			// query on change
			countries.add(years).add(subjects).add(subsubjects).change(function() {
				query_current();
			});

		};

		/**
		 * createLoader
		 *
		 * creates loader container for ajax requests
		 *
		 * @since		1.0.0
		 * @param		N/A
		 * @return		N/A
		 */
		var createLoader = function() {

			// vars
			var loader = new Image();

			params.container = document.createElement('div');
			params.container.id = 'query-loader-container';
			loader.src = _BH_General.settings.template + '/assets/images/general/loader.gif';
			loader.id = 'query-loader';

			params.container.appendChild(loader);

		};

		/**
		 * get_subsubjects
		 *
		 * updates subsubjects options list according to selected subjects
		 *
		 * @since		1.0.0
		 * @param		N/A
		 * @return		N/A
		 */
		var get_subsubjects = function() {

			// vars
			var	subjects = params.subjects,
				subsubjects = params.subsubjects,
				selectedOptionsArray = Array.prototype.slice.call(subjects[0].selectedOptions),
				selectedOptionsIds = {},
				nonce = subjects.data('nonce');

			// get subsubjects options
			sub_options = subsubjects.find('option');

			// hide subsubjects options
			sub_options.addClass('hidden').each(function() {
				this.selected = false;
			});

			// set selectedOptionsIds
			selectedOptionsArray.forEach(function(element, index, array) {
				selectedOptionsIds[index] = element.id;
			});

			$.ajax({
				type: 'post',
				dataType: 'json',
				url: _BH_General.ajaxurl,
				data: {
					action				: 'subject_filter',
					nonce				: nonce,
					selectedOptionsIds	: selectedOptionsIds,
					lang				: _BH_General.settings.lang,
				},
				success: function(response) {
					if (response.length) {
						response.forEach(function(sub, index, array) {
							subsubjects.find('#' + sub.term_id).removeClass('hidden');
						});
					}

					// update chosen select
					subsubjects.trigger('chosen:updated');
				},
			});

		};

		/**
		 * query_current
		 *
		 * queries photos according to current filters
		 *
		 * @since		1.0.0
		 * @param		N/A
		 * @return		N/A
		 */
		var query_current = function() {

			// vars
			var	countries = params.countries,
				years = params.years,
				subjects = params.subjects,
				subsubjects = params.subsubjects;

			// query
			query(
				htmlCollectionToArray( countries[0].selectedOptions ),
				htmlCollectionToArray( years[0].selectedOptions ),
				htmlCollectionToArray( subjects[0].selectedOptions ),
				htmlCollectionToArray( subsubjects[0].selectedOptions )
			);

		};

		/**
		 * htmlCollectionToArray
		 *
		 * generates array from HTMLCollection
		 *
		 * @since		1.0.0
		 * @param		collection (HTMLCollection)
		 * @return		(array)
		 */
		var htmlCollectionToArray = function(collection) {

			// vars
			var arrId = [],
				arr = Array.prototype.slice.call(collection);

			arr.forEach(function(element, index, array) {
				arrId.push(element.id);
			});

			// return
			return arrId;

		};

		/**
		 * query
		 *
		 * queries photos
		 *
		 * @since		1.0.0
		 * @param		countries (array)
		 * @param		years (array)
		 * @param		subjects (array)
		 * @param		subsubjects (array)
		 * @return		N/A
		 */
		var query = function(countries, years, subjects, subsubjects) {

			// vars
			var	container = params.container,
				pageContent = $('.page-content'),
				nonce = params.sidebarFilters.data('nonce');

			// expose loader
			pageContent[0].innerHTML = params.container.outerHTML;

			$.ajax({
				type: 'post',
				dataType: 'html',
				url: _BH_General.ajaxurl,
				data: {
					action			: 'query_photos',
					nonce			: nonce,
					countries		: countries,
					years			: years,
					subjects		: subjects,
					subsubjects		: subsubjects,
					lang			: _BH_General.settings.lang,
				},
				success: function(response) {
					if (response.length) {
						pageContent[0].innerHTML = response;
					}
				},
				complete: function(jqXHR, textStatus) {
					BH_main.loaded();
				}
			});

		};

		/**
		 * reset
		 *
		 * resets filters
		 *
		 * @since		1.0.0
		 * @param		N/A
		 * @return		N/A
		 */
		var reset = function() {

			// vars
			var sidebarFilters = params.sidebarFilters;

			// reset filters
			sidebarFilters.children('select').children('option').removeProp('selected');
			sidebarFilters.children('select').trigger('chosen:updated');

			// query
			query_current();

		};

		/**
		 * set
		 *
		 * sets and executes query
		 *
		 * @since		1.0.0
		 * @param		country (int)
		 * @param		year (string)
		 * @param		subsubjects (array)
		 * @return		N/A
		 */
		self.set = function(country, year, subsubjects) {

			// vars
			var sidebarFilters = params.sidebarFilters,
				countriesFilter = params.countries,
				yearsFilter = params.years,
				subsubjectsFilter = params.subsubjects;

			// reset filters
			sidebarFilters.children('select').children('option').removeProp('selected');

			// update country
			if (country) {
				countriesFilter.children('option#' + country.toString()).prop('selected', true);
			}

			// update year
			if (year) {
				yearsFilter.children('option#' + year.toString()).prop('selected', true);
			}

			// update subjects
			if (subsubjects) {
				subsubjects.forEach(function(subject, index, array) {
					subsubjectsFilter.children('option#' + subject.toString()).prop('selected', true);
				});
			}

			sidebarFilters.children('select').trigger('chosen:updated');

			// query
			query_current();

		};

		// return
		return self;

	}

());

// Polyfill for browsers without 'selectedOptions' property
Object.defineProperty(HTMLSelectElement.prototype, "selectedOptions", {
	get: (function() {
		try {
			document.querySelector(":checked");
			return function() {
				return this.querySelectorAll(":checked");
			};
		} catch (e) {
			return function() {
				if (!this.multiple) {
					return this.selectedIndex >= 0 ? [this.options[this.selectedIndex]] : [];
				}
				for (var i = 0, a = []; i < this.options.length; i++)
					if (this.options[i].selected) a.push(this.options[i]);
				return a;
			};
		}
	})()
});

BH_filters.init();