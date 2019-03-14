var tagify;
var categories;

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
				: ''}" href="javascript:onSelectTagFromDropdown('${cat.label}')" >${cat.label}</a>`
	);
	$('#category-menu').html(categoryMenu);
}

$(function() {
	categories = [
		{ label: 'Brainy', disabled: false },
		{ label: 'Arty', disabled: false },
		{ label: 'Sporty', disabled: false },
		{ label: 'Fun', disabled: false },
		{ label: 'Cheap', disabled: false }
	];
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
			url: '/Events/fetchEvents.php',
			type: 'POST',
			data: {
				custom_param1: 'something',
				custom_param2: 'somethingelse'
			},
			error: function() {
				alert('there was an error while fetching events!');
			}
		},
		eventLimit: 3,
		eventLimitClick: 'day',
		handleWindowResize: true,
		height: 'parent',

		eventClick: function(calEvent, jsEvent, view) {
			window.location.href = `/Events/EventInfo.php?eventId=${calEvent.title}`;
		},
		bootstrapFontAwesome: {
			close: 'fa-times',
			prev: 'fa-chevron-left',
			next: 'fa-chevron-right',
			prevYear: 'fa-angle-double-left',
			nextYear: 'fa-angle-double-right',
			addButton: 'fa-plus'
		},
		customButtons: {
			addButton: {
				text: 'Add an Event',
				click: function() {
					window.location.href = `/Events/AddEvent.php`;
				}
			}
		}
	});

	makeCategoryOptions();
	$('#datetimepicker1').datetimepicker({
		format: 'LT'
	});
	$('#datetimepickerBefore').datetimepicker({
		format: 'LT'
	});
});
