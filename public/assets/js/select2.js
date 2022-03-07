$(document).ready(function() {
	$('.select_value1').select2({
		placeholder: 'Nhãn hàng',
		searchInputPlaceholder: 'Search',
		 width: '100%'
	});
	$('.select_value2').select2({
		placeholder: 'Danh mục hàng hóa',
		searchInputPlaceholder: 'Search',
		 width: '100%'
	});
	$('.select_value3').select2({
		placeholder: 'Mùi hương',
		searchInputPlaceholder: 'Search',
		 width: '100%'
	});
	$('.select_value4').select2({
		placeholder: 'Trọng lượng',
		searchInputPlaceholder: 'Search',
		 width: '100%'
	});
	$('.select_value5').select2({
		placeholder: 'Nhóm',
		searchInputPlaceholder: 'Search',
		 width: '100%'
	});
	$('.select_value6').select2({
		placeholder: 'KA',
		searchInputPlaceholder: 'Search',
		 width: '100%'
	});
	$('.select_value7').select2({
		placeholder: 'Tất cả',
		searchInputPlaceholder: 'Search',
		 width: '100%'
	});
	$('.select_value8').select2({
		placeholder: 'Kiểu đối tượng',
		searchInputPlaceholder: 'Search',
		 width: '100%'
	});
	$('.select_value9').select2({
		placeholder: 'Kiểu đối tượng',
		searchInputPlaceholder: 'Search',
		 width: '100%'
	});
	
	function formatState (state) {
	  if (!state.id) { return state.text; }
	  var $state = $(
		'<span><img src="../../assets/plugins/flag-icon-css/flags/4x3/' +  state.element.value.toLowerCase() +
	'.svg" class="img-flag" /> ' +
	state.text +  '</span>'
	 );
	 return $state;
	};

	$(".select2-flag-search").select2({
	  templateResult: formatState,
	  templateSelection: formatState,
	   escapeMarkup: function(m) { return m; }
	});
	
});
