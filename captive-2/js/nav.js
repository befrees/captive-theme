


var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();



function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }



$(function(){

	var win = $(window);

	var body = $('body');

	var htmlBody = $('html, body');

	var header = $('.header-landing');

	var navmenu = $('.mainnav');

	var Nav = function () {

			function Nav(el) {

				_classCallCheck(this, Nav);
				this._nav = el;
				this._link = this._nav.find('a');
				this._btn = $('.js-nav-btn');
				this._mobileNav = $('.js-nav-mobile');
				this._section = $('.section');
				this._scrollTo();
				this._setActive();
				this._openNav();	
			}
			_createClass(Nav, [{

				key: '_scrollTo',

				value: function _scrollTo() {

					var that = this;

					this._link.click(function (e) {

						e.preventDefault();

						$('#site-header').removeClass('open');

						var _this = $(this);

						var current = _this.attr('href');

						var headerHeight = 0;
						// var headerHeight = header.outerHeight();
						// console.log(current);
						var currentTop = that._section.filter('[data-section="' + current + '"]').offset().top;

						htmlBody.animate({

							scrollTop: currentTop - headerHeight

						}, 700);

						if (that._mobileNav.hasClass('is-active')) {

							that._btn.add(that._mobileNav).removeClass('is-active');

						}

					});

				}

			}, {

				key: '_openNav',

				value: function _openNav() {

					var _this2 = this;

					var that = this;

					this._btn.click(function (e) {

						e.preventDefault();

						$(this).add(that._mobileNav).toggleClass('is-active');

					});

					body.click(function (e) {

						if (_this2._mobileNav.hasClass('is-active') && !$(e.target).closest('.js-nav-mobile').length && !$(e.target).closest('.js-nav-btn').length) {

							_this2._btn.add(_this2._mobileNav).removeClass('is-active');

						}

					});

				}

			}, {

				key: '_setActive',

				value: function _setActive() {

					var _this3 = this;

					var that = this;

					var getActive = function getActive() {

						var scrollTop = win.scrollTop();

						var headerHeight = header.outerHeight();

						var current = void 0;

						_this3._section.each(function () {

							var _this = $(this);

							var currentTop = _this.offset().top;

							if (currentTop <= scrollTop + headerHeight && _this.outerHeight() + currentTop > scrollTop - headerHeight) {

								current = _this.data('section');

							}

						});

						_this3._link.filter('[href="' + current + '"]').addClass('is-active').parents('li').siblings().find('a').removeClass('is-active');
						$(navmenu).find('li').removeClass('active').filter('[data-menuanchor="'+current+'"]').addClass('active');
						$('body').attr('data-active', current);

					};

					win.on('scroll', function () {

						getActive();

					});
					getActive();
				}
			}]);
			return Nav;
		}();
		new Nav(navmenu);

	});