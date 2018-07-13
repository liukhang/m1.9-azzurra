jQuery(function() {
	jQuery('.easyPaginate').easyPaginate({
		paginateElement: '.item',
		elementsPerPage: 1,
		effect: 'default',
		hashPage: 'atelier',
		nextButtonText: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
		lastButtonText: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
		prevButtonText: '<i class="fa fa-angle-left" aria-hidden="true"></i>',
		firstButtonText: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
	});
});