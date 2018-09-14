ymaps.ready(function () {
    var myMap = new ymaps.Map('map', {
            center: [55.881962, 37.733663],
            zoom: 9
        }, {
            searchControlProvider: 'yandex#search'
        }),
        MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
            '<div style="color: #FFFFFF; font-weight: bold;">$[properties.iconContent]</div>'
        ),
        myPlacemark1 = new ymaps.Placemark([55.881962, 37.733663], {
            hintContent: 'ООО "Сруб-Строй"',
            balloonContent: 'г. Мытищи, ул. Ярославское шоссе, территория Тракт-терминала'
        }, {
            iconLayout: 'default#image',
            iconImageHref: '/images/pin.png',
            iconImageSize: [42, 68],
            iconImageOffset: [-21, -68]
        });

    myMap.behaviors.disable('scrollZoom');
    myMap.geoObjects
        .add(myPlacemark1);
});