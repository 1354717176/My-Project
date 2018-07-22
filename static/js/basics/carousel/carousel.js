var _0x30c5 = ['#exampleLazy', 'ondemand', '#exampleAutoplay', '#exampleFade', 'linear', '#exampleAddRemove', 'slickAdd', '<div><h3>', '#exampleRemoveSlide', '#exampleFiltering', 'click', 'slickFilter', ':even', '不过滤', 'slickUnfilter', 'text', 'ready', 'slick', '#exampleMultipleItems', '#exampleResponsive', '#exampleAdaptiveHeight', '#exampleData', '40px'];
(function (_0x4cfd78, _0x52355e) {
    var _0xf4a95a = function (_0x5c2d5b) {
        while (--_0x5c2d5b) {
            _0x4cfd78['push'](_0x4cfd78['shift']());
        }
    };
    _0xf4a95a(++_0x52355e);
}(_0x30c5, 0x152));
var _0x530c = function (_0x4cf98e, _0xba4b79) {
    _0x4cf98e = _0x4cf98e - 0x0;
    var _0x1623ac = _0x30c5[_0x4cf98e];
    return _0x1623ac;
};
(function (_0x5e13d3, _0x400267, _0x28927e) {
    'use strict';
    _0x28927e(_0x5e13d3)[_0x530c('0x0')](function (_0x372281) {
        _0x372281('#exampleSingleItem')[_0x530c('0x1')]();
        _0x372281(_0x530c('0x2'))[_0x530c('0x1')]({'infinite': !![], 'slidesToShow': 0x3, 'slidesToScroll': 0x3});
        _0x372281(_0x530c('0x3'))['slick']({
            'dots': !![],
            'infinite': ![],
            'speed': 0x1f4,
            'slidesToShow': 0x4,
            'slidesToScroll': 0x4,
            'responsive': [{
                'breakpoint': 0x400,
                'settings': {'slidesToShow': 0x3, 'slidesToScroll': 0x3, 'infinite': !![], 'dots': !![]}
            }, {'breakpoint': 0x258, 'settings': {'slidesToShow': 0x2, 'slidesToScroll': 0x2}}, {
                'breakpoint': 0x1e0,
                'settings': {'slidesToShow': 0x1, 'slidesToScroll': 0x1}
            }]
        });
        _0x372281('#exampleVariableWidth')[_0x530c('0x1')]({
            'dots': !![],
            'infinite': !![],
            'speed': 0x12c,
            'slidesToShow': 0x1,
            'centerMode': !![],
            'variableWidth': !![]
        });
        _0x372281(_0x530c('0x4'))[_0x530c('0x1')]({
            'dots': !![],
            'infinite': !![],
            'speed': 0x12c,
            'slidesToShow': 0x1,
            'adaptiveHeight': !![]
        });
        _0x372281(_0x530c('0x5'))[_0x530c('0x1')]();
        _0x372281('#exampleCenter')[_0x530c('0x1')]({
            'centerMode': !![],
            'centerPadding': '60px',
            'slidesToShow': 0x3,
            'responsive': [{
                'breakpoint': 0x300,
                'settings': {'arrows': ![], 'centerMode': !![], 'centerPadding': _0x530c('0x6'), 'slidesToShow': 0x3}
            }, {
                'breakpoint': 0x1e0,
                'settings': {'arrows': ![], 'centerMode': !![], 'centerPadding': '40px', 'slidesToShow': 0x1}
            }]
        });
        _0x372281(_0x530c('0x7'))[_0x530c('0x1')]({
            'lazyLoad': _0x530c('0x8'),
            'slidesToShow': 0x3,
            'slidesToScroll': 0x1
        });
        _0x372281(_0x530c('0x9'))[_0x530c('0x1')]({
            'dots': !![],
            'infinite': !![],
            'speed': 0x1f4,
            'slidesToShow': 0x3,
            'slidesToScroll': 0x1,
            'autoplay': !![],
            'autoplaySpeed': 0x7d0
        });
        _0x372281(_0x530c('0xa'))[_0x530c('0x1')]({
            'dots': !![],
            'infinite': !![],
            'speed': 0x1f4,
            'fade': !![],
            'slide': 'div',
            'cssEase': _0x530c('0xb')
        });
        var _0x11e9ba = 0x1;
        _0x372281('#exampleAddRemove')['slick']({
            'dots': !![],
            'slidesToShow': 0x3,
            'speed': 0x1f4,
            'slidesToScroll': 0x3
        });
        _0x372281('#exampleAddSlide')['on']('click', function () {
            _0x11e9ba++;
            _0x372281(_0x530c('0xc'))[_0x530c('0x1')](_0x530c('0xd'), _0x530c('0xe') + _0x11e9ba + '</h3></div>');
        });
        _0x372281(_0x530c('0xf'))['on']('click', function () {
            _0x372281('#exampleAddRemove')[_0x530c('0x1')]('slickRemove', _0x11e9ba - 0x1);
            if (_0x11e9ba !== 0x0) {
                _0x11e9ba--;
            }
        });
        _0x372281(_0x530c('0x10'))[_0x530c('0x1')]({'slidesToShow': 0x4, 'slidesToScroll': 0x4});
        var _0x24928f = ![];
        _0x372281('#exampleFilter')['on'](_0x530c('0x11'), function () {
            if (_0x24928f === ![]) {
                _0x372281('#exampleFiltering')[_0x530c('0x1')](_0x530c('0x12'), _0x530c('0x13'));
                _0x372281(this)['text'](_0x530c('0x14'));
                _0x24928f = !![];
            } else {
                _0x372281('#exampleFiltering')['slick'](_0x530c('0x15'));
                _0x372281(this)[_0x530c('0x16')]('过滤');
                _0x24928f = ![];
            }
        });
    });
}(document, window, jQuery));