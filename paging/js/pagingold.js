(function($){
	$.fn.zPaging = function(options) {
		// Các giá trị mặc định của options
		var defaults = {
			'rows' 		 	: '#rows',
			'pages'		 	: '#pages',
			'items'		 	: 6,
			'height'	 	: 26,
			'currentPage'	: 1,
			'total'		 	: 0,
			'btnPrevious'	: '.goPrevious',
			'btnNext'	 	: '.goNext',
			'txtCurrentPage': '#currentPage',
            'pageInfo' 	: '.pageInfo'
		};
		options = $.extend(defaults, options);

		// Khai báo các biến sẽ sử dụng trong plugin
		var rows 		   = $(options.rows);
		var pages 		   = $(options.pages);
		var btnPrevious    = $(options.btnPrevious);
		var btnNext		   = $(options.btnNext);
		var txtCurrentPage = $(options.txtCurrentPage);
		var lblpageInfo	   = $(options.pageInfo);

		var aRows 		   = '';

		// Khởi tạo các hàm cần thiết khi plugin được sử dụng
		init();

		// Hàm khởi động, hàm này sẽ được chạy khi gọi plugin lên
		function init() {
			// Lấy tổng số trang
			$.ajax({
				url		: 'files/getdata.php?type=count&items=' + options.items,
				type	: 'GET',
				dataType: 'json'
			}).done(function(data){
				options.total = data.total;
				pageInfo();
				loadData();
			});

			// Gán các sự kiện vào cho btnPrevious, btnNext, txtCurrentPage
			setCurrentPage();

			// Gán các sự kiện cho nút Next, Previous và sự kiện keyup khi nhập vào ô input số trang mà mình cần đến
			btnPrevious.on('click', function(e){
				goPrevious();
				e.stopImmediatePropagation();
			});
			btnNext.on('click', function(e){
				goNext();
				e.stopImmediatePropagation();
			});
			txtCurrentPage.on('keyup', function(e){
				if (e.keyCode === 13) {
					var currentPageValue = $(this).val();
					var reg = new RegExp('^[1-9]+$');
					if (!reg.test(currentPageValue) || (parseInt(currentPageValue) > parseInt(options.total))) {
						alert('Giá trị nhập vào không phù hợp');
					} else {
						options.currentPage = currentPageValue;
						loadData();
						pageInfo();
					}
				}
			});
		}

		// Hàm xử lý khi nhấn vào nút btnPrevious
		function goPrevious() {
			console.log('goPrevious' + options.currentPage);
			if (options.currentPage > 1) {
				options.currentPage = options.currentPage - 1;
				loadData();
				setCurrentPage();
				pageInfo();
			}
		}

		// Hàm xử lý khi nhấn vào nút btnNext
		function goNext() {
			console.log('goNext' + options.currentPage);
			if (options.currentPage < options.total) {
				options.currentPage = options.currentPage + 1;
				loadData();
				setCurrentPage();
				pageInfo();
			}
		}

		// Hàm xử lý gán giá trị vào trong ô input currentPage
		function setCurrentPage() {
			txtCurrentPage.val(options.currentPage);
		}

		// Hàm hiển thị thông tin phân trang
		function pageInfo() {
			lblpageInfo.text('Page ' + options.currentPage + ' of ' + options.total);
		}

		// Thiết lập chiều cao cho ul#rows
		function setRowsHeight(data) {
			var ulHeight = (data.length * options.height) + 'px';
			rows.css('height', ulHeight);
		}

		// Hàm load các thông tin trong database và đưa vào trong #rows
		function loadData() {
			$.ajax({
				url		  : 'files/getdata.php?type=list',
				type	  : 'POST',
				dataType  : 'json',
				cache     : false,
				data	  : {
								'items'		 : options.items,
								'currentPage': options.currentPage
							}	
			}).done(function(data){
				if (data.length > 0) {
					rows.empty();
					setRowsHeight(data);
					$.each(data, function(i, val){
						var str = '<li item-id="' + val.id + '">' + val.id + ' - ' + val.name + '<a href="#">Xóa</a>' + '</li>';
						rows.append(str);
					});

					// Lấy tập hợp các thẻ <a> nằm trong ul#rows li
					aRows = options.rows + ' li a';
					$(aRows).on('click', function(e){
						deleteItem(this);
					});
				}
			});
		}

		// Xóa đi 1 dòng trong #rows
		function deleteItem(obj) {
			var parent = $(obj).parent();
			var itemId = $(parent).attr('item-id');
			var lastId = $(rows).children(':last').attr('item-id');
			// Ẩn và xóa phần tử <li> được nhấn
			// $(parent).fadeOut({
			// 	duration: 300,
			// 	done:   function(){
			// 		$(this).remove();
			// 	}
			// });

			// $.ajax({
			// 	url		: 'files/getdata.php?type=one&id=' + lastId,
			// 	type	: 'GET',
			// 	dataType: 'json'
			// }).done(function(data){
			// 	var str = '<li item-id="' + data.id + '">' + data.id + ' - ' + data.name + '<a href="#">Xóa</a>' + '</li>';
			// 	str = $(str).hide().appendTo(rows);
			// 	$(str).fadeIn(300);
			// });

			deleteFromRows(parent, itemId, lastId);
		}

		// Ẩn rồi xóa phần tử <li> được nhấn
		async function removeItem(parent, itemId, lastId){
			$.ajax({
				url		: 'files/getdata.php?type=delete&id=' + itemId,
				type	: 'GET',
				dataType: 'json'
			});

			if ((itemId === lastId) && ($(rows).children().length === 1)) {
				options.currentPage = options.currentPage - 1;
			}
			$(parent).fadeOut().remove();
			init();

			return;
		};

		async function deleteFromRows(parent, itemId, lastId){
			await removeItem(parent, itemId, lastId);
			// Thêm 1 phần tử vào cuối
			$.ajax({
				url		: 'files/getdata.php?type=one&id=' + lastId,
				type	: 'GET',
				dataType: 'json'
			}).done(function(data){
				if (data) {
					var str = '<li item-id="' + data.id + '">' + data.id + ' - ' + data.name + '<a href="#">Xóa</a>' + '</li>';
					str = $(str).hide().appendTo(rows);
					$(str).fadeIn();
				}
			});
		};
	}
})(jQuery);

$(document).ready(function(e){
	var obj = {'items': 2};
	$('#paging').zPaging(obj);
})