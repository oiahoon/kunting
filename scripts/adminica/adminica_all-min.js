function adminicaUi() {
    $(".dropdown_menu > ul > li").each(function() {
        $(this).children("ul").addClass("dropdown").parent().addClass("has_dropdown")
    });
    $("ul.drawer").parent("li").addClass("has_drawer");
    $(".has_drawer > a").bind("click",
    function() {
        var e = $(this).parent().parent().hasClass("open_multiple");
        e != 1 && $(this).parent().siblings().removeClass("open").children("ul.drawer").slideUp();
        $(this).parent().toggleClass("open").children("ul").slideToggle();
        return ! 1
    });
    $("#nav_top > ul > li.current > a > img").each(function() {
        var e = $(this).attr("src").replace("/grey/", "/white/");
        $(this).attr("src", e)
    });
    navCurrent();
    $("#sidebar").mouseenter(function() {
        $(this).stop(true, true).css("z-index") == "999" && $(this).animate({
            left: "-10px"
        },
        200)
    });
    $("#sidebar").mouseleave(function() {
        $(this).stop(true, true).css("z-index") == "999" && $(this).animate({
            left: "-200px"
        },
        300)
    });
    sideNavCurrent();
    $(".stackbar > ul > li > a").on("click",
    function() {
        if ($(this).attr("href") == "#") {
            $(".stackbar > ul li").removeClass("current");
            $(this).parent().addClass("current")
        }
        $(".stackbar > ul li").removeClass("current");
        $(this).parent().addClass("current");
        $(this).parent().find("ul").length > 0 ? $(this).parents(".stackbar").removeClass("list_view").addClass("stack_view") : $(this).parents(".stackbar").addClass("list_view").removeClass("stack_view")
    });
    stackNavCurrent();
    $(".isolate").parent().parent().addClass("isolate");
    $.fn.UItoTop && $().UItoTop({
        easingType: "easeOutQuart"
    });
    $("a.toggle").on("click",
    function() {
        $(this).toggleClass("toggle_closed").parent().next().slideToggle("slow");
        $(this).parent().siblings(".box_head, .tab_header").removeClass("round_top").toggleClass("round_all");
        $(this).parent().parent().toggleClass("closed");
        return ! 1
    });
    $(".toggle_all a").on("click",
    function() {
        $(this).hasClass("close_all") && $(".box .toggle").trigger("click");
        $(this).hasClass("show_all") && $(".box .toggle_closed").trigger("click");
        $(this).parent().not(".closed").toggleClass("closed", 600);
        $(this).parent(".closed").toggleClass("closed")
    });
    $("[data-toggle-class]").on("click",
    function() {
        x = $(this).attr("data-toggle-class");
        $(".box." + x + " .toggle").trigger("click")
    });
    $(".dismiss_button").on("click",
    function() {
        var e = $(this).attr("data-dismiss-target");
        console.log(e);
        $(e).animate({
            opacity: 0
        },
        "slow",
        function() {
            $(this).slideUp()
        })
    });
    if ($.fn.tabs) {
        $(".tabs").tabs({
            fx: {
                opacity: "toggle",
                duration: "fast"
            },
            select: function(e, t) {
                $(this).removeClass("all_open", 200);
                $(this).removeClass("closed", 200);
                $(this).find(".toggle_closed").trigger("click")
            }
        });
        $(".tabs:not('.all_open') .show_all_tabs").on("click",
        function() {
            $(this).parent().siblings(".tab_header").children().removeClass("ui-tabs-selected");
            $(this).parent().parent().addClass("all_open")
        });
        $(".tabs.all_open .show_all_tabs").on("click",
        function() {
            $(this).parent().siblings(".tab_header").find("li:first-child").trigger("click").addClass("ui-tabs-selected");
            $(this).parent().parent().removeClass("all_open")
        });
        $(".side_tabs").tabs({
            fx: {
                opacity: "toggle",
                duration: "fast",
                height: "auto"
            }
        })
    }
    $.fn.accordion && $(".content_accordion").accordion({
        collapsible: !0,
        active: !1,
        header: "h3.bar",
        autoHeight: !1,
        event: "mousedown",
        icons: !1,
        animated: !0
    });
    $.fn.sortable && $(".main_container").sortable({
        handle: ".grabber",
        items: "div.box",
        opacity: .8,
        revert: !0,
        tolerance: "pointer",
        helper: "original",
        forceHelperSize: !0,
        placeholder: "dashed_placeholder",
        forcePlaceholderSize: !0,
        cursorAt: {
            top: 16,
            right: 16
        }
    });
    $(".content_accordion").not(".no_rearrange").sortable({
        handle: "a.handle",
        axis: "y",
        revert: !0,
        tolerance: "pointer",
        forcePlaceholderSize: !0,
        cursorAt: {
            top: 16,
            right: 16
        }
    });
    $("table.static tr:even").addClass("even");
    $("table.static input[type=text]").addClass("text");
    $(".box").each(function() {
        $(this).children().is(".box_head, .tab_header, .tab_sider") || $(this).addClass("no_titlebar")
    });
    $("input[type=button]").addClass("button");
    $("button, .button").each(function() {
        $(this).children().is("span") || $(this).addClass("icon_only");
        $(this).children().is("img, .ui-icon") || $(this).addClass("text_only");
        $(this).children().is("img") && $(this).addClass("img_icon");
        $(this).children().is(".ui-icon") && $(this).addClass("div_icon");
        $(this).children().is("span") && $(this).addClass("has_text")
    });
    $(".indented_button_bar > .columns").each(function() {
        $(this).parent().addClass("has_columns")
    });
    $("button, .button").on("mousedown",
    function() {
        $(this).addClass("button_down")
    }).on("mouseup",
    function() {
        $(this).removeClass("button_down")
    }).on("mouseleave",
    function() {
        $(this).removeClass("button_down")
    });
    if ($.fn.isotope) {
        $(".isotope_holder ul").isotope({
            animationEngine: "best-available",
            animationEngine: "jquery",
            sortBy: "sort_1",
            filter: "*",
            getSortData: {
                sort_1: function(e) {
                    return e.find(".sort_1").text()
                },
                sort_2: function(e) {
                    return e.find(".sort_2").text()
                },
                sort_3: function(e) {
                    return e.find(".sort_3").text()
                },
                sort_4: function(e) {
                    return e.find(".sort_4").text()
                }
            }
        });
        $(".isotope_filter").on("click",
        function() {
            var e = $(this).attr("data-isotope-filter");
            $(".isotope_holder ul").isotope({
                filter: e
            });
            return ! 1
        });
        $(".isotope_sort").on("click",
        function() {
            var e = $(this).attr("data-isotope-sort");
            $(".isotope_holder ul").isotope({
                sortBy: e
            });
            return ! 1
        });
        $(".isotope_filter_complex").on("click",
        function() {
            $(".isotope_filter_complex").removeClass("complex_current");
            $(".isotope_filter_complex:checked").addClass("complex_current");
            var e = "";
            $(".complex_current").each(function() {
                e = e + "" + $(this).attr("data-isotope-filter")
            });
            console.log(e);
            $(".isotope_holder ul").isotope({
                filter: e
            });
            e == "**" && $(".isotope_holder ul").isotope({
                filter: "*"
            })
        })
    }
    columnHeight();
    centerContent();
    refreshIsotope();
    $(window).resize(function() {
        columnHeight();
        centerContent()
    })
}
function adminicaInit() {
    $("#nav_top, .indent, .flat_area").animate({
        opacity: 1
    });
    $("#login_box > div > span").hide().delay(400).fadeIn();
    $(".box").animate({
        opacity: 1
    },
    function() {
        $(".block").animate({
            opacity: 1
        })
    });
    hideLoadingOverlay()
}
function refreshIsotope() {
    $(".isotope_holder ul").isotope("reLayout")
}
function hideLoadingOverlay() {
    $("#loading_overlay .loading_message").delay(200).fadeOut(function() {});
    $("#loading_overlay").delay(300).fadeOut()
}
function showLoadingOverlay() {
    $("#loading_overlay .loading_message").show();
    $("#loading_overlay").show()
}
function columnHeight() {
    $(".even fieldset.label_side, .even > div, .even fieldset").css("height", "auto");
    $(".label_side > div, .columns").addClass("clearfix");
    $(".columns.even").each(function() {
        x = 0;
        $(this).find("fieldset").children().each(function() {
            y = $(this).outerHeight();
            y > x && (x = y)
        });
        $(this).find("fieldset.label_side").children().css("height", x - 30);
        $(this).children(".col_50,.col_33,.col_66,.col_25,.col_75,.col_60,.col_40,.col_20").each(function() {
            y = $(this).outerHeight();
            y > x && (x = y)
        });
        $(this).children().css("height", x);
        $(this).find("fieldset").not(".label_side").each(function() {
            y = $(this).outerHeight();
            y > x && (x = y)
        });
        $(this).find("fieldset").css("height", x - 1)
    });
    z = 0;
    $(this).find("fieldset").children().each(function() {
        y = $(this).outerHeight();
        y > z && (z = y)
    });
    $(this).find("fieldset.label_side").children().css("height", z - 31)
}
function centerContent() {
    $(".isolate").each(function() {
        var e = $(window).height() - 60;
        $(this).css("height", e)
    })
}
function navCurrent() {
    var e = $("#wrapper").data("adminica-nav-top"),
    t = $("#wrapper").data("adminica-nav-inner");
    $("#nav_top > ul > li").eq(e - 1).addClass("current").find("li").eq(t - 1).addClass("current");
    $("#nav_top > ul > li.current > a > img").each(function() {
        var e = $(this).attr("src").replace("/grey/", "/white/");
        $(this).attr("src", e)
    })
}
function sideNavCurrent() {
    var e = $("#wrapper").data("adminica-side-top"),
    t = $("#wrapper").data("adminica-side-inner");
    $("ul#nav_side > li").eq(e - 1).addClass("current").addClass("open").children("ul").slideDown().find("li").eq(t - 1).addClass("current");
    $("ul#nav_side > li").addClass("icon_only").children("a").children("span:visible").parent().parent().removeClass("icon_only")
}
function stackNavCurrent(e, t) {
    var e = $("#wrapper").data("adminica-stack-top"),
    t = $("#wrapper").data("adminica-stack-inner");
    t == null ? $("#stackbar").addClass("list_view") : $("#stackbar").addClass("stack_view");
    $("#stackbar > ul > li").eq(e - 1).addClass("current").find("li").eq(t - 1).addClass("current")
}
function adminicaForms() {
    $("fieldset > div > input[type=text]").addClass("text");
    $("fieldset > div > input[type=email]").addClass("text");
    $("fieldset > div > input[type=number]").addClass("text");
    $("fieldset > div > input[type=password]").addClass("text");
    $("fieldset > div > textarea").addClass("textarea");
    $("fieldset > div > input[type=checkbox]").addClass("checkbox");
    $("fieldset > div > input[type=radio]").addClass("radio");
    $("fieldset > div > input[type=checkbox].indeterminate").prop("indeterminate", !0);
    $.fn.validate && $(".validate_form").validate();
    $(".alert.dismissible").on("click",
    function() {
        $(this).animate({
            opacity: 0
        },
        "slow",
        function() {
            $(this).slideUp()
        })
    });
    $.fn.autoGrow && $("textarea.autogrow").autoGrow();
    $.fn.datepicker && $(".datepicker").datepicker({
        dateFormat: "d M yy",
        showOn: "focus"
    });
    if ($.fn.slider) {
        function e(e, t) {
            var n = $(this).children().children().size();
            $(this).children("ol.slider_labels").children("li").css({
                "margin-right": 100 / (n - 1) + "%"
            })
        }
        $(".slider").slider({
            min: "0",
            max: "100",
            range: "min",
            slide: function(e, t) {
                $("#slider_value").text(t.value)
            },
            create: e
        })
    }
    if ($.fn.slider) {
        $(".slider_range").slider({
            range: !0,
            min: 0,
            max: 500,
            values: [75, 300],
            slide: function(e, t) {
                $("#amount").val("$" + t.values[0] + " - $" + t.values[1])
            }
        });
        $("#amount").val("$" + $("#slider_range").slider("values", 0) + " - $" + $("#slider_range").slider("values", 1));
        $(".slider_vertical > span").each(function() {
            var e = parseInt($(this).text());
            $(this).empty().slider({
                value: e,
                range: "min",
                animate: !0,
                orientation: "vertical"
            })
        });
        function t() {
            var e = $(this).attr("title");
            $(this).append('<div class="unlock_message">' + e + "</div>")
        }
        function n() {
            var e = $(this).slider("value"),
            t = e / 100 * -30;
            $(this).find(".ui-slider-handle").css("margin-left", t + "px")
        }
        function r(e, t) {
            if ($(this).slider("value") > 95) {
                $(this).siblings("button, input").trigger("click");
                $(this).find(".ui-slider-handle").delay(500).animate({
                    left: "0%",
                    "margin-left": 0
                },
                350);
                $(this).find(".ui-slider-range").delay(500).animate({
                    width: 0
                },
                function() {
                    $(this).slider("value", 0)
                })
            } else {
                $(this).find(".ui-slider-handle").animate({
                    left: "0%",
                    "margin-left": 0
                });
                $(this).find(".ui-slider-range").animate({
                    width: 0
                },
                function() {
                    $(this).slider("value", 0)
                })
            }
        }
        $(".slider_unlock").slider({
            value: "0",
            range: "min",
            animate: !0,
            stop: r,
            slide: n,
            change: n,
            create: t
        })
    }
    $.fn.progressbar && $(".progressbar").progressbar({
        value: 75
    });
    if ($.fn.buttonset) {
        $(".jqui_checkbox").buttonset();
        $(".jqui_radios").buttonset();
        $(".jqui_radios > label").on("click",
        function() {
            $(this).siblings().removeClass("ui-state-active")
        })
    }
    $.fn.uniform && setTimeout('$(".uniform input, .uniform, .uniform a, .time_picker_holder select").uniform();', 10);
    $.fn.knob && $(".knob").knob();
    $.fn.multiselect && $(".multisorter").multiselect();
    $.fn.timepicker && $(".time_picker").timepicker();
    if ($.fn.ColorPicker) {
        $("#colorpicker_inline").ColorPicker({
            flat: !0
        });
        $("#colorpicker_popup").ColorPicker({
            onSubmit: function(e, t, n, r) {
                $(r).val(t);
                $(r).ColorPickerHide()
            },
            onBeforeShow: function() {
                $(this).ColorPickerSetColor(this.value)
            }
        }).on("keyup",
        function() {
            $(this).ColorPickerSetColor(this.value)
        })
    }
    $.fn.stars && $("#star_rating").stars({
        inputType: "select"
    });
    $.fn.tipTip && $(".tooltip").tipTip({
        defaultPosition: "top",
        maxWidth: "auto",
        edgeOffset: 0
    });
    var i = ["ActionScript", "AppleScript", "Asp", "BASIC", "C", "C++", "Clojure", "COBOL", "ColdFusion", "Erlang", "Fortran", "Groovy", "Haskell", "Java", "JavaScript", "Lisp", "Perl", "PHP", "Python", "Ruby", "Scala", "Scheme"];
    $(".autocomplete").autocomplete({
        source: i
    });
    $.fn.tagit && setTimeout("$('.tagit').tagit();", 3e3);
    if ($.fn.dialog) {
        $(".dialog_content").dialog({
            autoOpen: !1,
            resizable: !1,
            show: "fade",
            hide: "fade",
            modal: !0,
            width: "500",
            show: {
                effect: "fade",
                duration: 500
            },
            hide: {
                effect: "fade",
                duration: 500
            },
            create: function() {
                $(".dialog_content.no_dialog_titlebar").dialog("option", "dialogClass", "no_dialog_titlebar")
            },
            open: function() {
                setTimeout(columnHeight, 100)
            }
        });
        $(".dialog_button").live("click",
        function() {
            var e = $(this).attr("data-dialog");
            $("#" + e).dialog("open");
            return ! 1
        });
        $(".close_dialog").live("click",
        function() {
            $(".dialog_content").dialog("close");
            return ! 1
        });
        $(".link_button").live("click",
        function() {
            var e = $(this).attr("data-link");
            window.location.href = e;
            return ! 1
        });
        $(".dialog_content.very_narrow").dialog("option", "width", 300);
        $(".dialog_content.narrow").dialog("option", "width", 450);
        $(".dialog_content.wide").dialog("option", "width", 650);
        $(".dialog_content.medium_height").dialog("option", "height", 315);
        $(".dialog_content.no_modal").dialog("option", "modal", !1);
        $(".dialog_content.no_modal").dialog("option", "draggable", !1);
        $(".ui-widget-overlay").live("click",
        function() {
            $(".dialog_content").dialog("close");
            return ! 1
        })
    }
    if ($.fn.slider) {
        function s(e, t) {
            if ($(this).slider("value") > 95) {
                $("#dialog_content_1").dialog("close");
                $(this).find(".ui-slider-handle").animate({
                    left: 0
                },
                350);
                $(this).find(".ui-slider-range").animate({
                    width: 0
                })
            } else {
                $(this).find(".ui-slider-handle").animate({
                    left: 0
                },
                350);
                $(this).find(".ui-slider-range").animate({
                    width: 0
                })
            }
        }
        $("#slider_close_dialog").slider({
            value: "0",
            range: "min",
            animate: !0,
            stop: s
        })
    }
    $.fn.select2 && $(".select2").select2({
        allowClear: !0,
        minimumResultsForSearch: 10
    })
}
function adminicaMobile() {
    var e = $('<select class="full_width">').appendTo("#mobile_nav .main"),
    t = $('<select class="full_width">').appendTo("#mobile_nav .side");
    $("#nav_top li").each(function() {
        var t = $(this),
        n = t.find("> a"),
        r = n.children('span:not(".alert")').text(),
        i = t.parents("li"),
        s = (new Array(i.length + 1)).join("-");
        if (!$(this).children("a").hasClass("hide_mobile")) if ($(this).children("a").attr("href") == "#") var o = $("<optgroup>").attr("label", s + " " + r).appendTo(e);
        else {
            var o = $("<option>").text(s + " " + n.children('span:not(".alert")').text()).val(n.attr("href")).appendTo(e);
            t.hasClass("current") && o.attr("selected", "selected")
        }
    });
    $("#sidebar .side_accordion li").each(function() {
        var e = $(this),
        n = e.find("> a"),
        r = e.parents("li"),
        i = (new Array(r.length + 1)).join("-"),
        s = $("<option>").text(i + " " + n.text()).val(n.attr("href")).appendTo(t);
        e.hasClass("current") && s.attr("selected", "selected")
    });
    $("#mobile_nav div select").change(function() {
        theLink = $(this).val();
        console.log(theLink);
        $("a[href='" + theLink + "'] ").css("outline", "1px solid red").trigger("click")
    })
}
function adminicaDataTables() {
    if ($(".datatable").length > 0 && $.fn.dataTable) {
        var e = $("#dt1 .datatable").dataTable({
            bJQueryUI: !0,
            sScrollX: "",
            bSortClasses: !1,
            aaSorting: [[0, "asc"]],
            bAutoWidth: !0,
            bInfo: !0,
            sScrollX: "101%",
            bScrollCollapse: !0,
            sPaginationType: "full_numbers",
            bRetrieve: !0,
            fnInitComplete: function() {
                $("#dt1 .dataTables_length > label > select").uniform();
                $("#dt1 .dataTables_filter input[type=text]").addClass("text");
                $(".datatable").css("visibility", "visible")
            }
        }),
        t = $("#dt2 .datatable").dataTable({
            bJQueryUI: !0,
            sScrollX: "",
            bSortClasses: !1,
            aaSorting: [[0, "asc"]],
            bAutoWidth: !0,
            bInfo: !0,
            sScrollY: "100%",
            sScrollX: "100%",
            bScrollCollapse: !0,
            sPaginationType: "full_numbers",
            bRetrieve: !0,
            fnInitComplete: function() {
                $("#dt2 .dataTables_length > label > select").uniform();
                $("#dt2 .dataTables_filter input[type=text]").addClass("text");
                $(".datatable").css("visibility", "visible")
            },
            aLengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
        }),
        n = $("#dt3 .datatable").dataTable({
            bJQueryUI: !0,
            bPaginate: !1,
            sScrollX: "",
            bSortClasses: !1,
            aaSorting: [[0, "asc"]],
            bAutoWidth: !0,
            bInfo: !0,
            sScrollY: "100%",
            sScrollX: "100%",
            bScrollCollapse: !0,
            sPaginationType: "full_numbers",
            bRetrieve: !0,
            fnInitComplete: function() {
                $("#dt3 .dataTables_length > label > select").uniform();
                $("#dt3 .dataTables_filter input[type=text]").addClass("text");
                $(".datatable").css("visibility", "visible")
            }
        });
        $(".tabs").tabs({
            show: function(e, t) {
                var n = $("div.dataTables_scrollBody > table", t.panel).dataTable();
                if (n.length > 0) {
                    n.fnAdjustColumnSizing();
                    $(".tabs div.dataTables_scroll").css({
                        display: "none",
                        visibility: "visible"
                    }).show()
                }
            }
        });
        $(".content_accordion").accordion({
            change: function(e, t) {
                var n = $("div.dataTables_scrollBody > table", t.panel).dataTable();
                if (n.length > 0) {
                    n.fnAdjustColumnSizing();
                    $(".content_accordion div.dataTables_scroll").css({
                        display: "none",
                        visibility: "visible"
                    }).show()
                }
            }
        });
        $(window).resize(function() {
            e.fnAdjustColumnSizing();
            t.fnAdjustColumnSizing();
            n.fnAdjustColumnSizing()
        })
    }
}
function adminicaCalendar() {
    if ($.fn.fullCalendar) {
        $("#calendar").fullCalendar({
            firstDay: "1",
            weekMode: "liquid",
            aspectRatio: "1.5",
            theme: !0,
            selectable: !0,
            editable: !0,
            draggable: !0,
            droppable: !0,
            timeFormat: "H:mm",
            axisFormat: "H:mm",
            columnFormat: {
                month: "ddd",
                week: "ddd dS",
                day: "dddd dS MMMM"
            },
            titleFormat: {
                month: "MMMM yyyy",
                week: "MMM d[ yyyy]{ 'to'[ MMM] d, yyyy}",
                day: "ddd, MMMM d, yyyy"
            },
            allDayText: "All Day",
            header: {
                left: "prev title next, today",
                center: "",
                right: "agendaWeek,agendaDay,month"
            },
            eventSources: [{
                events: [{
                    title: "Company AGM",
                    start: "2012-02-03",
                    className: "calendar_green"
                },
                {
                    title: "Business Trip",
                    start: "2012-02-15",
                    end: "2012-02-20",
                    className: "calendar_blue"
                },
                {
                    title: "Day off",
                    start: "2012-02-08 12:30:00",
                    className: "calendar_red"
                },
                {
                    title: "Company AGM",
                    start: "2012-03-03",
                    className: "calendar_green"
                },
                {
                    title: "Business Trip",
                    start: "2012-03-15",
                    end: "2012-03-20",
                    className: "calendar_blue"
                },
                {
                    title: "Day off",
                    start: "2012-03-08 12:30:00",
                    className: "calendar_red"
                },
                {
                    title: "Company AGM",
                    start: "2012-04-03",
                    className: "calendar_green"
                },
                {
                    title: "Business Trip",
                    start: "2012-04-15",
                    end: "2012-04-20",
                    className: "calendar_blue"
                },
                {
                    title: "Day off",
                    start: "2012-04-08 12:30:00",
                    className: "calendar_red"
                },
                {
                    title: "Company AGM",
                    start: "2012-05-03",
                    className: "calendar_green"
                },
                {
                    title: "Business Trip",
                    start: "2012-05-15",
                    end: "2012-05-20",
                    className: "calendar_blue"
                },
                {
                    title: "Day off",
                    start: "2012-05-08 12:30:00",
                    className: "calendar_red"
                }]
            },
            {
                url: "https://www.google.com/calendar/feeds/nueoipsjhgm857gpojq5563cfo@group.calendar.google.com/public/basic",
                className: "calendar_magenta"
            },
            {
                url: "http://www.google.com/calendar/feeds/usa__en%40holiday.calendar.google.com/public/basic",
                className: "calendar_navy"
            }],
            drop: function(e, t) {
                var n = $(this).data("eventObject"),
                r = $.extend({},
                n);
                r.start = e;
                r.allDay = t;
                $("#calendar").fullCalendar("renderEvent", r, !0);
                $("#drop-remove").is(":checked") && $(this).remove()
            }
        });
        $("ul#calendar_drag_list li a").each(function() {
            var e = {
                title: $.trim($(this).text()),
                className: $(this).attr("data-colour")
            };
            $(this).data("eventObject", e);
            $(this).draggable({
                zIndex: 999,
                revert: !0,
                revertDuration: 10,
                cursorAt: {
                    top: 15,
                    left: 0
                }
            })
        })
    }
}
function adminicaCharts() {
    if ($(".flot").length > 0) {
        var e = [];
        for (var t = 0; t < 14; t += .2) e.push([t, Math.sin(t) + 8]);
        var n = [[0, 5], [2, 7], [4, 11], [6, 1], [8, 8], [10, 7], [12, 9], [14, 3]],
        r = [[1, 3], [3, 8], [5, 5], [7, 13], [9, 8], [11, 5], [13, 8], [15, 5]],
        i = [[0, 12], [7, 12], [8, 2.5], [12, 2.5], [15, 7]],
        s = [];
        for (var t = -20; t < 20; t += .4) s.push([t, Math.tan(t) + t * 5]);
        var o = [[1988, 483994], [1989, 479060], [1991, 401949], [1993, 402375], [1994, 377867], [1996, 337946], [1997, 336185], [1998, 328611], [2e3, 342172], [2001, 344932], [2003, 440813], [2004, 480451], [2006, 528692]],
        u = [],
        a = Math.floor(Math.random() * 5) + 1;
        for (var t = 0; t < a; t++) u[t] = {
            label: "Series" + (t + 1),
            data: Math.floor(Math.random() * 100) + 1
        };
        var f = [{
            label: "Slice 1",
            data: [[1, 117]],
            color: "#122b45"
        },
        {
            label: "Slice 2",
            data: [[1, 30]],
            color: "#064792"
        },
        {
            label: "Slice 3",
            data: [[1, 44]],
            color: "#4C5766"
        },
        {
            label: "Slice 4",
            data: [[1, 90]],
            color: "#9e253b"
        },
        {
            label: "Slice 5",
            data: [[1, 70]],
            color: "#8d579a"
        },
        {
            label: "Slice 6",
            data: [[1, 80]],
            color: "#2b4356"
        }],
        l = [{
            label: "Slice 1",
            data: [[1, 117]],
            color: "#122b45"
        },
        {
            label: "Slice 2",
            data: [[1, 30]],
            color: "#064792"
        },
        {
            label: "Slice 3",
            data: [[1, 44]],
            color: "#4C5766"
        },
        {
            label: "Slice 4",
            data: [[1, 90]],
            color: "#9e253b"
        },
        {
            label: "Slice 5",
            data: [[1, 70]],
            color: "#8d579a"
        },
        {
            label: "Slice 6",
            data: [[1, 80]],
            color: "#2b4356"
        }],
        c = {
            colors: ["#4C5766 ", "#313841 "]
        },
        h = {
            colors: ["#1C5EA0 ", "#064792 "]
        },
        p = {
            colors: ["#2b4356 ", "#122b45 "]
        },
        d = {
            colors: ["#9e253b ", "#7C1F30 "]
        },
        v = {
            colors: ["#3d8336 ", "#277423 "]
        },
        m = {
            colors: ["#9b6ca6 ", "#8d579a "]
        },
        g = {
            colors: ["#53453e ", "#3b2e28 "]
        },
        y = {
            colors: ["#D0D6DA", "#B4BBC1"]
        },
        b = "#4C5766 ",
        w = "#1C5EA0 ",
        E = "#2b4356 ",
        S = "#9e253b ",
        x = "#3d8336",
        T = "#9b6ca6",
        N = "#53453e";
        $.plot($("#flot_pie_1"), f, {
            series: {
                pie: {
                    innerRadius: 0,
                    show: !0
                },
                grid: {
                    hoverable: !0,
                    clickable: !0
                }
            }
        });
        $.plot($("#flot_bar"), [{
            shadowSize: 25,
            label: "Bar Chart 1",
            color: T,
            data: n,
            bars: {
                show: !0,
                fill: !0,
                fillColor: m,
                lineWidth: 0,
                border: !1
            }
        },
        {
            shadowSize: 25,
            label: "Bar Chart 2",
            color: "#4C5766",
            data: r,
            bars: {
                show: !0,
                fill: !0,
                fillColor: c,
                lineWidth: 0,
                border: !1
            }
        }], {
            grid: {
                show: !0,
                aboveData: !1,
                backgroundColor: {
                    colors: ["#fff", "#eee"]
                },
                labelMargin: 15,
                borderWidth: 1,
                borderColor: "#cccccc",
                clickable: !0,
                hoverable: !0,
                autoHighlight: !0,
                mouseActiveRadius: 10
            },
            legend: {
                show: !0,
                labelBoxBorderColor: "#fff",
                noColumns: 5,
                margin: 10,
                backgroundColor: "#fff"
            }
        });
        $.plot($("#flot_line"), [{
            shadowSize: 5,
            label: "Line Chart 1",
            color: w,
            data: e,
            lines: {
                show: !0,
                fill: !0,
                fillColor: y,
                lineWidth: 4
            }
        },
        {
            shadowSize: 5,
            label: "Line Chart 2",
            color: S,
            data: n,
            lines: {
                show: !0,
                fill: !1,
                lineWidth: 4
            },
            points: {
                show: !0,
                fill: !1,
                lineWidth: 2
            }
        }], {
            grid: {
                show: !0,
                aboveData: !1,
                backgroundColor: {
                    colors: ["#fff", "#eee"]
                },
                labelMargin: 15,
                borderWidth: 1,
                borderColor: "#cccccc",
                clickable: !0,
                hoverable: !0,
                autoHighlight: !0,
                mouseActiveRadius: 10
            },
            legend: {
                show: !0,
                labelBoxBorderColor: "#fff",
                noColumns: 5,
                margin: 10,
                backgroundColor: "#fff"
            }
        });
        $.plot($("#flot_points"), [{
            shadowSize: 10,
            label: "Points Chart",
            color: w,
            data: o,
            points: {
                show: !0,
                fill: !0,
                fillColor: "#ffffff",
                lineWidth: 3
            },
            lines: {
                show: !0,
                fill: !0,
                fillColor: c,
                lineWidth: 5
            }
        }], {
            grid: {
                show: !0,
                aboveData: !1,
                backgroundColor: {
                    colors: ["#fff", "#eee"]
                },
                labelMargin: 15,
                borderWidth: 1,
                borderColor: "#cccccc",
                clickable: !0,
                hoverable: !0,
                autoHighlight: !0,
                mouseActiveRadius: 10
            },
            legend: {
                show: !0,
                labelBoxBorderColor: "#fff",
                noColumns: 5,
                margin: 10,
                backgroundColor: "#fff"
            }
        })
    }
    if ($.fn.sparkline) {
        $(".random_number_3").each(function() {
            var e = Math.floor(Math.random() * 7),
            t = Math.floor(Math.random() * 6),
            n = Math.floor(Math.random() * 5);
            $(this).text(e + "," + t + "," + n)
        });
        $(".random_number_5").each(function() {
            var e = Math.floor(Math.random() * 7),
            t = Math.floor(Math.random() * 6),
            n = Math.floor(Math.random() * 5),
            r = Math.floor(Math.random() * -1),
            i = Math.floor(Math.random() * 5);
            $(this).text(e + "," + t + "," + n + "," + r + "," + i)
        });
        $(".spark_pie.small").sparkline("html", {
            type: "pie",
            sliceColors: ["#354254", "#419DF9", "#13578A"]
        });
        $(".spark_line.small").sparkline("html", {
            type: "line",
            lineWidth: "1",
            lineColor: "#419DF9",
            fillColor: "#ccc",
            spotRadius: "2",
            spotColor: "#13578A",
            minSpotColor: "",
            maxSpotColor: ""
        });
        $(".spark_bar.small").sparkline("html", {
            type: "bar",
            barColor: "#13578A"
        });
        $(".spark_pie.medium").sparkline("html", {
            type: "pie",
            height: "50px",
            width: "50px",
            sliceColors: ["#354254", "#419DF9", "#13578A"]
        });
        $(".spark_line.medium").sparkline("html", {
            type: "line",
            height: "50px",
            width: "50px",
            lineWidth: "1",
            lineColor: "#419DF9",
            fillColor: "#ccc",
            spotRadius: "2",
            spotColor: "#13578A",
            minSpotColor: "",
            maxSpotColor: ""
        });
        $(".spark_bar.medium").sparkline("html", {
            type: "bar",
            height: "50px",
            barColor: "#419DF9",
            barWidth: 10,
            negBarColor: "#DA3737",
            colorMap: {
                1 : "red",
                2 : "red",
                3 : "orange",
                4 : "green",
                5 : "green"
            }
        });
        $(".spark_pie.large").sparkline("html", {
            type: "pie",
            height: "75px",
            width: "75px",
            sliceColors: ["#354254", "#419DF9", "#13578A"]
        });
        $(".spark_line.large").sparkline("html", {
            type: "line",
            height: "60px",
            width: "80%",
            lineWidth: "2",
            lineColor: "#419DF9",
            fillColor: "#ccc",
            spotRadius: "3",
            spotColor: "#13578A",
            minSpotColor: "",
            maxSpotColor: ""
        });
        $(".spark_bar.large").sparkline("html", {
            type: "bar",
            height: "60px",
            barColor: "#419DF9",
            barWidth: 15,
            negBarColor: "#DA3737",
            colorMap: {
                1 : "red",
                2 : "red",
                3 : "orange",
                4 : "green",
                5 : "green"
            }
        });
        $(".spark_line_wide").sparkline("html", {
            type: "line",
            height: "20px",
            width: "100%",
            lineWidth: "2",
            lineColor: "#419DF9",
            fillColor: "",
            spotRadius: "2	",
            spotColor: "#3FC846",
            minSpotColor: "#DA3737",
            maxSpotColor: "#3FC846"
        })
    }
}
function adminicaGallery() {
    $(".delete_buttons li").addClass("delete_able").append('<div class="delete ui-icon ui-icon-trash dialog_button" data-dialog="dialog_delete"></div>');
    $(".delete").live("click",
    function() {
        $(".delete_able").removeClass("delete_cue");
        $(this).parents(".delete_able").addClass("delete_cue")
    });
    $(".delete_confirm").live("click",
    function() {
        $(".delete_cue").fadeOut("fast",
        function() {
            $(this).remove();
            $(".isotope_holder ul").isotope("remove", $(this));
            refreshIsotope()
        })
    });
    if ($.fn.fancybox) {
        $(".gallery.fancybox li a").fancybox({
            overlayColor: "#000"
        });
        $("a img.fancy").fancybox();
        $("a.fancybox_media").fancybox({
            openEffect: "none",
            closeEffect: "none",
            helpers: {
                media: {}
            }
        })
    }
}
function adminicaVarious() {
    if ($.fn.sliderNav) {
        $("#slider_list").sliderNav({
            height: "402"
        });
        $("#slider_list ul ul li a").live("click",
        function() {
            var e = $(this).find("span").text(),
            t = $(this).html().replace("<span>" + e + "</span>", ""),
            n = Math.floor(Math.random() * 11);
            $("#contactName").text(t);
            $("#contactEmail").text(e);
            $("#contactImage").attr("src", "images/content/profiles/mangatar-" + n + ".png")
        })
    }
    if ($(".tinyeditor").length > 0) {
        new TINY.editor.edit("editor", {
            id: "tiny_input",
            height: 200,
            cssclass: "te",
            controlclass: "tecontrol",
            rowclass: "teheader",
            dividerclass: "tedivider",
            controls: ["bold", "italic", "underline", "strikethrough", "|", "subscript", "superscript", "|", "orderedlist", "unorderedlist", "|", "outdent", "indent", "|", "leftalign", "centeralign", "rightalign", "blockjustify", "|", "unformat", "|", "undo", "redo", "n", "image", "hr", "link", "unlink", "|", "cut", "copy", "paste", "print", "|", "font", "size", "style"],
            footer: !1,
            fonts: ["Arial", "Verdana", "Georgia", "Trebuchet MS"],
            xhtml: !0,
            bodyid: "editor",
            footerclass: "tefooter",
            toggle: {
                text: "source",
                activetext: "wysiwyg",
                cssclass: "toggler"
            },
            resize: {
                cssclass: "resize"
            }
        });
        new TINY.editor.edit("editor2", {
            id: "tiny_input2",
            height: 200,
            cssclass: "te",
            controlclass: "tecontrol",
            rowclass: "teheader",
            dividerclass: "tedivider",
            controls: ["bold", "italic", "underline", "strikethrough", "|", "subscript", "superscript", "|", "orderedlist", "unorderedlist", "|", "outdent", "indent", "|", "leftalign", "centeralign", "rightalign", "blockjustify", "|", "unformat", "|", "undo", "redo", "n", "image", "hr", "link", "unlink", "|", "cut", "copy", "paste", "print", "|", "font", "size", "style"],
            footer: !1,
            fonts: ["Arial", "Verdana", "Georgia", "Trebuchet MS"],
            xhtml: !0,
            bodyid: "editor",
            footerclass: "tefooter",
            toggle: {
                text: "source",
                activetext: "wysiwyg",
                cssclass: "toggler"
            },
            resize: {
                cssclass: "resize"
            }
        });
        $(".teheader select").uniform()
    }
    if ($.fn.elfinder) {
        var e = $("#finder").elfinder({
            url: "scripts/elfinder/connectors/php/connector.php",
            places: "",
            toolbar: [["back", "reload"], ["mkdir", "copy", "paste"], ["remove", "rename", "info"], ["icons", "list"]]
        });
        $("#close,#open,#dock,#undock").click(function() {
            $("#finder").elfinder($(this).attr("id"))
        })
    }
    $("#toggle_lines").click(function() {
        $(".main_container").toggleClass("no_lines")
    });
    $("#dialog_welcome").dialog({
        open: function() {
            $("#pagesSelect .main").length < 1 && $("#mobile_nav .main").clone("copy").appendTo("#pagesSelect");
            $("#pagesSelect select").change(function() {
                theLink = $(this).val();
                window.location = theLink
            });
            $.fn.select2 && $(".select2").addClass("full_width").select2()
        }
    })
}
function adminicaWizard() {
    $(".wizard_progressbar").progressbar({
        value: 10
    });
    $('.wizard_steps ul li:not(".current") a').live("click",
    function() {
        var e = $(this).attr("href").replace("#step_", ""),
        t = $(".step:visible").attr("id").replace("step_", "");
        console.log("step clicked: " + e);
        console.log("step current: " + t);
        t > e ? $("label.error").css("display", "none") : $(".validate_form").valid();
        var n = $(".step").find("label.error").filter(":visible").length;
        console.log(n);
        if (n < 1) {
            $(".wizard_steps ul li").removeClass("current");
            $(this).parent("li").addClass("current");
            var r = $(this).attr("href"),
            e = $(this).attr("href").replace("#step_", ""),
            i = 100 / $(".wizard_steps > ul > li").size(),
            s = e * i;
            $(".wizard_progressbar").progressbar({
                value: s
            });
            $(".wizard_content").find(".step").hide();
            $(".wizard_content").find(r).fadeIn(1e3)
        }
        return ! 1
    });
    var e = 100 / $(".wizard_steps > ul > li").size();
    $(".wizard_progressbar").progressbar({
        value: e
    });
    $('.wizard .button_bar button:not(".submit_button")').live("click",
    function() {
        var e = $(this).attr("data-goto").replace("step_", "");
        $(".wizard_steps ul li:nth-child(" + e + ") a").trigger("click");
        columnHeight()
    });
    $(".wizard_content form .submit_button").live("click",
    function() {
        $(".validate_form").valid();
        var e = $(this).parents("form").find(".error").html();
        e ? $(this).parents("form").submit() : console.log("error")
    });
    $(".validate_form").validate()
}
function pjaxToggle() {
    if ($.cookie("pjax_on") === "true") {
        $("#pjax_switch #dynamic_on").trigger("click");
        $("a.pjax").addClass("pjax_on")
    }
}
$(document).ready(function() {
    adminicaUi();
    adminicaForms();
    adminicaMobile();
    adminicaDataTables();
    adminicaCalendar();
    adminicaCharts();
    adminicaGallery();
    adminicaWizard();
    adminicaVarious();
    $("a.pjax.pjax_on").pjax("body", {
        fragment: "#pjax",
        timeout: "5000",
        beforeSend: function() {
            showLoadingOverlay()
        },
        complete: function() {
            hideLoadingOverlay()
        },
        success: function() {
            adminicaUi();
            adminicaForms();
            adminicaMobile();
            adminicaDataTables();
            adminicaCalendar();
            adminicaCharts();
            adminicaGallery();
            adminicaWizard();
            adminicaVarious();
            pjaxToggle()
        },
        error: function() {}
    });
    pjaxToggle();
    $("#pjax_switch #dynamic_on").on("change",
    function() {
        $("a.pjax").addClass("pjax_on");
        $.cookie("pjax_on", !0)
    });
    $("#pjax_switch #dynamic_off").on("change",
    function() {
        $("a.pjax").removeClass("pjax_on");
        $.cookie("pjax_on", !1)
    });
});
$(window).load(function() {
    adminicaInit()
});