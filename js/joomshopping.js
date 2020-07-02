function portoCalcSliderMargin(t, e) {
    t.css({
        "margin-left": "-" + e,
        "margin-right": "-" + e
    })
}

function portoCalcSliderButtonsPosition(t, e) {
    var i = t.find(".owl-buttons");
    i.length && (window.theme.rtl ? i.css("left", e) : i.css("right", e))
}

function portoCalcSliderTitleLine(t) {
    var e = (t.width(), t.parent().find(".slider-title"));
    if (e.length) {
        var i = e.find(".line"),
            n = e.find(".inline-title");
        if (n.length && i.length) {
            var o = e.width(),
                a = n.width();
            i.css(o > a + 200 ? window.theme.rtl ? {
                display: "block",
                right: a + 20,
                width: o - a - 75
            } : {
                display: "block",
                left: a + 20,
                width: o - a - 75
            } : {
                display: "none"
            })
        }
    }
}
window.theme = {},
    function(t, e) {
        t = t || {};
        var i = !1;
        e.extend(t, {
            rtl: "1" == js_porto_vars.rtl ? !0 : !1,
            ajax_url: js_porto_vars.ajax_url,
            request_error: js_porto_vars.request_error,
            change_logo: "1" == js_porto_vars.change_logo ? !0 : !1,
            show_sticky_header: "1" == js_porto_vars.show_sticky_header ? !0 : !1,
            show_sticky_header_tablet: "1" == js_porto_vars.show_sticky_header_tablet ? !0 : !1,
            show_sticky_header_mobile: "1" == js_porto_vars.show_sticky_header_mobile ? !0 : !1,
            post_zoom: "1" == js_porto_vars.post_zoom ? !0 : !1,
            portfolio_zoom: "1" == js_porto_vars.portfolio_zoom ? !0 : !1,
            member_zoom: "1" == js_porto_vars.member_zoom ? !0 : !1,
            container_width: js_porto_vars.container_width,
            grid_gutter_width: js_porto_vars.grid_gutter_width,
            hoverIntentConfig: {
                sensitivity: 2,
                interval: 0,
                timeout: 0
            },
            owlConfig: {
                autoPlay: 5e3,
                stopOnHover: !0,
                singleItem: !0,
                autoHeight: !0,
                lazyLoad: !0
            },
            infiniteConfig: {
                navSelector: "div.pagination",
                nextSelector: "div.pagination a.next",
                loading: {
                    finishedMsg: "",
                    msgText: "<em class='infinite-loading'></em>",
                    img: "data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                }
            },
            getScrollbarWidth: function() {
                return i ? this.scrollbar_width : (i = !0, this.scrollbar_width = window.innerWidth - e(window).width(), this.scrollbar_width)
            },
            isTablet: function() {
                var i = e(window).width();
                return i < 992 - t.scrollbar_width ? !0 : !1
            },
            isMobile: function() {
                var i = e(window).width();
                return i <= 480 - t.scrollbar_width ? !0 : !1
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {};
        var i = /iPhone/i,
            n = /iPod/i,
            o = /iPad/i,
            a = /(?=.*\bAndroid\b)(?=.*\bMobile\b)/i,
            s = /Android/i,
            r = /IEMobile/i,
            l = /(?=.*\bWindows\b)(?=.*\bARM\b)/i,
            d = /BlackBerry/i,
            c = /BB10/i,
            h = /Opera Mini/i,
            u = /(?=.*\bFirefox\b)(?=.*\bMobile\b)/i,
            f = new RegExp("(?:Nexus 7|BNTV250|Kindle Fire|Silk|GT-P1000)", "i"),
            p = function(t, e) {
                return t.test(e)
            },
            m = function(t) {
                var e = t || navigator.userAgent;
                return this.apple = {
                    phone: p(i, e),
                    ipod: p(n, e),
                    tablet: p(o, e),
                    device: p(i, e) || p(n, e) || p(o, e)
                }, this.android = {
                    phone: p(a, e),
                    tablet: !p(a, e) && p(s, e),
                    device: p(a, e) || p(s, e)
                }, this.windows = {
                    phone: p(r, e),
                    tablet: p(l, e),
                    device: p(r, e) || p(l, e)
                }, this.other = {
                    blackberry: p(d, e),
                    blackberry10: p(c, e),
                    opera: p(h, e),
                    firefox: p(u, e),
                    device: p(d, e) || p(c, e) || p(h, e) || p(u, e)
                }, this.seven_inch = p(f, e), this.any = this.apple.device || this.android.device || this.windows.device || this.other.device || this.seven_inch, this.phone = this.apple.phone || this.android.phone || this.windows.phone, this.tablet = this.apple.tablet || this.android.tablet || this.windows.tablet, "undefined" == typeof window ? this : void 0
            },
            g = function() {
                var t = new m;
                return t.Class = m, t
            };
        e.extend(t, {
            MobileCheck: g()
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        "use strict";
        t = t || {};
        var i = ['<div class="loading-overlay">', '<div class="loader"></div>', "</div>"].join(""),
            n = function(t, e) {
                return this.initialize(t, e)
            };
        n.prototype = {
            options: {
                css: {}
            },
            initialize: function(t, e) {
                this.$wrapper = t, this.setVars().setOptions(e).build().events(), this.$wrapper.data("loadingOverlay", this)
            },
            setVars: function() {
                return this.$overlay = this.$wrapper.find(".loading-overlay"), this
            },
            setOptions: function(t) {
                return this.$overlay.get(0) || this.matchProperties(), this.options = e.extend(!0, {}, this.options, t), this.loaderClass = this.getLoaderClass(this.options.css.backgroundColor), this
            },
            build: function() {
                return this.$overlay.closest(document.documentElement).get(0) || (this.$cachedOverlay ? this.$overlay = this.$cachedOverlay.clone() : (this.$overlay = e(i).clone(), this.options.css && (this.$overlay.css(this.options.css), this.$overlay.find(".loader").addClass(this.loaderClass))), this.$wrapper.append(this.$overlay)), this.$cachedOverlay || (this.$cachedOverlay = this.$overlay.clone()), this
            },
            events: function() {
                var t = this;
                return this.options.startShowing && t.show(), (this.$wrapper.is("body") || this.options.hideOnWindowLoad) && e(window).on("load error", function() {
                    t.hide()
                }), this.options.listenOn && e(this.options.listenOn).on("loading-overlay:show beforeSend.ic", function(e) {
                    e.stopPropagation(), t.show()
                }).on("loading-overlay:hide complete.ic", function(e) {
                    e.stopPropagation(), t.hide()
                }), this.$wrapper.on("loading-overlay:show beforeSend.ic", function(e) {
                    e.stopPropagation(), t.show()
                }).on("loading-overlay:hide complete.ic", function(e) {
                    e.stopPropagation(), t.hide()
                }), this
            },
            show: function() {
                this.build(), this.position = this.$wrapper.css("position").toLowerCase(), ("relative" != this.position || "absolute" != this.position || "fixed" != this.position) && this.$wrapper.css({
                    position: "relative"
                }), this.$wrapper.addClass("loading-overlay-showing")
            },
            hide: function() {
                var t = this;
                this.$wrapper.removeClass("loading-overlay-showing"), setTimeout(function() {
                    ("relative" != this.position || "absolute" != this.position || "fixed" != this.position) && t.$wrapper.css({
                        position: ""
                    })
                }, 500)
            },
            matchProperties: function() {
                var t, i, n;
                for (n = ["backgroundColor", "borderRadius"], i = n.length, t = 0; i > t; t++) {
                    var o = {};
                    o[n[t]] = this.$wrapper.css(n[t]), e.extend(this.options.css, o)
                }
            },
            getLoaderClass: function(t) {
                if (!t || "transparent" === t || "inherit" === t) return "black";
                var e, i, n, o, a, s = function(t) {
                    var e, i;
                    return t.indexOf("#") > -1 ? e = t.replace("#", "") : (i = t.match(/\d+/g), e = ("0" + parseInt(i[0], 10).toString(16)).slice(-2) + ("0" + parseInt(i[1], 10).toString(16)).slice(-2) + ("0" + parseInt(i[2], 10).toString(16)).slice(-2)), 3 === e.length && (e += e), e
                };
                return e = s(t), i = parseInt(e.substr(0, 2), 16), n = parseInt(e.substr(2, 2), 16), o = parseInt(e.substr(4, 2), 16), a = (299 * i + 587 * n + 114 * o) / 1e3, a >= 128 ? "black" : "white"
            }
        }, e.extend(t, {
            LoadingOverlay: n
        }), e.fn.loadingOverlay = function(t) {
            return this.each(function() {
                var i = e(this),
                    o = i.data("loadingOverlay");
                if (o) return o;
                var a = t || i.data("loading-overlay-options") || {};
                return new n(i, a)
            })
        }, e(function() {
            e("[data-loading-overlay]").loadingOverlay()
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            MegaMenu: {
                defaults: {
                    menu: e(".mega-menu")
                },
                initialize: function(t) {
                    return this.$menu = t || this.defaults.menu, this.build().events(), this
                },
                popupWidth: function() {
                    var i = e(window).width() + t.getScrollbarWidth();
                    return i >= t.container_width ? t.container_width - t.grid_gutter_width : i >= 992 ? 940 : i >= 768 ? 720 : e(window).width() - t.grid_gutter_width
                },
                build: function() {
                    var i = this;
                    return i.$menu.each(function() {
                        var n = e(this),
                            o = n.closest(".container"),
                            a = i.popupWidth(),
                            s = 0;
                        o.length && (s = t.rtl ? o.offset().left + o.width() - (n.offset().left + n.width()) + parseInt(o.css("padding-right")) : n.offset().left - o.offset().left - parseInt(o.css("padding-left")), s = 1 == s ? 0 : s);
                        var r = n.find("> li");
                        r.each(function() {
                            var i = e(this),
                                o = i.find("> .popup");
                            if (o.length > 0) {
                                if (o.css("display", "block"), i.hasClass("wide")) {
                                    o.css("left", 0);
                                    var l = parseInt(o.css("padding-left")) + parseInt(o.css("padding-right")) + parseInt(o.find("> .inner").css("padding-left")) + parseInt(o.find("> .inner").css("padding-right")),
                                        d = 4;
                                    i.hasClass("col-2") && (d = 2), i.hasClass("col-3") && (d = 3), i.hasClass("col-4") && (d = 4), i.hasClass("col-5") && (d = 5), i.hasClass("col-6") && (d = 6), e(window).width() < 992 - t.scrollbarWidth && (d = 1);
                                    var c = 0;
                                    o.find("> .inner > ul > li").each(function() {
                                        var t = parseInt(e(this).attr("data-cols"));
                                        1 > t && (t = 1), t > d && (t = d), c += t
                                    }), c > d && (c = d);
                                    var h = o.find(".inner").css("max-width"),
                                        u = a / d;
                                    if ("none" !== h && a > h && (u = parseInt(h) / d), o.find("> .inner > ul > li").each(function() {
                                            var t = parseFloat(e(this).attr("data-cols"));
                                            1 > t && (t = 1), t > d && (t = d), i.hasClass("pos-center") || i.hasClass("pos-left") || i.hasClass("pos-right") ? e(this).css("width", 100 / c * t + "%") : e(this).css("width", 100 / d * t + "%")
                                        }), i.hasClass("pos-center")) {
                                        o.find("> .inner > ul").width(u * c - l);
                                        var f = o.offset().left - (e(window).width() - u * c) / 2;
                                        o.css({
                                            left: -f
                                        })
                                    } else if (i.hasClass("pos-left")) o.find("> .inner > ul").width(u * c - l), o.css({
                                        left: 0
                                    });
                                    else if (i.hasClass("pos-right")) o.find("> .inner > ul").width(u * c - l), o.css({
                                        left: "auto",
                                        right: 0
                                    });
                                    else if (o.find("> .inner > ul").width(a - l), t.rtl) {
                                        o.css({
                                            right: 0,
                                            left: "auto"
                                        });
                                        var p = o.offset().left + o.width() - (n.offset().left + n.width()) - s;
                                        o.css({
                                            right: p,
                                            left: "auto"
                                        })
                                    } else {
                                        o.css({
                                            left: 0,
                                            right: "auto"
                                        });
                                        var f = o.offset().left - n.offset().left + s;
                                        o.css({
                                            left: -f,
                                            right: "auto"
                                        })
                                    }
                                }
                                n.hasClass("effect-down") || o.css("display", "none"), i.hoverIntent(e.extend({}, t.hoverIntentConfig, {
                                    over: function() {
                                        n.hasClass("effect-down") || r.find(".popup").hide(), o.show()
                                    },
                                    out: function() {
                                        n.hasClass("effect-down") || o.hide()
                                    }
                                }))
                            }
                        })
                    }), i
                },
                events: function() {
                    var t = this;
                    return e(window).on("resize", function() {
                        t.build()
                    }), setTimeout(function() {
                        t.build()
                    }, 400), t
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            SidebarMenu: {
                defaults: {
                    menu: e(".sidebar-menu"),
                    toggle: e(".widget_sidebar_menu .widget-title .toggle"),
                    menu_toggle: e("#main-toggle-menu .menu-title")
                },
                rtl: t.rtl,
                initialize: function(t, e, i) {
                    return this.$menu = t || this.defaults.menu, this.$toggle = e || this.defaults.toggle, this.$menu_toggle = i || this.defaults.menu_toggle, this.build().events(), this
                },
                isRightSidebar: function(t) {
                    var i = !1;
                    return i = this.rtl ? !(e("#main").hasClass("column2-right-sidebar") || e("#main").hasClass("column2-wide-right-sidebar")) : e("#main").hasClass("column2-right-sidebar") || e("#main").hasClass("column2-wide-right-sidebar"), t.closest("#main-toggle-menu").length && (i = this.rtl ? !0 : !1), ($header_wrapper = t.closest(".header-wrapper")) && $header_wrapper.length && $header_wrapper.hasClass("header-side-nav") && (i = this.rtl ? !0 : !1), i
                },
                popupWidth: function() {
                    var i = e(window).width() + t.getScrollbarWidth();
                    return i >= t.container_width ? t.container_width - t.grid_gutter_width : i >= 992 ? 940 : i >= 768 ? 720 : e(window).width() - t.grid_gutter_width
                },
                build: function() {
                    var i = this;
                    return i.$menu.each(function() {
                        {
                            var n, o = e(this);
                            o.closest(".container")
                        }
                        n = e(window).width() < 992 - t.getScrollbarWidth() ? i.popupWidth() : i.popupWidth() - o.width() - 45;
                        var a = i.isRightSidebar(o),
                            s = o.find("> li");
                        s.each(function() {
                            var i = e(this),
                                r = i.find("> .popup");
                            if (r.length > 0) {
                                if (r.css("display", "block"), i.hasClass("wide")) {
                                    r.css("left", 0);
                                    var l = (parseInt(r.css("padding-left")) + parseInt(r.css("padding-right")) + parseInt(r.find("> .inner").css("padding-left")) + parseInt(r.find("> .inner").css("padding-right")), 4);
                                    i.hasClass("col-2") && (l = 2), i.hasClass("col-3") && (l = 3), i.hasClass("col-4") && (l = 4), i.hasClass("col-5") && (l = 5), i.hasClass("col-6") && (l = 6), e(window).width() < 992 - t.getScrollbarWidth() && (l = 1);
                                    var d = 0;
                                    r.find("> .inner > ul > li").each(function() {
                                        var t = parseInt(e(this).attr("data-cols"));
                                        1 > t && (t = 1), t > l && (t = l), d += t
                                    }), d > l && (d = l);
                                    var c = r.find(".inner").css("max-width"),
                                        h = n / l;
                                    "none" !== c && n > c && (h = parseInt(c) / l), r.find("> .inner > ul > li").each(function() {
                                        var t = parseFloat(e(this).attr("data-cols"));
                                        1 > t && (t = 1), t > l && (t = l), i.hasClass("pos-center") || i.hasClass("pos-left") || i.hasClass("pos-right") ? e(this).css("width", 100 / d * t + "%") : e(this).css("width", 100 / l * t + "%")
                                    }), r.find("> .inner > ul").width(h * d + 1), r.css(a ? {
                                        left: "auto",
                                        right: e(this).width()
                                    } : {
                                        left: e(this).width(),
                                        right: "auto"
                                    })
                                }
                                o.hasClass("subeffect-down") || r.css("display", "none"), i.hoverIntent(e.extend({}, t.hoverIntentConfig, {
                                    over: function() {
                                        o.hasClass("subeffect-down") || s.find(".popup").hide(), r.show(), r.parent().addClass("open")
                                    },
                                    out: function() {
                                        o.hasClass("subeffect-down") || r.hide(), r.parent().removeClass("open")
                                    }
                                }))
                            }
                        })
                    }), i
                },
                events: function() {
                    var t = this;
                    return t.$toggle.click(function() {
                        var i = e(this).parent().parent(),
                            n = e(this);
                        n.hasClass("closed") ? (n.removeClass("closed"), i.removeClass("closed"), i.find(".sidebar-menu-wrap").stop().slideDown(400, function() {
                            t.build()
                        })) : (n.addClass("closed"), i.addClass("closed"), i.find(".sidebar-menu-wrap").stop().slideUp(400))
                    }), this.$menu_toggle.click(function() {
                        var i = e(this).parent(),
                            n = e(this);
                        n.hasClass("closed") ? (n.removeClass("closed"), i.removeClass("closed"), i.find(".toggle-menu-wrap").stop().slideDown(), t.build()) : (n.addClass("closed"), i.addClass("closed"), i.find(".toggle-menu-wrap").stop().slideUp())
                    }), e(window).on("resize", function() {
                        t.build()
                    }), setTimeout(function() {
                        t.build()
                    }, 400), t
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            AccordionMenu: {
                defaults: {
                    menu: e(".accordion-menu")
                },
                initialize: function(t) {
                    return this.$menu = t || this.defaults.menu, this.events().build(), this
                },
                build: function() {
                    var t = this;
                    return t.$menu.find("li.menu-item.active").each(function() {
                        e(this).find("> .arrow").length && e(this).find("> .arrow").click()
                    }), t
                },
                events: function() {
                    var t = this;
                    return t.$menu.find(".arrow").click(function() {
                        var t = e(this).parent();
                        e(this).next().stop().slideToggle(), t.hasClass("open") ? t.removeClass("open") : t.addClass("open")
                    }), t
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            StickyHeader: {
                defaults: {
                    header: e("#header")
                },
                initialize: function(e) {
                    if (this.$header = e || this.defaults.header, this.sticky_height = 0, this.sticky_offset = 0, this.sticky_pos = 0, this.change_logo = t.change_logo, !t.show_sticky_header || !this.$header.length) return this;
                    var i = this,
                        n = i.$header.find("> .header-top");
                    n.length ? (i.$header_top = n, i.top_height = n.height()) : i.$header_top = !1;
                    var o = i.$header.find("> .main-menu-wrap");
                    return o.length ? (i.$menu_wrap = o, i.menu_height = o.height()) : i.$menu_wrap = !1, i.$header_main = i.$header.find(".header-main"), i.is_sticky = !1, i.reset().build().events(), i
                },
                build: function() {
                    var i = this;
                    if (!i.is_sticky && e(window).height() + i.header_height + i.adminbar_height + 5 >= e(document).height()) return i;
                    var n = e(window).scrollTop();
                    return i.$menu_wrap && !t.isTablet() ? (i.$header_main.css("top", 0), i.$header.parent().hasClass("fixed-header") && i.$header.parent().attr("style", ""), n > i.sticky_pos ? (i.$header.addClass("sticky-header"), i.$header.css("padding-bottom", i.menu_height), i.$menu_wrap.css("top", i.adminbar_height), i.$header.parent().hasClass("fixed-header") && (i.$header_main.hide(), i.$header.css("padding-bottom", 0)), i.init_toggle_menu || (i.init_toggle_menu = !0, t.MegaMenu.build(), e("#main-toggle-menu").length && (e("#main-toggle-menu").hasClass("show-always") && (e("#main-toggle-menu").data("show-always", !0), e("#main-toggle-menu").removeClass("show-always")), e("#main-toggle-menu").addClass("closed"), e("#main-toggle-menu .menu-title").addClass("closed"), e("#main-toggle-menu .toggle-menu-wrap").attr("style", ""))), i.is_sticky = !0) : (i.$header.removeClass("sticky-header"), i.$header.css("padding-bottom", 0), i.$menu_wrap.css("top", 0), i.$header_main.show(), i.init_toggle_menu && (i.init_toggle_menu = !1, t.MegaMenu.build(), e("#main-toggle-menu").length && e("#main-toggle-menu").data("show-always") && (e("#main-toggle-menu").addClass("show-always"), e("#main-toggle-menu").removeClass("closed"), e("#main-toggle-menu .menu-title").removeClass("closed"), e("#main-toggle-menu .toggle-menu-wrap").attr("style", ""))), i.is_sticky = !1)) : (i.$header_main.show(), i.$header.parent().hasClass("fixed-header") && e("#wpadminbar").length && "absolute" == e("#wpadminbar").css("position") ? i.$header.parent().css("top", e("#wpadminbar").height() - n < 0 ? -e("#wpadminbar").height() : -n) : i.$header.parent().hasClass("fixed-header") ? i.$header.parent().attr("style", "") : i.$header.parent().hasClass("fixed-header") && i.$header.parent().attr("style", ""), i.$header.hasClass("sticky-menu-header") && !t.isTablet() ? (i.$header_main.css("top", 0), i.$header.removeClass("sticky-header"), i.$header_main.removeClass("sticky"), i.change_logo && i.$header_main.removeClass("change-logo"), i.is_sticky = !1, i.sticky_height = 0, i.sticky_offset = 0) : (i.$menu_wrap && i.$menu_wrap.css("top", 0), n > i.sticky_pos && (!t.isTablet() || t.isTablet() && !t.isMobile() && t.show_sticky_header_tablet || t.isMobile() && t.show_sticky_header_tablet && t.show_sticky_header_mobile) ? (i.$header.addClass("sticky-header"), i.$header.css("padding-bottom", i.sticky_main_height), i.$header_main.addClass("sticky"), i.change_logo && i.$header_main.addClass("change-logo"), i.$header_main.css("top", i.adminbar_height), i.init_toggle_menu || (i.init_toggle_menu = !0, t.MegaMenu.build(), e("#main-toggle-menu").length && (e("#main-toggle-menu").hasClass("show-always") && (e("#main-toggle-menu").data("show-always", !0), e("#main-toggle-menu").removeClass("show-always")), e("#main-toggle-menu").addClass("closed"), e("#main-toggle-menu .menu-title").addClass("closed"), e("#main-toggle-menu .toggle-menu-wrap").attr("style", ""))), i.is_sticky = !0) : (i.$header.removeClass("sticky-header"), i.$header.css("padding-bottom", 0), i.$header_main.removeClass("sticky"), i.change_logo && i.$header_main.removeClass("change-logo"), i.$header_main.css("top", 0), i.init_toggle_menu && (i.init_toggle_menu = !1, t.MegaMenu.build(), e("#main-toggle-menu").length && e("#main-toggle-menu").data("show-always") && (e("#main-toggle-menu").addClass("show-always"), e("#main-toggle-menu").removeClass("closed"), e("#main-toggle-menu .menu-title").removeClass("closed"), e("#main-toggle-menu .toggle-menu-wrap").attr("style", ""))), i.is_sticky = !1))), i
                },
                reset: function() {
                    var i = this,
                        n = e("#wpadminbar"),
                        o = 0;
                    return n.length && (o = "fixed" == e("#wpadminbar").css("position") ? e("#wpadminbar").height() : 0), i.adminbar_height = o, i.$menu_wrap && !t.isTablet() ? (i.$header_main.addClass("sticky"), i.change_logo && i.$header_main.addClass("change-logo"), i.$header.addClass("sticky-header"), i.sticky_height = i.$menu_wrap.height() + 2 * parseInt(i.$menu_wrap.css("padding-top")), i.sticky_offset = 2 * parseInt(i.$menu_wrap.css("padding-top")), i.$header_main.removeClass("sticky"), i.change_logo && i.$header_main.removeClass("change-logo"), i.$header.removeClass("sticky-header"), i.header_height = i.$header.height(), i.menu_height = i.$menu_wrap.height(), i.sticky_pos = i.header_height - i.menu_height + e(".banner-before-header").height()) : (i.$header.addClass("sticky-header"), i.$header_main.addClass("sticky"), i.change_logo && i.$header_main.addClass("change-logo"), i.sticky_main_height = i.$header_main.height(), i.$header.removeClass("sticky-header"), i.$header_main.removeClass("sticky"), i.change_logo && i.$header_main.removeClass("change-logo"), i.header_height = i.$header.height(), i.main_height = i.$header_main.height(), i.sticky_height = i.sticky_main_height, i.sticky_offset = i.main_height - i.sticky_main_height, !t.isTablet() || t.isTablet() && !t.isMobile() && t.show_sticky_header_tablet || t.isMobile() && t.show_sticky_header_tablet && t.show_sticky_header_mobile || (i.sticky_height = 0, i.sticky_offset = 0), i.sticky_pos = i.header_height - i.sticky_main_height + e(".banner-before-header").height()), i.init_toggle_menu = !1, i.$header.removeAttr("style"), i
                },
                events: function() {
                    var t = this;
                    return e(window).on("resize", function() {
                        t.reset().build()
                    }), e(window).on("scroll", function() {
                        t.build()
                    }), t
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            SideNav: {
                defaults: {
                    side_nav: e(".header-side-nav #header")
                },
                bc_pos_top: 0,
                initialize: function(t) {
                    if (this.$side_nav = t || this.defaults.side_nav, !this.$side_nav.length) return this;
                    var e = this;
                    return e.$side_nav.addClass("initialize"), e.reset().build().events(), e
                },
                build: function() {
                    var i = this;
                    if ($page_top = e(".page-top"), $main = e("#main"), t.isTablet()) i.$side_nav.removeClass("fixed-bottom"), $page_top.removeClass("fixed-pos"), $page_top.attr("style", ""), $main.attr("style", "");
                    else {
                        var n = i.$side_nav.innerHeight(),
                            o = e(window).height(),
                            a = e(window).scrollTop();
                        n - o + i.adminbar_height <= a ? i.$side_nav.hasClass("fixed-bottom") || i.$side_nav.addClass("fixed-bottom") : i.$side_nav.hasClass("fixed-bottom") && i.$side_nav.removeClass("fixed-bottom"), $page_top.length && (i.page_top_offset == i.adminbar_height || i.page_top_offset <= a ? $page_top.hasClass("fixed-pos") || ($page_top.addClass("fixed-pos"), $page_top.css("top", i.adminbar_height), $main.css("padding-top", $page_top.outerHeight())) : $page_top.hasClass("fixed-pos") && ($page_top.removeClass("fixed-pos"), $page_top.attr("style", ""), $main.attr("style", "")))
                    }
                    return i
                },
                reset: function() {
                    var i = this;
                    if (t.isTablet()) i.$side_nav.attr("style", "");
                    else {
                        var n = e("#wpadminbar"),
                            o = 0;
                        n.length && (o = "fixed" == e("#wpadminbar").css("position") ? e("#wpadminbar").height() : 0), i.adminbar_height = o;
                        var a = e(window).height();
                        $side_bottom = i.$side_nav.find(".side-bottom"), i.$side_nav.css({
                            "min-height": a - i.adminbar_height,
                            "padding-bottom": $side_bottom.height() + parseInt($side_bottom.css("margin-top")) + parseInt($side_bottom.css("margin-bottom"))
                        });
                        var s = navigator.appVersion,
                            r = s.indexOf("AppleWebKit/") + 12,
                            l = r + 3,
                            d = s.slice(r, l);
                        537 > d && (i.$side_nav.css("-webkit-backface-visibility", "hidden"), i.$side_nav.css("-webkit-perspective", "1000"))
                    }
                    return $page_top = e(".page-top"), $main = e("#main"), $page_top.length && ($page_top.removeClass("fixed-pos"), $page_top.attr("style", ""), $main.attr("style", ""), i.page_top_offset = $page_top.offset().top), i
                },
                events: function() {
                    var t = this;
                    return e(window).on("resize", function() {
                        t.reset().build()
                    }), e(window).on("scroll", function() {
                        t.build()
                    }), t
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            Search: {
                defaults: {
                    popup: e(".searchform-popup"),
                    form: e(".searchform")
                },
                initialize: function(t, e) {
                    return this.$popup = t || this.defaults.popup, this.$form = e || this.defaults.form, this.build().events(), this
                },
                build: function() {
                    return this
                },
                events: function() {
                    var t = this;
                    return t.$popup.click(function(t) {
                        t.stopPropagation()
                    }), t.$popup.find(".search-toggle").click(function(t) {
                        e(this).next().toggle(), t.stopPropagation()
                    }), "ontouchstart" in document || (e("html,body").click(function() {
                        t.removeFormStyle()
                    }), e(window).on("resize", function() {
                        t.removeFormStyle()
                    })), t
                },
                removeFormStyle: function() {
                    this.$form.removeAttr("style")
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            Panel: {
                initialize: function() {
                    return this.events(), this
                },
                events: function() {
                    var i = this;
                    return e(".mobile-toggle").click(function() {
                        var t = e("html");
                        t.hasClass("panel-opened") ? (t.removeClass("panel-opened"), e(".panel-overlay").removeClass("active")) : (t.addClass("panel-opened"), e(".panel-overlay").addClass("active"))
                    }), e(".panel-overlay").click(function() {
                        var t = e("html");
                        t.removeClass("panel-opened"), e(this).removeClass("active")
                    }), e(window).on("resize", function() {
                        var i = e(window).width();
                        i > 991 - t.getScrollbarWidth() && e(".panel-overlay").click()
                    }), i
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            HashScroll: {
                initialize: function() {
                    return this.build().events(), this
                },
                build: function() {
                    var i = this,
                        n = window.location.hash,
                        o = e(n);
                    if (o.length && "#review_form" != n && "#reviews" != n && -1 == n.indexOf("#comment-")) {
                        var a = 400;
                        e(window).scrollTop() < t.StickyHeader.sticky_pos && (a += 250, e("html, body").animate({
                            scrollTop: t.StickyHeader.sticky_pos + 1
                        }, 200)), setTimeout(function() {
                            e("html, body").stop().animate({
                                scrollTop: o.offset().top - t.StickyHeader.sticky_height - t.StickyHeader.adminbar_height
                            }, 600, "easeOutQuad", function() {
                                i.activeMenuItem()
                            })
                        }, a)
                    }
                    return i
                },
                activeMenuItem: function() {
                    var i = this;
                    if (e("body").hasClass("scrolling")) return i;
                    var n = e(window).scrollTop(),
                        o = e(".menu-item > a[href*=#]");
                    return o.length && o.each(function() {
                        var i = e(this),
                            o = i.attr("href"),
                            a = {};
                        if (0 == o.indexOf("#")) a = e(o);
                        else {
                            var s = window.location.href;
                            s = s.substring(s.indexOf("://") + 3), -1 != s.indexOf("#") && (s = s.substring(0, s.indexOf("#"))), o = o.substring(o.indexOf("://") + 3), o = o.substring(o.indexOf(s) + s.length), 0 == o.indexOf("#") && (a = e(o))
                        }
                        if (a.length) {
                            var r = a.offset().top - t.StickyHeader.sticky_height - t.StickyHeader.adminbar_height + 1;
                            r <= t.StickyHeader.sticky_pos && (r = t.StickyHeader.sticky_pos + 1);
                            var l = i.parent();
                            n + 5 >= r ? (l.siblings().removeClass("active"), l.addClass("active")) : l.removeClass("active")
                        }
                    }), i
                },
                events: function() {
                    var i = this;
                    return e(".menu-item > a[href*=#], a[href^=#].hash-scroll, .hash-scroll-wrap a[href^=#]").on("click", function(n) {
                        n.preventDefault();
                        var o = e(this),
                            a = o.attr("href"),
                            s = {};
                        if (0 == a.indexOf("#")) s = e(a);
                        else {
                            var r = window.location.href;
                            r = r.substring(r.indexOf("://") + 3), -1 != r.indexOf("#") && (r = r.substring(0, r.indexOf("#"))), a = a.substring(a.indexOf("://") + 3), a = a.substring(a.indexOf(r) + r.length), 0 == a.indexOf("#") && (s = e(a))
                        }
                        if (s.length) {
                            var l = o.parent();
                            l.siblings().removeClass("active"), l.addClass("active"), e("body").addClass("scrolling");
                            var d = 200;
                            e(window).scrollTop() < t.StickyHeader.sticky_pos && (d += 250, e("html, body").animate({
                                scrollTop: t.StickyHeader.sticky_pos + 1
                            }, 200)), setTimeout(function() {
                                var n = s.offset().top - t.StickyHeader.sticky_height - t.StickyHeader.adminbar_height + 1;
                                n <= t.StickyHeader.sticky_pos && (n = t.StickyHeader.sticky_pos + 1), e("html, body").stop().animate({
                                    scrollTop: n
                                }, 600, "easeOutQuad", function() {
                                    e("body").removeClass("scrolling"), i.activeMenuItem()
                                })
                            }, d)
                        } else window.location.href = o.attr("href")
                    }), e(window).on("scroll", function() {
                        i.activeMenuItem()
                    }), i
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            FlickrZoom: {
                defaults: {
                    wrapper: e(".wpb_flickr_widget")
                },
                initialize: function(t) {
                    return this.$wrapper = t || this.defaults.wrapper, this.build(), this
                },
                build: function() {
                    var t = this;
                    return t.$wrapper.each(function() {
                        var t = [],
                            i = 0,
                            n = e(this).find(".flickr_badge_image > a");
                        n.each(function() {
                            var n = {},
                                o = e(this).find("> img");
                            n.title = o.attr("title"), n.href = o.attr("src").replace("_s.", "_b."), n.thumbnail = o.attr("src"), t[i] = n, i++
                        }), n.unbind("click").click(function(i) {
                            i.preventDefault();
                            var o = {
                                index: n.index(e(this)),
                                event: i
                            };
                            blueimp.Gallery(t, o)
                        })
                    }), t
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            WayPoints: {
                defaults: {
                    wrapper: e("body")
                },
                initialize: function(t) {
                    return this.$wrapper = t || this.defaults.wrapper, this.build(), this
                },
                build: function() {
                    var t = this;
                    if (e().waypoint) {
                        var i = t.$wrapper.find(".appear-animation");
                        i.waypoint(function() {
                            var t = e(this),
                                i = t.attr("data-appear-animation"),
                                n = t.attr("data-appear-animation-duration"),
                                o = t.attr("data-appear-animation-delay");
                            t.addClass("appear-animation-visible " + i), n && (t.css("-moz-animation-duration", n + "ms"), t.css("-webkit-animation-duration", n + "ms"), t.css("-ms-animation-duration", n + "ms"), t.css("-o-animation-duration", n + "ms"), t.css("animation-duration", n + "ms")), o && (t.css("-moz-animation-delay", o + "ms"), t.css("-webkit-animation-delay", o + "ms"), t.css("-ms-animation-delay", o + "ms"), t.css("-o-animation-delay", o + "ms"), t.css("animation-delay", o + "ms"))
                        }, {
                            triggerOnce: !0,
                            offset: "85%"
                        });
                        var n = t.$wrapper.find(".circular-bar");
                        n.waypoint(function() {
                            var t = e(this).find(".circular-bar-chart"),
                                i = t.attr("data-barcolor"),
                                n = t.attr("data-trackcolor"),
                                o = t.attr("data-scalecolor"),
                                a = t.attr("data-linecap"),
                                s = t.attr("data-linewidth"),
                                r = t.attr("data-size"),
                                l = t.attr("data-speed"),
                                d = t.attr("data-percent"),
                                c = t.attr("data-label-value");
                            c || (c = d);
                            var h = t.find(".percent");
                            t.easyPieChart({
                                barColor: i,
                                trackColor: n,
                                scaleColor: o,
                                scaleLength: 5,
                                lineCap: a,
                                lineWidth: s,
                                size: r,
                                rotate: 0,
                                animate: {
                                    duration: l,
                                    enabled: !0
                                },
                                onStep: function(t, e, i) {
                                    h.html(parseInt(c * i / d))
                                }
                            })
                        }, {
                            triggerOnce: !0,
                            offset: "85%"
                        });
                        var o = t.$wrapper.find(".progress-bar-tooltip");
                        o.waypoint(function() {
                            var t = e(this);
                            setTimeout(function() {
                                t.animate({
                                    opacity: 1
                                })
                            }, 500)
                        }, {
                            triggerOnce: !0,
                            offset: "85%"
                        })
                    }
                    return t
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            ScrollToTop: {
                defaults: {
                    html: '<i class="fa fa-chevron-up"></i>',
                    offsetx: 10,
                    offsety: 0
                },
                initialize: function(t, e, i) {
                    return this.html = t || this.defaults.html, this.offsetx = e || this.defaults.offsetx, this.offsety = i || this.defaults.offsety, this.build(), this
                },
                build: function() {
                    var t = this;
                    return "undefined" != typeof scrolltotop && (scrolltotop.controlHTML = t.html, scrolltotop.controlattrs = {
                        offsetx: t.offsetx,
                        offsety: t.offsety
                    }, scrolltotop.init()), t
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            FitVideos: {
                defaults: {
                    wrapper: e("body")
                },
                initialize: function(t) {
                    return this.$wrapper = t || this.defaults.wrapper, this.build().events(), this
                },
                build: function() {
                    var t = this,
                        e = t.$wrapper.find(".fit-video");
                    return e.length && e.fitVids(), t
                },
                events: function() {
                    var t = this;
                    return e(window).on("resize", function() {
                        t.build()
                    }), t
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            RefreshVideoSizes: {
                defaults: {
                    wrapper: e(".video-cover .upb_video-src")
                },
                initialize: function(t) {
                    return this.$wrapper = t || this.defaults.wrapper, this.build().events(), this
                },
                build: function() {
                    var t = this;
                    return t.$wrapper.each(function() {
                        var t = e(this);
                        e('<img src="' + t.attr("poster") + '">').load(function() {
                            e(this).css({
                                position: "absolute",
                                "z-index": -1,
                                bottom: 0
                            }), e("body").append(e(this));
                            var i = e(this).height(),
                                n = e(this).width(),
                                o = i / n,
                                a = t.closest(".vc_row"),
                                s = a.width(),
                                r = a.height();
                            t.css({
                                width: s,
                                "min-width": s,
                                height: s * o
                            }), t.parent().css({
                                width: s,
                                "min-width": s
                            }), r > s * o && (t.css({
                                height: r,
                                "min-width": r / o,
                                width: r * o
                            }), t.parent().css({
                                height: r,
                                "min-width": r / o,
                                width: r * o
                            })), e(this).remove()
                        })
                    }), t
                },
                events: function() {
                    var t = this;
                    return setTimeout(function() {
                        t.build()
                    }, 600), e(window).on("resize", function() {
                        t.build()
                    }), t
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            Accordion: {
                defaults: {
                    elements: e(".panel-group")
                },
                initialize: function(t) {
                    return this.$elements = t || this.defaults.elements, this.build(), this
                },
                build: function() {
                    var t = this;
                    return t.$elements.each(function() {
                        var t = e(this),
                            i = t.find(".collapse"),
                            n = t.data("collapsible"),
                            o = t.data("active-tab");
                        i.length > 0 && ("yes" == n ? i.collapse({
                            toggle: !1,
                            parent: "#" + t.attr("id")
                        }) : !isNaN(o) && o == parseInt(o) && t.find(".collapse").length > o ? (t.find(".collapse").collapse({
                            toggle: !1,
                            parent: "#" + t.attr("id")
                        }), t.find(".collapse").eq(o - 1).collapse("toggle")) : t.find(".collapse").collapse({
                            parent: "#" + t.attr("id")
                        }))
                    }), t
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            Toggle: {
                defaults: {
                    elements: e("section.toggle")
                },
                initialize: function(t) {
                    return this.$elements = t || this.defaults.elements, this.build(), this
                },
                build: function() {
                    var t = this;
                    return t.$elements.each(function() {
                        var t = e(this);
                        t.hasClass("active") && t.find("> div.toggle-content").stop().slideDown(350, function() {}), t.find("> label").unbind("click").click(function(t) {
                            var i = e(this).parent(),
                                n = e(this).parents("div.toogle"),
                                o = e(this).parents(".porto-toggles"),
                                a = n.hasClass("toogle-accordion");
                            a && "undefined" != typeof t.originalEvent && n.find("section.toggle.active > label").trigger("click");
                            var s = i.find("> div.toggle-content");
                            i.hasClass("active") ? o.length && "one-toggle" == o.data("view") || (s.stop().slideUp(350, function() {}), i.removeClass("active")) : (o.length && "one-toggle" == o.data("view") && o.find(".toggle").each(function() {
                                e(this).removeClass("active"), e(this).find("> div.toggle-content").stop().slideUp(350, function() {})
                            }), s.stop().slideDown(350, function() {}), i.addClass("active"))
                        })
                    }), t
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            Tooltip: {
                defaults: {
                    elements: e("body")
                },
                initialize: function(t) {
                    return this.$elements = t || this.defaults.elements, this.build(), this
                },
                build: function() {
                    var t = this;
                    return t.$elements.find("[data-toggle='tooltip']").tooltip(), t.$elements.find(".star-rating").tooltip(), t
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            VcImageZoom: {
                defaults: {
                    elements: e(".porto-vc-zoom")
                },
                initialize: function(t) {
                    return this.$elements = t || this.defaults.elements, this.build(), this
                },
                build: function() {
                    var t = this;
                    return t.$elements.unbind("click").click(function(t) {
                        t.preventDefault();
                        var i, n = e(this),
                            o = n.attr("data-gallery"),
                            a = [],
                            s = 0;
                        if ("true" == o) {
                            var r = e(n.parents(".vc_row").get(0));
                            r.find(".porto-vc-zoom").each(function() {
                                var t = {};
                                t.title = e(this).attr("data-caption"), t.href = e(this).attr("href"), t.thumbnail = e(this).attr("href"), a[s] = t, s++
                            }), i = {
                                index: r.find(".porto-vc-zoom").index(n),
                                event: t
                            }
                        } else {
                            var l = {};
                            l.title = e(this).attr("data-caption"), l.href = e(this).attr("href"), l.thumbnail = e(this).attr("href"), a[s] = l, i = {
                                index: 0,
                                event: t
                            }
                        }
                        return blueimp.Gallery(a, i), !1
                    }), t
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            Slideshow: {
                defaults: {
                    $wrapper: e("body"),
                    slider: ".post-slideshow",
                    zoom: !1,
                    options: {}
                },
                initialize: function(t, e, i, n) {
                    return this.$wrapper = t || this.defaults.wrapper, this.slider = e || this.defaults.slider, this.zoom = i, this.options = n || this.defaults.options, this.build(), this
                },
                build: function() {
                    var i = this;
                    return i.$wrapper.find(i.slider).each(function() {
                        if ("undefined" != typeof i.zoom && i.zoom) {
                            var n = [],
                                o = 0;
                            e(this).find("img").each(function() {
                                var t = {};
                                t.title = e(this).attr("data-caption"), t.href = e(this).attr("data-image"), t.thumbnail = e(this).attr("data-src"), n[o] = t, o++
                            });
                            var a = e(this).find(".zoom");
                            a.unbind("click").click(function(t) {
                                t.preventDefault();
                                var i = {
                                    index: a.index(e(this)),
                                    event: t
                                };
                                blueimp.Gallery(n, i)
                            })
                        }
                        e(this).owlCarousel(e.extend(t.owlConfig, i.options))
                    }), i
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            Carousel: {
                defaults: {
                    carousel: ".post-carousel",
                    options: {}
                },
                initialize: function(t, e, i) {
                    return this.carousel = t || this.defaults.carousel, this.zoom = e, this.options = i || this.defaults.options, this.build(), this
                },
                build: function() {
                    var i = this;
                    return e(i.carousel).each(function() {
                        if ("undefined" != typeof i.zoom && i.zoom) {
                            var n = [],
                                o = 0;
                            e(this).find("img").each(function() {
                                var t = {};
                                t.title = e(this).attr("data-caption"), t.href = e(this).attr("data-image"), t.thumbnail = e(this).attr("src"), n[o] = t, o++
                            });
                            var a = e(this).find(".zoom");
                            a.unbind("click").click(function(t) {
                                t.preventDefault();
                                var i = {
                                    index: a.index(e(this)),
                                    event: t
                                };
                                blueimp.Gallery(n, i)
                            })
                        }
                        var s = e(this).data("cols-lg"),
                            r = e(this).data("cols-md"),
                            l = e(this).data("cols-sm"),
                            d = e(this).data("single"),
                            c = !1;
                        d && (c = !0);
                        var h = [],
                            u = t.getScrollbarWidth(),
                            o = 0;
                        h[o++] = [0, 1], l && (h[o++] = [481 - u, l]), r && (h[o++] = [768 - u, r]), s && (h[o++] = [992 - u, s]), e(this).owlCarousel(e.extend(t.owlConfig, {
                            singleItem: c,
                            itemsCustom: h,
                            autoHeight: !1
                        }, i.options))
                    }), i
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            Grid: {
                defaults: {
                    elements: null,
                    itemSelector: null,
                    callback: null
                },
                initialize: function(t, e, i) {
                    return this.$elements = t || this.defaults.elements, this.itemSelector = e || this.defaults.itemSelector, this.callback = i || this.defaults.callback, this.build(), this
                },
                build: function() {
                    var i = this,
                        n = i.itemSelector,
                        o = i.callback;
                    return i.$elements.length && i.itemSelector && i.$elements.each(function() {
                        var i = e(this);
                        e().isotope && i.imagesLoaded(function() {
                            i.isotope({
                                itemSelector: n,
                                isOriginLeft: !t.rtl
                            }).isotope("layout"), o && i.isotope("on", "layoutComplete", o)
                        })
                    }), i
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            PostsInfinite: {
                defaults: {
                    elements: e(".posts-infinite"),
                    itemSelector: ".posts-infinite .post, .posts-infinite .timeline-date"
                },
                initialize: function(t, e) {
                    return this.$elements = t || this.defaults.elements, this.itemSelector = e || this.defaults.itemSelector, this.build(), this
                },
                build: function() {
                    var i = this;
                    return i.$elements.each(function() {
                        var n = e(this),
                            o = n.attr("data-pagenum"),
                            a = n.attr("data-path");
                        n.infinitescroll(e.extend(t.infiniteConfig, {
                            itemSelector: i.itemSelector,
                            state: {
                                currPage: o
                            },
                            pathParse: function() {
                                return [a, "/"]
                            }
                        }), function(i) {
                            t.Slideshow.initialize(e(i), ".post-slideshow", t.post_zoom), t.WayPoints.initialize(e(i)), t.Tooltip.initialize(e(i)), t.FitVideos.initialize(e(i)), e().isotope && n.hasClass("grid") && (e(i).hide(), e(i).imagesLoaded(function() {
                                e(i).show(), n.data("isotope") && (n.isotope("appended", e(i)).isotope("layout"), t.Tooltip.initialize(e(i)), t.FitVideos.initialize(e(i)), n.isotope("layout"))
                            }))
                        })
                    }), i
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            PortfoliosInfinite: {
                defaults: {
                    elements: e(".portfolios-infinite"),
                    itemSelector: ".portfolios-infinite .portfolio, .portfolios-infinite .timeline-date"
                },
                initialize: function(t, e) {
                    return this.$elements = t || this.defaults.elements, this.itemSelector = e || this.defaults.itemSelector, this.build(), this
                },
                build: function() {
                    var i = this;
                    return i.$elements.each(function() {
                        var n = e(this),
                            o = n.attr("data-pagenum"),
                            a = n.attr("data-path");
                        n.infinitescroll(e.extend(t.infiniteConfig, {
                            itemSelector: i.itemSelector,
                            state: {
                                currPage: o
                            },
                            pathParse: function() {
                                return [a, "/"]
                            }
                        }), function(i) {
                            t.Slideshow.initialize(e(i), ".portfolio-slideshow", t.portfolio_zoom), t.WayPoints.initialize(e(i)), t.Tooltip.initialize(e(i)), t.FitVideos.initialize(e(i));
                            var o = n.closest(".page-portfolios");
                            if (o.hasClass("portfolios-grid")) e().isotope && (e(i).hide(), e(i).imagesLoaded(function() {
                                e(i).show(), n.data("isotope") && (n.isotope("appended", e(i)).isotope("layout"), t.Tooltip.initialize(e(i)), t.FitVideos.initialize(e(i)), n.isotope("layout"))
                            }));
                            else {
                                var a = 0;
                                if (o.find(".portfolio-filter").length) {
                                    var s = o.find(".portfolio-filter .active").attr("data-filter");
                                    e(i).each(function() {
                                        var t = e(this);
                                        "*" == s ? (t.stop().fadeIn(300, function() {
                                            var t = e(this).find(".portfolio-slideshow");
                                            if (t.length) {
                                                var i = e(this).find(".portfolio-slideshow").data("owlCarousel");
                                                i.reload()
                                            }
                                        }), a++) : t.hasClass(s) ? (t.stop().fadeIn(300, function() {
                                            var t = e(this).find(".portfolio-slideshow");
                                            if (t.length) {
                                                var i = e(this).find(".portfolio-slideshow").data("owlCarousel");
                                                i.reload()
                                            }
                                        }), a++) : t.stop().hide()
                                    })
                                }!a && o.find(".portfolios-infinite").length && o.find(".portfolios-infinite").infinitescroll("retrieve"), o.hasClass("portfolios-timeline") && t.FilterZoom.initialize(e(".portfolios-timeline"), t.portfolio_zoom)
                            }
                        })
                    }), i
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            PortfolioLike: {
                initialize: function() {
                    return this.build(), this
                },
                build: function() {
                    var i = this;
                    return e("body").on("click", ".portfolio-like", function(i) {
                        i.preventDefault();
                        var n = e(this),
                            o = n.parent(),
                            a = e(this).attr("data-id");
                        e.post(t.ajax_url, {
                            portfolio_id: a,
                            action: "porto_portfolio-like"
                        }, function(t) {
                            t && (n.remove(), o.html(t), o.find("[data-toggle='tooltip']").tooltip())
                        })
                    }), i
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            PortfolioFilter: {
                defaults: {
                    elements: e(".portfolio-filter")
                },
                initialize: function(t) {
                    return this.$elements = t || this.defaults.elements, this.build(), this
                },
                build: function() {
                    var i = this;
                    return i.$elements.each(function() {
                        var i = e(this);
                        i.find("li").on("click", function(n) {
                            n.preventDefault();
                            var o = e(this).attr("data-filter");
                            i.find(".active").removeClass("active");
                            var a = e(this).closest(".page-portfolios");
                            a.hasClass("portfolios-grid") ? ("*" != o && (o = "." + o), a.find(".portfolio-row").isotope({
                                filter: o
                            })) : (a.find(".portfolio").each(function() {
                                var t = e(this);
                                "*" == o ? t.stop().fadeIn(300, function() {
                                    if (!t.hasClass("portfolio-timeline")) {
                                        var i = e(this).find(".portfolio-slideshow").data("owlCarousel");
                                        i.reload()
                                    }
                                }) : t.hasClass(o) ? t.stop().fadeIn(300, function() {
                                    if (!t.hasClass("portfolio-timeline")) {
                                        var i = e(this).find(".portfolio-slideshow").data("owlCarousel");
                                        i.reload()
                                    }
                                }) : t.stop().fadeOut()
                            }), a.hasClass("portfolios-timeline") && setTimeout(function() {
                                t.FilterZoom.initialize(e(".portfolios-timeline"), t.portfolio_zoom)
                            }, 400)), e(this).addClass("active")
                        })
                    }), i
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            MembersInfinite: {
                defaults: {
                    elements: e(".members-infinite"),
                    itemSelector: ".members-infinite .member"
                },
                initialize: function(t, e) {
                    return this.$elements = t || this.defaults.elements, this.itemSelector = e || this.defaults.itemSelector, this.build(), this
                },
                build: function() {
                    var i = this;
                    return i.$elements.each(function() {
                        var n = e(this),
                            o = n.attr("data-pagenum"),
                            a = n.attr("data-path");
                        n.infinitescroll(e.extend(t.infiniteConfig, {
                            itemSelector: i.itemSelector,
                            state: {
                                currPage: o
                            },
                            pathParse: function() {
                                return [a, "/"]
                            }
                        }), function(i) {
                            e().isotope && (e(i).hide(), e(i).imagesLoaded(function() {
                                e(i).show(), n.data("isotope") && (n.isotope("appended", e(i)).isotope("layout"), t.Tooltip.initialize(e(i)), t.FitVideos.initialize(e(i)), n.isotope("layout"))
                            }))
                        })
                    }), i
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            MemberFilter: {
                defaults: {
                    elements: e(".member-filter")
                },
                initialize: function(t) {
                    return this.$elements = t || this.defaults.elements, this.build(), this
                },
                build: function() {
                    var t = this;
                    return t.$elements.each(function() {
                        var t = e(this);
                        t.find("li").on("click", function(i) {
                            i.preventDefault();
                            var n = e(this).attr("data-filter");
                            t.find(".active").removeClass("active");
                            var o = e(this).closest(".page-members");
                            "*" != n && (n = "." + n), o.find(".member-row").isotope({
                                filter: n
                            }), e(this).addClass("active")
                        })
                    }), t
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            FaqsInfinite: {
                defaults: {
                    elements: e(".faqs-infinite"),
                    itemSelector: ".faqs-infinite section"
                },
                initialize: function(t, e) {
                    return this.$elements = t || this.defaults.elements, this.itemSelector = e || this.defaults.itemSelector, this.build(), this
                },
                build: function() {
                    var i = this;
                    return i.$elements.each(function() {
                        var n = e(this),
                            o = n.attr("data-pagenum"),
                            a = n.attr("data-path");
                        n.infinitescroll(e.extend(t.infiniteConfig, {
                            itemSelector: i.itemSelector,
                            state: {
                                currPage: o
                            },
                            pathParse: function() {
                                return [a, "/"]
                            }
                        }), function(i) {
                            t.Tooltip.initialize(e(i)), t.Toggle.initialize(e(i)), t.WayPoints.initialize(e(i)), t.FitVideos.initialize(e(i))
                        })
                    }), i
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            FaqFilter: {
                defaults: {
                    elements: e(".faq-filter")
                },
                initialize: function(t) {
                    return this.$elements = t || this.defaults.elements, this.build(), this
                },
                build: function() {
                    var t = this;
                    return t.$elements.each(function() {
                        var t = e(this);
                        t.find("li").on("click", function(i) {
                            i.preventDefault();
                            var n = e(this).attr("data-filter");
                            t.find(".active").removeClass("active");
                            var o = e(this).closest(".page-faqs");
                            o.find("section").each(function() {
                                var t = e(this);
                                "*" == n ? t.stop().fadeIn() : t.hasClass(n) ? t.stop().fadeIn() : t.stop().hide()
                            }), e(this).addClass("active")
                        })
                    }), t
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            FilterZoom: {
                defaults: {
                    elements: null,
                    zoom: !1
                },
                initialize: function(t, e) {
                    return this.$elements = t || this.defaults.elements, this.zoom = e, this.build(), this
                },
                build: function() {
                    var t = this;
                    return t.$elements.length && t.zoom && t.$elements.each(function() {
                        e(this).find(".zoom").unbind("click");
                        var t = [],
                            i = 0;
                        e(this).find("article").each(function() {
                            if ("none" != e(this).css("display")) {
                                var n = e(this).find("img"),
                                    o = {};
                                o.title = n.attr("data-caption"), o.href = n.attr("data-image"), o.thumbnail = n.attr("src"), t[i] = o, e(this).find(".zoom").attr("zoom-index", i), i++
                            }
                        }), e(this).find("article").each(function() {
                            "none" != e(this).css("display") && e(this).find(".zoom").click(function(i) {
                                i.preventDefault();
                                var n = {
                                    index: e(this).attr("zoom-index"),
                                    event: i
                                };
                                blueimp.Gallery(t, n)
                            })
                        })
                    }), t
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            PreviewImage: {
                defaults: {
                    elements: e(".thumb-info-preview .thumb-info-image")
                },
                initialize: function(t) {
                    return this.$elements = t || this.defaults.elements, this.build(), this
                },
                build: function() {
                    var t = this;
                    return t.$elements.each(function() {
                        var t = e(this),
                            i = t.attr("data-image");
                        i && t.css("background-image", "url(" + i + ")")
                    }), t
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            SortFilter: {
                defaults: {
                    filters: e(".porto-sort-filters ul"),
                    elements: e(".porto-sort-container .row")
                },
                initialize: function(t, e) {
                    return this.$elements = t || this.defaults.elements, this.$filters = e || this.defaults.filters, this.build(), this
                },
                build: function() {
                    var t = this;
                    return t.$elements.each(function() {
                        var t = e(this);
                        t.isotope({
                            itemSelector: ".porto-sort-item",
                            layoutMode: "fitRows",
                            getSortData: {
                                popular: "[data-popular] parseInt"
                            },
                            sortBy: "popular"
                        })
                    }), t.$filters.each(function() {
                        var t = e(this),
                            i = t.attr("data-sort-id"),
                            n = e("#" + i);
                        n.length && (t.on("click", "li", function(i) {
                            i.preventDefault();
                            var o = e(this);
                            t.find("li").removeClass("active"), o.addClass("active");
                            var a = o.attr("data-sort-by");
                            n.isotope({
                                sortBy: a
                            });
                            var s = o.attr("data-filter-by");
                            n.isotope(s ? {
                                filter: s
                            } : {
                                filter: ".porto-sort-item"
                            })
                        }), t.find("li[data-active]").click())
                    }), t
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    function(t, e) {
        t = t || {}, e.extend(t, {
            WooGridListToggle: {
                initialize: function() {
                    return this.build(), this
                },
                build: function() {
                    var t = this;
                    if (e("#grid").unbind("click").click(function() {
                            if (e(this).addClass("active"), e("#list").removeClass("active"), e.cookie && "list" == e.cookie("gridcookie") || !e.cookie) {
                                var t = e(".gridlist-toggle");
                                if (t.length) {
                                    var i = t.parent().parent(),
                                        n = i.find("ul.products");
                                    n.fadeOut(300, function() {
                                        n.addClass("grid").removeClass("list").fadeIn(300)
                                    })
                                }
                            }
                            return e.cookie && e.cookie("gridcookie", "grid", {
                                path: "/"
                            }), !1
                        }), e("#list").unbind("click").click(function() {
                            if (e(this).addClass("active"), e("#grid").removeClass("active"), e.cookie && "grid" == e.cookie("gridcookie") || !e.cookie) {
                                var t = e(".gridlist-toggle");
                                if (t.length) {
                                    var i = t.parent().parent(),
                                        n = i.find("ul.products");
                                    n.fadeOut(300, function() {
                                        n.addClass("list").removeClass("grid").fadeIn(300)
                                    })
                                }
                            }
                            return e.cookie && e.cookie("gridcookie", "list", {
                                path: "/"
                            }), !1
                        }), e.cookie && e.cookie("gridcookie")) {
                        var i = e(".gridlist-toggle");
                        if (i.length) {
                            var n = i.parent().parent();
                            n.find("ul.products").hasClass("grid") ? e.cookie("gridcookie", "grid", {
                                path: "/"
                            }) : n.find("ul.products").hasClass("list") ? e.cookie("gridcookie", "list", {
                                path: "/"
                            }) : n.find("ul.products").addClass(e.cookie("gridcookie"))
                        }
                    }
                    if (e.cookie && "grid" == e.cookie("gridcookie") && (e(".gridlist-toggle #grid").addClass("active"), e(".gridlist-toggle #list").removeClass("active")), e.cookie && "list" == e.cookie("gridcookie") && (e(".gridlist-toggle #list").addClass("active"), e(".gridlist-toggle #grid").removeClass("active")), e.cookie && null == e.cookie("gridcookie")) {
                        var i = e(".gridlist-toggle");
                        if (i.length) {
                            var n = i.parent().parent();
                            n.find("ul.products").addClass("grid")
                        }
                        e(".gridlist-toggle #grid").addClass("active"), e.cookie && e.cookie("gridcookie", "grid", {
                            path: "/"
                        })
                    }
                    return e(".woocommerce-viewing").off("change").on("change", "select.count", function() {
                        e(this).closest("form").submit()
                    }), t
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    function(t, e) {
        t = t || {}, e.extend(t, {
            WooCategoryFilter: {
                initialize: function() {
                    return this.events(), this
                },
                events: function() {
                    var i = this;
                    return e(".filter-toggle").click(function() {
                        var t = e("html");
                        t.hasClass("filter-opened") ? (t.removeClass("filter-opened"), e(".filter-overlay").removeClass("active")) : (t.addClass("filter-opened"), e(".filter-overlay").addClass("active"))
                    }), e(".filter-overlay").click(function() {
                        var t = e("html");
                        t.removeClass("filter-opened"), e(this).removeClass("active")
                    }), e(window).on("resize", function() {
                        var i = e(window).width();
                        i > 991 - t.getScrollbarWidth() && e(".filter-overlay").click()
                    }), i
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            WooProductsSlider: {
                defaults: {
                    elements: e(".products-slider")
                },
                initialize: function(t) {
                    return this.$elements = t || this.defaults.elements, this.build(), this
                },
                build: function() {
                    var i = this;
                    return i.$elements.each(function() {
                        var i = e(this),
                            n = e(this).attr("data-cols-lg"),
                            o = e(this).attr("data-cols-md"),
                            a = e(this).attr("data-cols-xs"),
                            s = e(this).attr("data-cols-ls"),
                            r = i.parents(".slider-wrapper");
                        i.find(".product").length ? (portoCalcSliderMargin(r, i.find(".product").css("padding-left")), portoCalcSliderButtonsPosition(r, i.find(".product").css("padding-left"))) : i.find(".product-category").length && (portoCalcSliderMargin(r, i.find(".product-category").css("padding-left")), portoCalcSliderButtonsPosition(r, i.find(".product-category").css("padding-left"))), portoCalcSliderTitleLine(r);
                        var l = e(this).data("single"),
                            d = !1,
                            c = !1,
                            h = "1" == e(this).data("pagination") ? !0 : !1,
                            u = "1" == e(this).data("navigation") ? !0 : !1;
                        u || h || (u = !0), l && (d = !0);
                        var f = [],
                            p = t.getScrollbarWidth(),
                            m = 0;
                        f[m++] = s ? [0, s] : [0, 1], a && (f[m++] = [481 - p, a]), o && (f[m++] = [768 - p, o]), n && (f[m++] = [992 - p, n]), e(this).owlCarousel({
                            autoPlay: 5e3,
                            navigation: u,
                            navigationText: ["", ""],
                            pagination: h,
                            rewindNav: !0,
                            stopOnHover: !0,
                            singleItem: d,
                            autoHeight: c,
                            itemsCustom: f,
                            lazyLoad: !0,
                            beforeUpdate: function() {
                                i.find(".product").length ? (portoCalcSliderMargin(r, i.find(".product").css("padding-left")), portoCalcSliderButtonsPosition(r, i.find(".product").css("padding-left"))) : i.find(".product-category").length && (portoCalcSliderMargin(r, i.find(".product-category").css("padding-left")), portoCalcSliderButtonsPosition(r, i.find(".product-category").css("padding-left"))), portoCalcSliderTitleLine(r)
                            },
                            afterInit: function() {
                                i.find(".product").length ? portoCalcSliderButtonsPosition(r, i.find(".product").css("padding-left")) : i.find(".product-category").length && portoCalcSliderButtonsPosition(r, i.find(".product-category").css("padding-left"))
                            }
                        })
                    }), i
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            WooQuickView: {
                initialize: function() {
                    return this.events(), this
                },
                events: function() {
                    var i = this;
                    return e(document).on("click", ".quickview", function(i) {
                        function n() {
                            clearTimeout(a), a = setTimeout(o, 400)
                        }

                        function o() {
                            var t = e(".quickview-wrap-" + s + " .product-image-slider");
                            if (t.length) {
                                var i = t.data("imageSlider");
                                i && i.slideController && i.slideController.locate()
                            }
                        }
                        i.preventDefault();
                        var a, s = e(this).attr("data-id");
                        return e.fancybox({
                            href: t.ajax_url + "?action=porto_product_quickview&pid=" + s,
                            type: "ajax",
                            helpers: {
                                overlay: {
                                    locked: !0
                                }
                            },
                            error: '<p class="fancybox-error">' + t.request_error + "</p>",
                            autoSize: !0,
                            autoWidth: !0,
                            afterShow: function() {
                                e(window).bind("resize", n), setTimeout(function() {
                                    t.Tooltip.initialize(e(".quickview-wrap-" + s))
                                }, 200)
                            },
                            afterClose: function() {
                                e(window).unbind("resize", n)
                            }
                        }), !1
                    }), i
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            WooQtyField: {
                initialize: function() {
                    return this.build().events(), this
                },
                build: function() {
                    var t = this;
                    return e("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").addClass("buttons_added").append('<input type="button" value="+" class="plus" />').prepend('<input type="button" value="-" class="minus" />'), e("input.qty:not(.product-quantity input.qty)").each(function() {
                        var t = parseFloat(e(this).attr("min"));
                        t && t > 0 && parseFloat(e(this).val()) < t && e(this).val(t)
                    }), e(document).off("click", ".plus, .minus").on("click", ".plus, .minus", function() {
                        var t = e(this).closest(".quantity").find(".qty"),
                            i = parseFloat(t.val()),
                            n = parseFloat(t.attr("max")),
                            o = parseFloat(t.attr("min")),
                            a = t.attr("step");
                        i && "" !== i && "NaN" !== i || (i = 0), ("" === n || "NaN" === n) && (n = ""), ("" === o || "NaN" === o) && (o = 0), ("any" === a || "" === a || void 0 === a || "NaN" === parseFloat(a)) && (a = 1), e(this).is(".plus") ? t.val(n && (n == i || i > n) ? n : i + parseFloat(a)) : o && (o == i || o > i) ? t.val(o) : i > 0 && t.val(i - parseFloat(a)), t.trigger("change")
                    }), t
                },
                events: function() {
                    var t = this;
                    return e(document).ajaxComplete(function() {
                        t.build()
                    }), t
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            WooWidgetToggle: {
                defaults: {
                    elements: e(".widget_product_categories .widget-title, .widget_price_filter .widget-title, .widget_layered_nav .widget-title")
                },
                initialize: function(t) {
                    return this.$elements = t || this.defaults.elements, this.build(), this
                },
                build: function() {
                    var t = this;
                    return t.$elements.each(function() {
                        var t = e(this);
                        t.parent().removeClass("closed"), t.find(".toggle").length || t.append('<span class="toggle"></span>'), t.find(".toggle").unbind("click").click(function() {
                            t.next().is(":visible") ? t.parent().addClass("closed") : t.parent().removeClass("closed"), t.next().stop().slideToggle(200)
                        })
                    }), t
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            WooWidgetAccordion: {
                defaults: {
                    elements: e(".widget_product_categories, .widget_price_filter, .widget_layered_nav")
                },
                initialize: function(t) {
                    return this.$elements = t || this.defaults.elements, this.build(), this
                },
                build: function() {
                    var t = this;
                    return t.$elements.each(function() {
                        e(this).find("ul.children").each(function() {
                            e(this).prev().hasClass("toggle") || e(this).before(e('<span class="toggle"></span>').unbind("click").click(function() {
                                e(this).next().is(":visible") ? e(this).parent().removeClass("open").addClass("closed") : e(this).parent().addClass("open").removeClass("closed"), e(this).next().stop().slideToggle(200)
                            }))
                        }), e(this).find('li[class*="current-"]').addClass("current")
                    }), t
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            WooVariationForm: {
                initialize: function() {
                    return this.events(), this
                },
                events: function() {
                    var t = this;
                    return e(document).on("check_variations", "form.variations_form", function() {
                        var t = e(this),
                            i = t.find(".reset_variations");
                        "hidden" == i.css("visibility") && i.hide()
                    }), e(document).on("reset_image", "form.variations_form", function() {
                        var t = e(this).closest(".product"),
                            i = t.find("div.product-images .woocommerce-main-image"),
                            n = i.attr("data-o_src"),
                            o = i.attr("data-o_title"),
                            a = i.attr("data-o_href"),
                            s = t.find(".ms-thumb:eq(0)"),
                            r = s.attr("data-o_src"),
                            l = t.find(".product-image-slider"),
                            d = l.data("imageSlider");
                        if (null != d && "undefined" != typeof d.api.view && d.api.gotoSlide(0), n) {
                            i.attr("src", n).attr("alt", o).attr("title", o).attr("href", a);
                            var c = i.data("elevateZoom");
                            "undefined" != typeof c && c.swaptheimage(i.attr("src"), i.attr("src"))
                        }
                        r && s.attr("src", r)
                    }), e(document).on("found_variation", "form.variations_form", function(t, i) {
                        if ("undefined" != typeof i) {
                            var n = e(this).closest(".product"),
                                o = n.find(".product-image-slider"),
                                a = o.data("imageSlider");
                            null != a && "undefined" != typeof a.api.view && a.api.gotoSlide(0);
                            var s = n.find("div.product-images .woocommerce-main-image"),
                                r = s.attr("data-o_src"),
                                l = s.attr("data-o_title"),
                                d = s.attr("data-o_href"),
                                c = n.find(".ms-thumb:eq(0)"),
                                h = c.attr("data-o_src"),
                                u = i.image_src,
                                f = i.image_link,
                                p = i.image_title,
                                m = i.image_thumb;
                            r || (r = s.attr("src") ? s.attr("src") : "", s.attr("data-o_src", r)), d || (d = s.attr("href") ? s.attr("href") : "", s.attr("data-o_href", d)), l || (l = s.attr("title") ? s.attr("title") : "", s.attr("data-o_title", l)), h || (h = c.attr("src") ? c.attr("src") : "", c.attr("data-o_src", h)), u ? (s.attr("src", u), s.attr("alt", p), s.attr("title", p), s.attr("href", f), c.attr("src", m)) : (s.attr("src", r), s.attr("alt", l), s.attr("title", l), s.attr("href", d), c.attr("src", h));
                            var g = s.data("elevateZoom");
                            "undefined" != typeof g && g.swaptheimage(s.attr("src"), s.attr("src"))
                        }
                    }), t
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        t = t || {}, e.extend(t, {
            WooEvents: {
                initialize: function() {
                    return this.events(), this
                },
                events: function() {
                    var i = this;
                    return e(document).on("click", "a.add_to_cart_button", function() {
                        e(this).addClass("product-adding")
                    }), e("body").bind("added_to_cart", function() {
                        e("ul.products li.product .added_to_cart").remove(), t.Tooltip.initialize(), i.initAjaxRemoveCartItem()
                    }), e("body").bind("wc_fragments_refreshed wc_fragments_loaded", function() {
                        i.initAjaxRemoveCartItem(), e.cookie("woocommerce_items_in_cart") > 0 ? e(".hide_cart_widget_if_empty").closest(".widget_shopping_cart").show() : e(".hide_cart_widget_if_empty").closest(".widget_shopping_cart").hide()
                    }), e(document).on("click", ".product-image .viewcart", function(t) {
                        var i = e(this).attr("data-link");
                        window.location.href = i, t.preventDefault()
                    }), e(document).on("added_to_cart", "body", function() {
                        e(".add_to_cart_button.product-adding").each(function() {
                            var t = e(this);
                            t.removeClass("product-adding"), t.closest(".product").find(".viewcart").addClass("added")
                        })
                    }), "undefined" != typeof yith_wcan && (yith_wcan.container = ".archive-products .products", yith_wcan.pagination = ".shop-loop-before", yith_wcan.result_count = ".shop-loop-after"), e(document).on("click", ".yith-wcan a", function() {
                        if ("undefined" != typeof yith_wcan) {
                            var i = e(window).width();
                            i <= 991 - t.getScrollbarWidth() && e(".filter-overlay").click();
                            var n = 1;
                            e(window).scrollTop() < t.StickyHeader.sticky_pos && (n += 250, e("html, body").animate({
                                scrollTop: t.StickyHeader.sticky_pos + 1
                            }, 200)), setTimeout(function() {
                                e("html, body").stop().animate({
                                    scrollTop: e(yith_wcan.container).offset().top - t.StickyHeader.sticky_height - t.StickyHeader.adminbar_height - 14
                                }, 600, "easeOutQuad")
                            }, n)
                        }
                    }), e(document).on("ready yith-wcan-ajax-filtered", function() {
                        "undefined" != typeof yith_wcan && (e(yith_wcan.container).find(".product").length ? (e(yith_wcan.pagination).show(), e(yith_wcan.result_count).show()) : (e(yith_wcan.pagination).hide(), e(yith_wcan.result_count).hide())), t.WooWidgetToggle.initialize(), t.WooWidgetAccordion.initialize(), t.WooGridListToggle.initialize(), t.Tooltip.initialize(), e.cookie("gridcookie") && e(".archive-products .products").addClass(e.cookie("gridcookie"))
                    }), e(".wcml-switcher li").on("click", function() {
                        if ("disabled" != e(this).parent().attr("disabled")) {
                            var t = e(this).attr("rel");
                            i.loadCurrency(t)
                        }
                    }), i
                },
                updateCartFragment: function(t) {
                    {
                        var i = t.fragments;
                        t.cart_hash
                    }
                    i && e.each(i, function(t, i) {
                        e(t).replaceWith(i)
                    })
                },
                initAjaxRemoveCartItem: function() {
                    var i = this;
                    e("#mini-cart .cart_list").scrollbar(), e(".widget_shopping_cart .remove-product").unbind("click").click(function() {
                        var n = e(this),
                            o = n.data("cart_id"),
                            a = n.data("product_id");
                        return n.closest("li").find(".ajax-loading").show(), e.ajax({
                            type: "POST",
                            dataType: "json",
                            url: t.ajax_url,
                            data: {
                                action: "porto_cart_item_remove",
                                cart_id: o
                            },
                            success: function(t) {
                                i.updateCartFragment(t), e("body").trigger("wc_fragments_refreshed"), e(".viewcart-" + a).removeClass("added"), e(".porto_cart_item_" + o).remove()
                            }
                        }), !1
                    })
                },
                loadCurrency: function(i) {
                    e(".wcml-switcher").attr("disabled", "disabled"), e(".wcml-switcher").append('<li class="loading"></li>');
                    e.ajax({
                        type: "post",
                        url: t.ajax_url,
                        data: {
                            action: "wcml_switch_currency",
                            currency: i
                        },
                        success: function() {
                            e(".wcml-switcher").removeAttr("disabled"), e(".wcml-switcher").find(".loading").remove(), window.location = window.location.href
                        }
                    })
                }
            }
        })
    }.apply(this, [window.theme, jQuery]),
    function(t, e) {
        "use strict";

        function i() {
            if ("undefined" != typeof t.MegaMenu && t.MegaMenu.initialize(), "undefined" != typeof t.SidebarMenu && t.SidebarMenu.initialize(), "undefined" != typeof t.AccordionMenu && t.AccordionMenu.initialize(), "undefined" != typeof t.StickyHeader && t.StickyHeader.initialize(), "undefined" != typeof t.SideNav && t.SideNav.initialize(), "undefined" != typeof t.Search && t.Search.initialize(), "undefined" != typeof t.Panel && t.Panel.initialize(), "undefined" != typeof t.HashScroll && t.HashScroll.initialize(), "undefined" != typeof t.FlickrZoom && t.FlickrZoom.initialize(), "undefined" != typeof t.WayPoints && t.WayPoints.initialize(), "undefined" != typeof t.ScrollToTop && t.ScrollToTop.initialize(), "undefined" != typeof t.FitVideos && t.FitVideos.initialize(), "undefined" != typeof t.RefreshVideoSizes && t.RefreshVideoSizes.initialize(), "undefined" != typeof t.Accordion && t.Accordion.initialize(), "undefined" != typeof t.Toggle && t.Toggle.initialize(), "undefined" != typeof t.Tooltip && t.Tooltip.initialize(), "undefined" != typeof t.Slideshow && (t.Slideshow.initialize(e("body"), ".post-slideshow", t.post_zoom), t.Slideshow.initialize(e("body"), ".portfolio-slideshow", t.portfolio_zoom), t.Slideshow.initialize(e("body"), ".member-slideshow", t.member_zoom), t.Slideshow.initialize(e("body"), ".page-slideshow", t.page_zoom)), "undefined" != typeof t.Carousel && (t.Carousel.initialize(".post-carousel", t.post_zoom), t.Carousel.initialize(".portfolio-carousel", t.portfolio_zoom), t.Carousel.initialize(".member-carousel", t.member_zoom)), "undefined" != typeof t.Grid && (t.Grid.initialize(e(".posts-grid .grid"), ".post"), t.Grid.initialize(e(".portfolios-grid .portfolio-row"), ".portfolio", function() {
                    setTimeout(function() {
                        t.FilterZoom.initialize(e(".portfolios-grid"), t.portfolio_zoom)
                    }, 400)
                }), t.Grid.initialize(e(".page-members .member-row"), ".member", function() {
                    setTimeout(function() {
                        t.FilterZoom.initialize(e(".page-members"), t.member_zoom)
                    }, 400)
                })), "undefined" != typeof t.PostsInfinite && t.PostsInfinite.initialize(), "undefined" != typeof t.PortfoliosInfinite && t.PortfoliosInfinite.initialize(), "undefined" != typeof t.PortfolioLike && t.PortfolioLike.initialize(), "undefined" != typeof t.PortfolioFilter && t.PortfolioFilter.initialize(), "undefined" != typeof t.MembersInfinite && t.MembersInfinite.initialize(), "undefined" != typeof t.MemberFilter && t.MemberFilter.initialize(), "undefined" != typeof t.FaqsInfinite && t.FaqsInfinite.initialize(), "undefined" != typeof t.FaqFilter && t.FaqFilter.initialize(), "undefined" != typeof t.FilterZoom && (t.FilterZoom.initialize(e(".portfolios-grid, .portfolios-timeline"), t.portfolio_zoom), t.FilterZoom.initialize(e(".page-members"), t.member_zoom)), "undefined" != typeof t.VcImageZoom && t.VcImageZoom.initialize(), "undefined" != typeof t.PreviewImage && t.PreviewImage.initialize(), "undefined" != typeof t.SortFilter && t.SortFilter.initialize(), "undefined" != typeof t.WooGridListToggle && t.WooGridListToggle.initialize(), "undefined" != typeof t.WooCategoryFilter && t.WooCategoryFilter.initialize(), "undefined" != typeof t.WooProductsSlider && t.WooProductsSlider.initialize(), "undefined" != typeof t.WooProductsSlider && t.WooProductsSlider.initialize(), "undefined" != typeof t.WooQtyField && t.WooQtyField.initialize(), "undefined" != typeof t.WooQuickView && t.WooQuickView.initialize(), "undefined" != typeof t.WooWidgetToggle && t.WooWidgetToggle.initialize(), "undefined" != typeof t.WooWidgetAccordion && t.WooWidgetAccordion.initialize(), "undefined" != typeof t.WooEvents && t.WooEvents.initialize(), "undefined" != typeof t.WooVariationForm && t.WooVariationForm.initialize(), e('[data-toggle="dropdown"]').dropdownHover(), e("[data-toggle='popover']").popover(), "ontouchstart" in document || e(".mini-cart").on("hide.bs.dropdown", function() {
                    return !1
                }), e.isFunction(e.fn.flipshow)) {
                var i = e(".concept-slideshow");
                i.length && i.each(function() {
                    function t() {
                        i.data().flipshow._navigate(i.find("div.fc-right span:first"), "right"), setTimeout(t, 3e3)
                    }
                    var i = e(this);
                    i.flipshow(), setTimeout(t, 3e3)
                })
            }
            var n = e(".cloud");
            n.length && n.each(function() {
                var t = e(this),
                    i = function() {
                        t.animate({
                            top: "+=20px"
                        }, 3e3, "linear", function() {
                            t.animate({
                                top: "-=20px"
                            }, 3e3, "linear", function() {
                                i()
                            })
                        })
                    };
                i()
            }), e(".tabs-simple .featured-box .box-content").matchHeight(), e(".porto-content-box .featured-box .box-content").matchHeight(), e(".vc_general.vc_cta3").matchHeight(), e(".match-height").matchHeight(), /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) && e(".share-whatsapp").css("display", "inline-block"), e(document).ajaxComplete(function() {
                /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) && e(".share-whatsapp").css("display", "inline-block")
            });
            var o = window.navigator.userAgent,
                a = o.indexOf("Edge/") > 0;
            a && e("html").addClass("ie12")
        }
        navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0 && e("body").addClass("safari"), e(document).ready(function() {
            i(), e(window).bind("vc_reload", function() {
                i(), e(".type-product").addClass("product"), e(".type-post").addClass("post"), e(".type-portfolio").addClass("portfolio"), e(".type-member").addClass("member"), e(".type-block").addClass("block")
            })
        })
    }.apply(this, [window.theme, jQuery]);