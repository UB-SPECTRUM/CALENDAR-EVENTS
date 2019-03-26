var tagify;

function clearSiblingInput(event) {
	var handler = $(event.parentNode).siblings();
	handler.val('');
}

function onSelectTagFromDropdown(tag) {
	let cat = getCategoryByLabel(tag);

	if (tag.disabled === true) {
		return;
	}

	tagify.addTags(tag);
	cat.disabled = true;
	makeCategoryOptions();
}

function getCategoryByLabel(label) {
	for (let i = 0; i < categories.length; i++) {
		let cat = categories[i];
		if (cat.label === label) {
			return cat;
		}
	}

	return null;
}

function makeCategoryOptions() {
	let categoryMenu = categories.map(
		(cat) =>
			`<a class="dropdown-item ${cat.disabled === true
				? 'disabled'
				: ''}" href="javascript:onSelectTagFromDropdown('${cat.label}')" >${cat.icon ? `<i class="${cat.icon}"></i>` : '' } ${cat.label}</a>`
	);
	$('#category-menu').html(categoryMenu);
}

$(document).ready(function() {
	
	// page is now ready, initialize the calendar...
	$('#toggleFiltersButton').click(function() {
		$('#filterSection').toggle(300);
	});
	var input = document.querySelector('input[name=tags-outside]');
	// init Tagify script on the above inputs
	tagify = new Tagify(input);
	tagify.on('remove', function(e) {
		let label = e.detail.data.value;
		let cat = getCategoryByLabel(label);
		cat.disabled = false;
		makeCategoryOptions();
	});
	// add a class to Tagify's input element
	tagify.DOM.input.classList.add('tagify__input--outside');

	// re-place Tagify's input element outside of the  element (tagify.DOM.scope), just before it
	tagify.DOM.scope.parentNode.insertBefore(tagify.DOM.input, tagify.DOM.scope);

	$('#calendar').fullCalendar({
		// put your options and callbacks here
		themeSystem: 'bootstrap4',
		navLinks: true,
		header: {
			left: 'addButton',
			center: 'title',
			right: 'today month,agendaWeek,agendaDay prev,next'
		},
		// events: testEvents,
		events: {
			url: '/ubspectrum/events/fetchEvents.php',
			type: 'POST',
			data: {
				custom_param1: 'something',
				custom_param2: 'somethingelse'
			},
			error: function() {
				alert('Sorry, there was an error while fetching events. Please check again later.');
			}
		},
		eventLimit: 3,
		eventLimitClick: 'day',
		handleWindowResize: true,
		height: 'parent',

		eventClick: function(calEvent, jsEvent, view) {
			window.location.href = `/ubspectrum/events/EventInfo.php?eventId=${calEvent.id}`;
		},
		bootstrapFontAwesome: {
			close: 'fa-times',
			prev: 'fa-chevron-left',
			next: 'fa-chevron-right',
			prevYear: 'fa-angle-double-left',
			nextYear: 'fa-angle-double-right',
			// addButton: 'fa-plus'
		},
		customButtons: {
			addButton: {
				text: 'Add an Event',
				click: function(event ,el) {
					window.location.href = `/ubspectrum/events/AddEvent.php`;
				}
			}
		},
		eventRender: function(eventObj, $el) {
			// $el.find('.fc-content').popover({
			//   title: eventObj.title,
			//   content: eventObj.description,
			//   trigger: 'hover',
			//   placement: 'top',
			// });
			let categories = eventObj.categories;
			for (let index = 0; index < categories.length; index++) {
				const category = categories[index];
				let categoryIcon = categoryIconMapping[category.CATEGORY_ID];
				$el.prepend(`<div style="display:inline-block" data-toggle="tooltip" data-placement="top" title="${category.NAME}"><i class="${categoryIcon}"></i>&nbsp;</div>`);
			}
			$el.find('.fc-content').css({display:'inline-block'});
			
			return $el;
		  },
		  eventAfterAllRender: function(){
			// $('[data-toggle="popover"]').popover()
			$('[data-toggle="tooltip"]').tooltip()
		  }
	});

	makeCategoryOptions();
	$('#datetimepicker1').flatpickr({
		enableTime: true,
		noCalendar: true,
		dateFormat: "h:i K",
	});
	$('#datetimepickerBefore').flatpickr({
		// format: 'LT'
		enableTime: true,
		noCalendar: true,
		dateFormat: "h:i K",

	});

	
});
