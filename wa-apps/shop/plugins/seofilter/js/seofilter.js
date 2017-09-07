(function ($)
{
	var _settings = [];

	$(document).ajaxSend(function (event, jqxhr, settings) {
		_settings[jqxhr] = $.extend(true, {}, settings);

		if (categoryUrl !== undefined && settings.url[0] === '?')
		{

			var valuesUrl = JSON.parse(filterValuesNames),
				params = settings.url.replace(/.*?\?/, '').split('&'),
				codes = [];

			$.each(params, function(i, val) {
				if (val && val.indexOf("_=") == -1 && val.indexOf("sort") == -1 && val.indexOf("order") == -1 && val.indexOf("[unit]") == -1) {
					codes.push(val);
				}
			});

			if (codes.length == 1)
			{
				var featureCode_tmp = codes[0].split('[]='), featureCode = featureCode_tmp[0], valueId = featureCode_tmp[1], valueUrl = '';

				if (valuesUrl && valuesUrl[featureCode])
				{
					valueUrl = valuesUrl[featureCode][valueId];
				}

				if (valueUrl)
				{
					settings.url = categoryUrl + '_' + valueUrl + '/';
					return;
				}
			}

			settings.url = categoryUrl + settings.url;
		}
	});

	$(document).ajaxComplete(function(event, xhr, settings) {
		settings = _settings[xhr];

		if ( typeof(filterValuesNames) !== "undefined" && (settings.url.indexOf("[]=") != -1 || settings.url.indexOf("?&_=") != -1) && settings.url.indexOf("filters") == -1 ) {

			if ( settings.url.indexOf("[]=") != -1 ) {
				var valuesUrl = JSON.parse(filterValuesNames),
					params = settings.url.replace(/.*?\?/, '').split('&'),
					codes = [];

				$.each(params, function(i, val) {
					if (val.indexOf("_=") == -1 && val.indexOf("sort") == -1 && val.indexOf("order") == -1 && val.indexOf("[unit]") == -1) {
						codes.push(val);
					}
				});
				if (codes.length == 1) {
					var featureCode_tmp = codes[0].split('[]='),
						featureCode = featureCode_tmp[0],
						valueId = featureCode_tmp[1],
						valueUrl = '';

					if (valuesUrl && valuesUrl[featureCode]) {
						valueUrl = valuesUrl[featureCode][valueId];
					}

					if (valueUrl) {
						if (!!(history.pushState && history.state !== undefined)) {
							window.history.replaceState({}, '', categoryUrl + '_' + valueUrl + '/');
						}
					} else {
						if (!!(history.pushState && history.state !== undefined)) {
							var new_url = serializeFilterForm();
							window.history.replaceState({}, '', categoryUrl + new_url);
						}
					}
				} else {
					if (!!(history.pushState && history.state !== undefined)) {
						var new_url = serializeFilterForm();
						window.history.replaceState({}, '', categoryUrl + new_url);
					}
				}
			} else if ( settings.url.indexOf("?&_=") != -1 ) {
				if (!!(history.pushState && history.state !== undefined)) {
					window.history.replaceState({}, '', categoryUrl);
				}
			}

			var response = $(xhr.responseText);
			var names = response.filter('.category-name').add(response.find('.category-name'));
			$('.category-name').html(names.first().html());
			var descs = response.filter('.category-desc').add(response.find('.category-desc'));
			$('.category-desc').html(descs.first().html());
			var titles = response.filter('.html-title').add(response.find('.html-title'));
			document.title = titles.first().html();
		}
	});


	function serializeFilterForm() {
		var f = $('.filters form'),
			fields = f.serializeArray(),
			params = [];
		for (var i = 0; i < fields.length; i++) {
			if (fields[i].value !== '') {
				params.push(fields[i].name + '=' + fields[i].value);
			}
		}
		var url = '?' + params.join('&');
		return url;
	}
})(jQuery);
