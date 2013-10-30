/**
 * Всплывающие окна
 *
 * @autor Ilja Galaichuk <the.ilja@gmail.com>
 * @version 1.07 (08.11.2012)
 */

popup = {
	backgroundImageUrl	: "/themes/eng/images/gray.png",

	show		: function (selector) {},
	showImage	: function ( obj ) {},
	hide		: function (selector) {}, 
	destroy		: function (selector) {}, // internal, use popup.hide()
	setCenter   : function ( obj ) {}, 
	showLayer	: function ( obj ) {}, // internal
	hideLayer	: function ( obj ) {}, // internal
	
	// события
	contentClick	: function () {}
};

/**
 * Функиция показа модульного окна
 *
 * @param string селектор для дива
 */
popup.show = function (selector)
{
	popup._lastOpenSelector = selector;
	
	var window = $(selector);
	// выравниваем по центру
	popup.setCenter (window);
	// Создаем подложку
	popup.showLayer ();

	// Прикрепляем событи на кнопку закрыть
	$("#close-button").bind("click",  function () {
		popup.hide( selector )
	});

	window.css ("z-index", "991");
	window.css ("display", "block");
	
}

/**
 * Функция для показа модульного окна с изображением
 *
 * @param object obj
 * @param string title
 * @param string prev // предидущеая картинка url
 * @param string next // след картинка url
 */
popup.showImage = function (imageHref, title)
{
	
	$("#popup-window").remove ();

	// создаем окно в котором будем показывать
	$("body").append('<div id="popup-window" class="popup-window"></div>');

	var mWindow = $("#popup-window");

	// Создаем подложку
	popup.showLayer ();
	
	// Добавляем див заголовка
	if (title != "") mWindow.append ('<div class="popup-window-title">'+title+'</div>');
	
	// Добавляем див кнопки закрыть
	mWindow.append ('<div class="close-button"><a href="javascript:return false;" id="popup-window-close-button">закрыть окно</a></div><br style="clear: both" />');

	// Добавляем див для контента картинки
	mWindow.append ('<div class="popup-window-content" id="popup-window-content"></div>');
	
	// добавляем подвал
	mWindow.append ('<div class="popup-window-footer" id="popup-window-footer"></div>');

	// Добавляем лоадер пока будет грузится изображение
	$("#popup-window-content").html('<img src="/themes/eng/images/loader_big.gif" id="popup-window-image" style="margin-right: 20px" />Изображение загружается, пожалуйста подождите...');

	var fo = '<div>'; 
	fo += '<div style="clear: both"></div></div>';
	$("#popup-window-footer").html(fo);
	
	// Вешаем событие на кнопку закрыть
	$("#popup-window-close-button").bind("click",  function () {
		popup.destroy ( "#popup-window" );
	});

	$("#popup-window-content").bind("click",  function () {
		// popup.destroy ( "#popup-window" );
		popup.contentClick ();
	});

	
	
	

	// выравниваем оно по центру
	popup.setCenter (mWindow);

	// Загружаем изображение
	var im = new Image();
	im.src = imageHref;

	im.onload = function (){
		$("#popup-window-content").html('<img src="'+im.src+'" />');
		// Уменьшаем размер что бы влезло в окно

		popup.reSize(this);
		
		// еще раз выравниваем окно
		popup.setCenter (mWindow);
	}

	// alert (imageHref);
	return false;
}


/**
 * Функция для скрытия модульного окна
 * 
 * @param string selector
 */
popup.hide = function ( selector ) {
	$(selector).css ("display", "none");
	// Убираем подложку
	popup.hideLayer();
}

/**
 * Функция для уничтожения модульного окна
 * 
 * @param string selector
 */
popup.destroy = function ( selector ) {
	$(selector).remove ();
	// Убираем подложку
	popup.hideLayer();
}

/**
 * Метод выравнивает какойто объект по центру
 */
popup.setCenter = function (obj) {
	obj.css("position", "fixed");
	obj.css ("z-index", "991");
	
	var left = ($(window).width() - obj.width() ) / 2;
	obj.css ("left", left+"px");

	var top = ($(window).height() - obj.height() ) / 2;
	top = top - (top * 0.2); // спещаем немного на верх
	if (top < 0) top = 0;
	obj.css ("top", top+"px");
}

/**
 * Метод ресайзит объект что бы лез в экран
 * 
 * @param Image 
 */
popup.reSize = function (obj) {

	
	var width = obj.width;
	var height = obj.height;
	
	// Коэф
	var kx = width / $(window).width();
	var ky = height / $(window).height();
	
	// пересчитываем новые размеры
	if (kx >= ky) {
		var new_height = parseInt(height / kx) * 0.8;
		var new_width = parseInt(width / kx) * 0.8;
	}
	else {
		var new_height = parseInt(height / ky) * 0.8;
		var new_width = parseInt(width / ky) * 0.8;	
	}
	
	// что бы случайно не увеличить
	if (new_height > height || new_width > width) {
		new_height = height;
		new_width = width;
	}
	
	var img = $("#popup-window-content img");
	img.attr ("width", new_width);
	img.attr ("height", new_height);

}
/**
 *  Метод создает подложку
 *
 */
popup.showLayer = function (){
	$("body").append('<div id="popup-layer"></div>');
	var obj = $("#popup-layer");
	obj.css ("background", ' url('+popup.backgroundImageUrl+') top left repeat');
	obj.css ("z-index", "990");
	obj.css ("position", "fixed");
	obj.css ("top", "0");
	obj.css ("left", "0");
	obj.css ("width", $(window).width()+ "px");
	obj.css ("height", $(document).height()+ "px");
	
	$("#popup-layer").click( function (){
		popup.destroy ( "#popup-window" );
		// popup.hide(popup._lastOpenSelector);
	});
	
	//obj.css ();
}

/**
 * Метод удаляет подложку
 *
 */
popup.hideLayer = function (){
	$("#popup-layer").remove();
}