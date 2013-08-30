var Layout = function ()
    {

        var timer, docWidth;

        return {
            init: init,
            adapt: adapt
        };

        function init()
        {
            var searchBevel, contentHeaderBevel;

            $('html').removeClass('no-js');

            adapt();

            docWidth = $(window).width();

            $(window).resize(function ()
            {
                //console.log ('cache: ' + docWidth);
                //console.log ('live: ' + $(window).width ());
                //console.log ('------------------------');
                if (docWidth === $(window).width())
                {
                    //console.log ('Same'); 
                    return false;
                }

                clearTimeout(timer);
                timer = setTimeout(adapt, 125);
            });

            searchBevel = $('<div>', {
                id: 'searchBevel'
            }).appendTo('#search');
            contentHeaderBevel = $('<div>', {
                id: 'contentHeaderBevel'
            }).appendTo('#contentHeader');

            $('#advancedSearchTrigger').live('click', advancedClick);

            $('#quickNav').find('li').last().addClass('last');
        }

        function advancedClick(e)
        {
            e.preventDefault();
            var search = $(this).parents('#search');
            search.find('#advancedSearchOptions').slideToggle();
        }

        function adapt()
        {
            var windowWidth, windowHeight, contentWidth, contentHeight, sidebarWidth, gutterWidth, bottomPad, $sidebar, $content;

            $sidebar = $('#sidebar');
            $content = $('#content');

            windowWidth = $(window).width();
            windowHeight = $(window).height();

            docWidth = windowWidth;

            sidebarWidth = $sidebar.outerWidth();
            gutterWidth = 20;
            bottomPad = 125;

            contentWidth = windowWidth - sidebarWidth - gutterWidth;
            contentHeight = windowHeight + bottomPad;

            //$content.css ({ 'min-width': contentWidth });
            //$content.css ({ 'height': $content.outerHeight + 97 });
            $(document).trigger('layout.resize');

        }
    }();

var Nav = function ()
    {

        return {
            init: init,
            open: open
        };

        function init()
        {
            $('li.nav').each(function ()
            {
                var li, a, dropdown;
                li = $(this);
                a = li.find('a').eq(0);
                dropdown = li.find('.subNav');

                if (dropdown.length > 0)
                {
                    a.append('<span class="dropdownArrow"></span>');
                    li.addClass('dropdown');
                    a.bind('click', navClick);
                }
            });

            var active = $('li.nav.active');

            if (active.is('.dropdown'))
            {
                var id = active.attr('id');

                active.addClass('opened');
                active.find('.subNav').show();
            }
        }

        function open(id)
        {
            var el = $('#' + id),
                sub = el.find('.subNav');

            el.addClass('opened');
            sub.slideToggle();
        }

        function navClick(e)
        {
            e.preventDefault();

            var li = $(this).parents('li');

            if (li.is('.opened'))
            {
                closeAll();
            }
            else
            {
                closeAll();
                li.addClass('opened').find('.subNav').slideDown();
            }

            //closeAll ();
            //$(this).parents ('li.nav').addClass ('opened').find ('.subNav').slideToggle ();
        }

        function closeAll()
        {
            var subnav = $('.subNav');

            subnav.slideUp().parents('li').removeClass('opened');
        }
    }();

var Menu = function ()
    {

        var settings = {
            outsideClose: false
        };

        return {
            init: init,
            close: close
        };

        function init(config)
        {

            options = $.extend(settings, config);

            var $menuContainer = $('.menu-container')
            $menu = $('.menu')
            $topNav = $('#topNav');

            $topNav.find('.menu').each(function ()
            {
                var $this = $(this);

                if ($this.parent().find('.menu-dropdown').length > 0)
                {
                    $this.append('<div class="menu-arrow"></div>');
                }
            });

            $menu.live('click', open);

            $menuContainer.each(function ()
            {
                var parent = $(this).parents('#quickNav'),
                    cls = (parent.length > 0) ? $(this).addClass('menu-type-quicknav') : $(this).addClass('menu-type-topnav');

                $(this).addClass(cls).append('<div class="menu-top"></div>').insertBefore('#footer');
            });

            $menuContainer.find('form').live('submit', function (e)
            {
                e.preventDefault();
            });
        }

        function open(e)
        {
            e.preventDefault();

            var $this, id, $modal, docWidth, offset, left, top;

            $this = $(this);
            id = $this.attr('href');
            $modal = $(id);
            docWidth = $(document).width();

            $modal.removeClass('middle right');

            if ($modal.is(':visible'))
            {
                doClose();
            }

            forceClose();

            offset = $this.offset();
            left = offset.left - 8;
            top = offset.top + $this.outerHeight() + 4;


            var showRight = docWidth < offset.left + $modal.outerWidth();





            if (docWidth < 550)
            {
                $modal.css(
                {
                    left: '50%',
                    top: top,
                    'margin-left': '-' + $modal.outerWidth() / 2 + 'px'
                }).addClass('middle');

                $('body').append('<div id="overlay"></div>');
            }
            else if (showRight)
            {

                left = offset.left - $modal.outerWidth() + 45;

                if (left < 0)
                {
                    $modal.css(
                    {
                        left: '50%',
                        top: top,
                        'margin-left': '-' + $modal.outerWidth() / 2 + 'px'
                    }).addClass('middle');

                    $('body').append('<div id="overlay"></div>');
                }
                else
                {
                    $modal.css(
                    {
                        left: left,
                        top: top,
                        'margin-left': 0
                    }).addClass('right');
                }

            }
            else
            {
                $modal.css(
                {
                    left: left,
                    top: top,
                    'margin-left': 0
                });
            }





            $modal.show();
            $this.parent().find('.alert').fadeOut();
            $('#overlay').bind('click', docClick);
            $modal.find('.menu-close').bind('click', close);
            $(document).bind('click.menu', docClick);
        }

        function docClick(e)
        {
            if ($(e.target).parents('.menu-container').length < 1)
            {
                if (!$(e.target).is('.menu') && $(e.target).parents('.menu').length < 1)
                {
                    doClose();
                }
            }
        }

        function close(e)
        {
            e.preventDefault();
            doClose();
        }

        function doClose()
        {
            var modal, form;

            $(document).unbind('click.menu');

            modal = $('.menu-container:visible');
            modal.fadeOut('medium', function ()
            {});

            form = modal.find('form');

            if (form.length > 0)
            {
                form[0].reset();
            }

            $('#overlay').fadeOut('medium', function ()
            {
                $(this).remove();
            });
        }

        function forceClose()
        {
            $('.menu-container').hide();
            $(document).unbind('click.menu');
        }
    }();




(function ($)
{

    $.modal = function (config)
    {

        var defaults, options, container, header, close, content, title, overlay;

        defaults = {
            title: '',
            html: '',
            ajax: '',
            width: null,
            overlay: true,
            overlayClose: false,
            escClose: true
        };

        options = $.extend(defaults, config);

        container = $('<div>', {
            id: 'modal'
        });
        header = $('<div>', {
            id: 'modalHeader'
        });
        content = $('<div>', {
            id: 'modalContent'
        });
        overlay = $('<div>', {
            id: 'overlay'
        });
        title = $('<h2>', {
            text: options.title
        });
        close = $('<a>', {
            'class': 'close',
            href: 'javascript:;',
            html: '&times'
        });

        container.appendTo('body');
        header.appendTo(container);
        content.appendTo(container);
        if (options.overlay)
        {
            overlay.appendTo('body');
        }
        title.prependTo(header);
        close.appendTo(header);

        if (options.ajax == '' && options.html == '')
        {
            title.text('No Content');
        }

        if (options.ajax !== '')
        {
            content.html('<div id="modalLoader"><img src="./img/ajax-loader.gif" /></div>');
            $.modal.reposition();
            $.get(options.ajax, function (response)
            {
                content.html(response);
                $.modal.reposition();
            });
        }

        if (options.html !== '')
        {
            content.html(options.html);
        }

        close.bind('click', function (e)
        {
            e.preventDefault();
            $.modal.close();
        });

        if (options.overlayClose)
        {
            overlay.bind('click', function (e)
            {
                $.modal.close();
            });
        }

        if (options.escClose)
        {
            $(document).bind('keyup.modal', function (e)
            {
                var key = e.which || e.keyCode;

                if (key == 27)
                {
                    $.modal.close();
                }
            });
        }

        $.modal.reposition();
    }

    $.modal.reposition = function ()
    {
        var width = $('#modal').outerWidth();
        var centerOffset = width / 2;
        $('#modal').css(
        {
            'left': '50%',
            'top': $(window).scrollTop() + 75,
            'margin-left': '-' + centerOffset + 'px'
        });
    };

    $.modal.close = function ()
    {
        $('#modal').remove();
        $('#overlay').remove();
        $(document).unbind('keyup.modal');
    }

    function getPageScroll()
    {
        var xScroll, yScroll;

        if (self.pageYOffset)
        {
            yScroll = self.pageYOffset;
            xScroll = self.pageXOffset;
        }
        else if (document.documentElement && document.documentElement.scrollTop)
        { // Explorer 6 Strict
            yScroll = document.documentElement.scrollTop;
            xScroll = document.documentElement.scrollLeft;
        }
        else if (document.body)
        { // all other Explorers
            yScroll = document.body.scrollTop;
            xScroll = document.body.scrollLeft;
        }

        return new Array(xScroll, yScroll);
    }

})(jQuery);

(function ($)
{

    $.alert = function (config)
    {

        var defaults, options, container, content, actions, close, submit, cancel, title, overlay;

        defaults = {
            type: 'default',
            title: '',
            text: '',
            confirmText: 'Confirm',
            cancelText: 'Cancel',
            callback: function ()
            {},
            overlayClose: false,
            escClose: true
        };

        options = $.extend(defaults, config);

        container = $('<div>', {
            id: 'alert'
        });
        content = $('<div>', {
            id: 'alertContent'
        });
        close = $('<a>', {
            'class': 'close',
            href: 'javascript:;',
            html: '&times'
        });
        actions = $('<div>', {
            id: 'alertActions'
        });
        overlay = $('<div>', {
            id: 'overlay'
        });
        title = $('<h2>', {
            text: options.title
        });

        submit = $('<button>', {
            'class': 'btn btn-small btn-primary',
            text: options.confirmText
        });
        cancel = $('<button>', {
            'class': 'btn btn-small btn-quaternary',
            text: options.cancelText
        });

        container.appendTo('body');
        content.appendTo(container);
        close.appendTo(container);
        overlay.appendTo('body');
        title.prependTo(content);

        content.append(options.text);

        actions.appendTo(content);

        if (options.type === 'confirm')
        {
            submit.appendTo(actions);
            cancel.appendTo(actions);
        }
        else
        {
            submit.appendTo(actions);
            submit.text('Ok');
        }

        submit.bind('click', function (e)
        {
            e.preventDefault();

            if (typeof options.callback === 'function')
            {
                options.callback.apply();
            }

            $.alert.close();
        });

        submit.focus();

        cancel.bind('click', function (e)
        {
            e.preventDefault();
            $.alert.close();
        });

        close.bind('click', function (e)
        {
            e.preventDefault();
            $.alert.close();
        });

        if (options.overlayClose)
        {
            overlay.bind('click', function (e)
            {
                $.alert.close();
            });
        }

        if (options.escClose)
        {
            $(document).bind('keyup.alert', function (e)
            {
                var key = e.which || e.keyCode;

                if (key == 27)
                {
                    $.alert.close();
                }
            });
        }


    }

    $.alert.close = function ()
    {
        $('#alert').remove();
        $('#overlay').remove();
        $(document).unbind('keyup.alert');
    }

})(jQuery);

$(function ()
{

    $('.widget-tabs').find('.tabs a').live('click', tabClick);

    $('.widget-tabs').each(function ()
    {
        var content = $(this).find('.widget-content');

        if (content.length > 1)
        {
            content.hide().eq(0).show();
        }
    });



});

function tabClick(e)
{
    e.preventDefault();

    var $this = $(this);
    var id = $this.attr('href');
    var parent = $this.parents('.widget');

    $this.parent().addClass('active').siblings('li').removeClass('active');

    parent.find('.widget-content').hide();
    $(id).show();

}

/*
 ### jQuery Google Maps Plugin v1.01 ###
 * Home: http://www.mayzes.org/googlemaps.jquery.html
 * Code: http://www.mayzes.org/js/jquery.googlemaps1.01.js
 * Date: 2010-01-14 (Thursday, 14 Jan 2010)
 * 
 * Dual licensed under the MIT and GPL licenses.
 *   http://www.gnu.org/licenses/gpl.html
 *   http://www.opensource.org/licenses/mit-license.php
 ###
*/
jQuery.fn.googleMaps = function (options)
{

    if (!window.GBrowserIsCompatible || !GBrowserIsCompatible())
    {
        return this;
    }


    // Fill default values where not set by instantiation code
    var opts = $.extend(
    {}, $.googleMaps.defaults, options);

    //$.fn.googleMaps.includeGoogle(opts.key, opts.sensor);
    return this.each(function ()
    {
        // Create Map
        $.googleMaps.gMap = new GMap2(this, opts);
        $.googleMaps.mapsConfiguration(opts);
    });
};

$.googleMaps = {
    mapsConfiguration: function (opts)
    {
        // GEOCODE
        if (opts.geocode)
        {
            geocoder = new GClientGeocoder();
            geocoder.getLatLng(opts.geocode, function (center)
            {
                if (!center)
                {
                    alert(address + " not found");
                }
                else
                {
                    $.googleMaps.gMap.setCenter(center, opts.depth);
                    $.googleMaps.latitude = center.x;
                    $.googleMaps.longitude = center.y;
                }
            });
        }
        else
        {
            // Latitude & Longitude Center Point
            var center = $.googleMaps.mapLatLong(opts.latitude, opts.longitude);
            // Set the center of the Map with the new Center Point and Depth
            $.googleMaps.gMap.setCenter(center, opts.depth);
        }

        // POLYLINE
        if (opts.polyline)
        // Draw a PolyLine on the Map
        $.googleMaps.gMap.addOverlay($.googleMaps.mapPolyLine(opts.polyline));
        // GEODESIC 
        if (opts.geodesic)
        {
            $.googleMaps.mapGeoDesic(opts.geodesic);
        }
        // PAN
        if (opts.pan)
        {
            // Set Default Options
            opts.pan = $.googleMaps.mapPanOptions(opts.pan);
            // Pan the Map
            window.setTimeout(function ()
            {
                $.googleMaps.gMap.panTo($.googleMaps.mapLatLong(opts.pan.panLatitude, opts.pan.panLongitude));
            }, opts.pan.timeout);
        }

        // LAYER
        if (opts.layer)
        // Set the Custom Layer
        $.googleMaps.gMap.addOverlay(new GLayer(opts.layer));

        // MARKERS
        if (opts.markers) $.googleMaps.mapMarkers(center, opts.markers);

        // CONTROLS
        if (opts.controls.type || opts.controls.zoom || opts.controls.mapType)
        {
            $.googleMaps.mapControls(opts.controls);
        }
        else
        {
            if (!opts.controls.hide) $.googleMaps.gMap.setUIToDefault();
        }

        // SCROLL
        if (opts.scroll) $.googleMaps.gMap.enableScrollWheelZoom();
        else if (!opts.scroll) $.googleMaps.gMap.disableScrollWheelZoom();

        // LOCAL SEARCH
        if (opts.controls.localSearch) $.googleMaps.gMap.enableGoogleBar();
        else $.googleMaps.gMap.disableGoogleBar();

        // FEED (RSS/KML)
        if (opts.feed) $.googleMaps.gMap.addOverlay(new GGeoXml(opts.feed));

        // TRAFFIC INFO
        if (opts.trafficInfo)
        {
            var trafficOptions = {
                incidents: true
            };
            trafficInfo = new GTrafficOverlay(trafficOptions);
            $.googleMaps.gMap.addOverlay(trafficInfo);
        }

        // DIRECTIONS
        if (opts.directions)
        {
            $.googleMaps.directions = new GDirections($.googleMaps.gMap, opts.directions.panel);
            $.googleMaps.directions.load(opts.directions.route);
        }

        if (opts.streetViewOverlay)
        {
            svOverlay = new GStreetviewOverlay();
            $.googleMaps.gMap.addOverlay(svOverlay);
        }
    },
    mapGeoDesic: function (options)
    {
        // Default GeoDesic Options
        geoDesicDefaults = {
            startLatitude: 37.4419,
            startLongitude: -122.1419,
            endLatitude: 37.4519,
            endLongitude: -122.1519,
            color: '#ff0000',
            pixels: 2,
            opacity: 10
        }
        // Merge the User & Default Options
        options = $.extend(
        {}, geoDesicDefaults, options);
        var polyOptions = {
            geodesic: true
        };
        var polyline = new GPolyline([
        new GLatLng(options.startLatitude, options.startLongitude), new GLatLng(options.endLatitude, options.endLongitude)], options.color, options.pixels, options.opacity, polyOptions);
        $.googleMaps.gMap.addOverlay(polyline);
    },
    localSearchControl: function (options)
    {
        var controlLocation = $.googleMaps.mapControlsLocation(options.location);
        $.googleMaps.gMap.addControl(new $.googleMaps.gMap.LocalSearch(), new GControlPosition(controlLocation, new GSize(options.x, options.y)));
    },
    getLatitude: function ()
    {
        return $.googleMaps.latitude;
    },
    getLongitude: function ()
    {
        return $.googleMaps.longitude;
    },
    directions: {},
    latitude: '',
    longitude: '',
    latlong: {},
    maps: {},
    marker: {},
    gMap: {},
    defaults: {
        // Default Map Options
        latitude: 37.4419,
        longitude: -122.1419,
        depth: 13,
        scroll: true,
        trafficInfo: false,
        streetViewOverlay: false,
        controls: {
            hide: false,
            localSearch: false
        },
        layer: null
    },
    mapPolyLine: function (options)
    {
        // Default PolyLine Options
        polylineDefaults = {
            startLatitude: 37.4419,
            startLongitude: -122.1419,
            endLatitude: 37.4519,
            endLongitude: -122.1519,
            color: '#ff0000',
            pixels: 2
        }
        // Merge the User & Default Options
        options = $.extend(
        {}, polylineDefaults, options);
        //Return the New Polyline
        return new GPolyline([
        $.googleMaps.mapLatLong(options.startLatitude, options.startLongitude), $.googleMaps.mapLatLong(options.endLatitude, options.endLongitude)], options.color, options.pixels);
    },
    mapLatLong: function (latitude, longitude)
    {
        // Returns Latitude & Longitude Center Point
        return new GLatLng(latitude, longitude);
    },
    mapPanOptions: function (options)
    {
        // Returns Panning Options
        var panDefaults = {
            panLatitude: 37.4569,
            panLongitude: -122.1569,
            timeout: 0
        }
        return options = $.extend(
        {}, panDefaults, options);
    },
    mapMarkersOptions: function (icon)
    {
        //Define an icon
        var gIcon = new GIcon(G_DEFAULT_ICON);
        if (icon.image)
        // Define Icons Image
        gIcon.image = icon.image;
        if (icon.shadow)
        // Define Icons Shadow
        gIcon.shadow = icon.shadow;
        if (icon.iconSize)
        // Define Icons Size
        gIcon.iconSize = new GSize(icon.iconSize);
        if (icon.shadowSize)
        // Define Icons Shadow Size
        gIcon.shadowSize = new GSize(icon.shadowSize);
        if (icon.iconAnchor)
        // Define Icons Anchor
        gIcon.iconAnchor = new GPoint(icon.iconAnchor);
        if (icon.infoWindowAnchor)
        // Define Icons Info Window Anchor
        gIcon.infoWindowAnchor = new GPoint(icon.infoWindowAnchor);
        if (icon.dragCrossImage)
        // Define Drag Cross Icon Image
        gIcon.dragCrossImage = icon.dragCrossImage;
        if (icon.dragCrossSize)
        // Define Drag Cross Icon Size
        gIcon.dragCrossSize = new GSize(icon.dragCrossSize);
        if (icon.dragCrossAnchor)
        // Define Drag Cross Icon Anchor
        gIcon.dragCrossAnchor = new GPoint(icon.dragCrossAnchor);
        if (icon.maxHeight)
        // Define Icons Max Height
        gIcon.maxHeight = icon.maxHeight;
        if (icon.PrintImage)
        // Define Print Image
        gIcon.PrintImage = icon.PrintImage;
        if (icon.mozPrintImage)
        // Define Moz Print Image
        gIcon.mozPrintImage = icon.mozPrintImage;
        if (icon.PrintShadow)
        // Define Print Shadow
        gIcon.PrintShadow = icon.PrintShadow;
        if (icon.transparent)
        // Define Transparent
        gIcon.transparent = icon.transparent;
        return gIcon;
    },
    mapMarkers: function (center, markers)
    {
        if (typeof (markers.length) == 'undefined')
        // One marker only. Parse it into an array for consistency.
        markers = [markers];

        var j = 0;
        for (i = 0; i < markers.length; i++)
        {
            var gIcon = null;
            if (markers[i].icon)
            {
                gIcon = $.googleMaps.mapMarkersOptions(markers[i].icon);
            }

            if (markers[i].geocode)
            {
                var geocoder = new GClientGeocoder();
                geocoder.getLatLng(markers[i].geocode, function (center)
                {
                    if (!center) alert(address + " not found");
                    else $.googleMaps.marker[i] = new GMarker(center, {
                        draggable: markers[i].draggable,
                        icon: gIcon
                    });
                });
            }
            else if (markers[i].latitude && markers[i].longitude)
            {
                // Latitude & Longitude Center Point
                center = $.googleMaps.mapLatLong(markers[i].latitude, markers[i].longitude);
                $.googleMaps.marker[i] = new GMarker(center, {
                    draggable: markers[i].draggable,
                    icon: gIcon
                });
            }
            $.googleMaps.gMap.addOverlay($.googleMaps.marker[i]);
            if (markers[i].info)
            {
                // Hide Div Layer With Info Window HTML
                $(markers[i].info.layer).hide();
                // Marker Div Layer Exists
                if (markers[i].info.popup)
                // Map Marker Shows an Info Box on Load
                $.googleMaps.marker[i].openInfoWindowHtml($(markers[i].info.layer).html());
                else $.googleMaps.marker[i].bindInfoWindowHtml($(markers[i].info.layer).html().toString());
            }
        }
    },
    mapControlsLocation: function (location)
    {
        switch (location)
        {
        case 'G_ANCHOR_TOP_RIGHT':
            return G_ANCHOR_TOP_RIGHT;
            break;
        case 'G_ANCHOR_BOTTOM_RIGHT':
            return G_ANCHOR_BOTTOM_RIGHT;
            break;
        case 'G_ANCHOR_TOP_LEFT':
            return G_ANCHOR_TOP_LEFT;
            break;
        case 'G_ANCHOR_BOTTOM_LEFT':
            return G_ANCHOR_BOTTOM_LEFT;
            break;
        }
        return;
    },
    mapControl: function (control)
    {
        switch (control)
        {
        case 'GLargeMapControl3D':
            return new GLargeMapControl3D();
            break;
        case 'GLargeMapControl':
            return new GLargeMapControl();
            break;
        case 'GSmallMapControl':
            return new GSmallMapControl();
            break;
        case 'GSmallZoomControl3D':
            return new GSmallZoomControl3D();
            break;
        case 'GSmallZoomControl':
            return new GSmallZoomControl();
            break;
        case 'GScaleControl':
            return new GScaleControl();
            break;
        case 'GMapTypeControl':
            return new GMapTypeControl();
            break;
        case 'GHierarchicalMapTypeControl':
            return new GHierarchicalMapTypeControl();
            break;
        case 'GOverviewMapControl':
            return new GOverviewMapControl();
            break;
        case 'GNavLabelControl':
            return new GNavLabelControl();
            break;
        }
        return;
    },
    mapTypeControl: function (type)
    {
        switch (type)
        {
        case 'G_NORMAL_MAP':
            return G_NORMAL_MAP;
            break;
        case 'G_SATELLITE_MAP':
            return G_SATELLITE_MAP;
            break;
        case 'G_HYBRID_MAP':
            return G_HYBRID_MAP;
            break;
        }
        return;
    },
    mapControls: function (options)
    {
        // Default Controls Options
        controlsDefaults = {
            type: {
                location: 'G_ANCHOR_TOP_RIGHT',
                x: 10,
                y: 10,
                control: 'GMapTypeControl'
            },
            zoom: {
                location: 'G_ANCHOR_TOP_LEFT',
                x: 10,
                y: 10,
                control: 'GLargeMapControl3D'
            }
        };
        // Merge the User & Default Options
        options = $.extend(
        {}, controlsDefaults, options);
        options.type = $.extend(
        {}, controlsDefaults.type, options.type);
        options.zoom = $.extend(
        {}, controlsDefaults.zoom, options.zoom);

        if (options.type)
        {
            var controlLocation = $.googleMaps.mapControlsLocation(options.type.location);
            var controlPosition = new GControlPosition(controlLocation, new GSize(options.type.x, options.type.y));
            $.googleMaps.gMap.addControl($.googleMaps.mapControl(options.type.control), controlPosition);
        }
        if (options.zoom)
        {
            var controlLocation = $.googleMaps.mapControlsLocation(options.zoom.location);
            var controlPosition = new GControlPosition(controlLocation, new GSize(options.zoom.x, options.zoom.y))
            $.googleMaps.gMap.addControl($.googleMaps.mapControl(options.zoom.control), controlPosition);
        }
        if (options.mapType)
        {
            if (options.mapType.length >= 1)
            {
                for (i = 0; i < options.mapType.length; i++)
                {
                    if (options.mapType[i].remove) $.googleMaps.gMap.removeMapType($.googleMaps.mapTypeControl(options.mapType[i].remove));
                    if (options.mapType[i].add) $.googleMaps.gMap.addMapType($.googleMaps.mapTypeControl(options.mapType[i].add));
                }
            }
            else
            {
                if (options.mapType.add) $.googleMaps.gMap.addMapType($.googleMaps.mapTypeControl(options.mapType.add));
                if (options.mapType.remove) $.googleMaps.gMap.removeMapType($.googleMaps.mapTypeControl(options.mapType.remove));
            }
        }
    },
    geoCode: function (options)
    {
        geocoder = new GClientGeocoder();

        geocoder.getLatLng(options.address, function (point)
        {
            if (!point) alert(address + " not found");
            else $.googleMaps.gMap.setCenter(point, options.depth);
        });
    }
};

/**
 *
 * Color picker
 * Author: Stefan Petre www.eyecon.ro
 * 
 * Dual licensed under the MIT and GPL licenses
 * 
 */ (function ($)
{
    var ColorPicker = function ()
        {
            var
            ids = {},
                inAction, charMin = 65,
                visible, tpl = '<div class="colorpicker"><div class="colorpicker_color"><div><div></div></div></div><div class="colorpicker_hue"><div></div></div><div class="colorpicker_new_color"></div><div class="colorpicker_current_color"></div><div class="colorpicker_hex"><input type="text" maxlength="6" size="6" /></div><div class="colorpicker_rgb_r colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_submit"></div></div>',
                defaults = {
                    eventName: 'click',
                    onShow: function ()
                    {},
                    onBeforeShow: function ()
                    {},
                    onHide: function ()
                    {},
                    onChange: function ()
                    {},
                    onSubmit: function ()
                    {},
                    color: 'ff0000',
                    livePreview: true,
                    flat: false
                },
                fillRGBFields = function (hsb, cal)
                {
                    var rgb = HSBToRGB(hsb);
                    $(cal).data('colorpicker').fields.eq(1).val(rgb.r).end().eq(2).val(rgb.g).end().eq(3).val(rgb.b).end();
                },
                fillHSBFields = function (hsb, cal)
                {
                    $(cal).data('colorpicker').fields.eq(4).val(hsb.h).end().eq(5).val(hsb.s).end().eq(6).val(hsb.b).end();
                },
                fillHexFields = function (hsb, cal)
                {
                    $(cal).data('colorpicker').fields.eq(0).val(HSBToHex(hsb)).end();
                },
                setSelector = function (hsb, cal)
                {
                    $(cal).data('colorpicker').selector.css('backgroundColor', '#' + HSBToHex(
                    {
                        h: hsb.h,
                        s: 100,
                        b: 100
                    }));
                    $(cal).data('colorpicker').selectorIndic.css(
                    {
                        left: parseInt(150 * hsb.s / 100, 10),
                        top: parseInt(150 * (100 - hsb.b) / 100, 10)
                    });
                },
                setHue = function (hsb, cal)
                {
                    $(cal).data('colorpicker').hue.css('top', parseInt(150 - 150 * hsb.h / 360, 10));
                },
                setCurrentColor = function (hsb, cal)
                {
                    $(cal).data('colorpicker').currentColor.css('backgroundColor', '#' + HSBToHex(hsb));
                },
                setNewColor = function (hsb, cal)
                {
                    $(cal).data('colorpicker').newColor.css('backgroundColor', '#' + HSBToHex(hsb));
                },
                keyDown = function (ev)
                {
                    var pressedKey = ev.charCode || ev.keyCode || -1;
                    if ((pressedKey > charMin && pressedKey <= 90) || pressedKey == 32)
                    {
                        return false;
                    }
                    var cal = $(this).parent().parent();
                    if (cal.data('colorpicker').livePreview === true)
                    {
                        change.apply(this);
                    }
                },
                change = function (ev)
                {
                    var cal = $(this).parent().parent(),
                        col;
                    if (this.parentNode.className.indexOf('_hex') > 0)
                    {
                        cal.data('colorpicker').color = col = HexToHSB(fixHex(this.value));
                    }
                    else if (this.parentNode.className.indexOf('_hsb') > 0)
                    {
                        cal.data('colorpicker').color = col = fixHSB(
                        {
                            h: parseInt(cal.data('colorpicker').fields.eq(4).val(), 10),
                            s: parseInt(cal.data('colorpicker').fields.eq(5).val(), 10),
                            b: parseInt(cal.data('colorpicker').fields.eq(6).val(), 10)
                        });
                    }
                    else
                    {
                        cal.data('colorpicker').color = col = RGBToHSB(fixRGB(
                        {
                            r: parseInt(cal.data('colorpicker').fields.eq(1).val(), 10),
                            g: parseInt(cal.data('colorpicker').fields.eq(2).val(), 10),
                            b: parseInt(cal.data('colorpicker').fields.eq(3).val(), 10)
                        }));
                    }
                    if (ev)
                    {
                        fillRGBFields(col, cal.get(0));
                        fillHexFields(col, cal.get(0));
                        fillHSBFields(col, cal.get(0));
                    }
                    setSelector(col, cal.get(0));
                    setHue(col, cal.get(0));
                    setNewColor(col, cal.get(0));
                    cal.data('colorpicker').onChange.apply(cal, [col, HSBToHex(col), HSBToRGB(col)]);
                },
                blur = function (ev)
                {
                    var cal = $(this).parent().parent();
                    cal.data('colorpicker').fields.parent().removeClass('colorpicker_focus');
                },
                focus = function ()
                {
                    charMin = this.parentNode.className.indexOf('_hex') > 0 ? 70 : 65;
                    $(this).parent().parent().data('colorpicker').fields.parent().removeClass('colorpicker_focus');
                    $(this).parent().addClass('colorpicker_focus');
                },
                downIncrement = function (ev)
                {
                    var field = $(this).parent().find('input').focus();
                    var current = {
                        el: $(this).parent().addClass('colorpicker_slider'),
                        max: this.parentNode.className.indexOf('_hsb_h') > 0 ? 360 : (this.parentNode.className.indexOf('_hsb') > 0 ? 100 : 255),
                        y: ev.pageY,
                        field: field,
                        val: parseInt(field.val(), 10),
                        preview: $(this).parent().parent().data('colorpicker').livePreview
                    };
                    $(document).bind('mouseup', current, upIncrement);
                    $(document).bind('mousemove', current, moveIncrement);
                },
                moveIncrement = function (ev)
                {
                    ev.data.field.val(Math.max(0, Math.min(ev.data.max, parseInt(ev.data.val + ev.pageY - ev.data.y, 10))));
                    if (ev.data.preview)
                    {
                        change.apply(ev.data.field.get(0), [true]);
                    }
                    return false;
                },
                upIncrement = function (ev)
                {
                    change.apply(ev.data.field.get(0), [true]);
                    ev.data.el.removeClass('colorpicker_slider').find('input').focus();
                    $(document).unbind('mouseup', upIncrement);
                    $(document).unbind('mousemove', moveIncrement);
                    return false;
                },
                downHue = function (ev)
                {
                    var current = {
                        cal: $(this).parent(),
                        y: $(this).offset().top
                    };
                    current.preview = current.cal.data('colorpicker').livePreview;
                    $(document).bind('mouseup', current, upHue);
                    $(document).bind('mousemove', current, moveHue);
                },
                moveHue = function (ev)
                {
                    change.apply(
                    ev.data.cal.data('colorpicker').fields.eq(4).val(parseInt(360 * (150 - Math.max(0, Math.min(150, (ev.pageY - ev.data.y)))) / 150, 10)).get(0), [ev.data.preview]);
                    return false;
                },
                upHue = function (ev)
                {
                    fillRGBFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
                    fillHexFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
                    $(document).unbind('mouseup', upHue);
                    $(document).unbind('mousemove', moveHue);
                    return false;
                },
                downSelector = function (ev)
                {
                    var current = {
                        cal: $(this).parent(),
                        pos: $(this).offset()
                    };
                    current.preview = current.cal.data('colorpicker').livePreview;
                    $(document).bind('mouseup', current, upSelector);
                    $(document).bind('mousemove', current, moveSelector);
                },
                moveSelector = function (ev)
                {
                    change.apply(
                    ev.data.cal.data('colorpicker').fields.eq(6).val(parseInt(100 * (150 - Math.max(0, Math.min(150, (ev.pageY - ev.data.pos.top)))) / 150, 10)).end().eq(5).val(parseInt(100 * (Math.max(0, Math.min(150, (ev.pageX - ev.data.pos.left)))) / 150, 10)).get(0), [ev.data.preview]);
                    return false;
                },
                upSelector = function (ev)
                {
                    fillRGBFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
                    fillHexFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
                    $(document).unbind('mouseup', upSelector);
                    $(document).unbind('mousemove', moveSelector);
                    return false;
                },
                enterSubmit = function (ev)
                {
                    $(this).addClass('colorpicker_focus');
                },
                leaveSubmit = function (ev)
                {
                    $(this).removeClass('colorpicker_focus');
                },
                clickSubmit = function (ev)
                {
                    var cal = $(this).parent();
                    var col = cal.data('colorpicker').color;
                    cal.data('colorpicker').origColor = col;
                    setCurrentColor(col, cal.get(0));
                    cal.data('colorpicker').onSubmit(col, HSBToHex(col), HSBToRGB(col), cal.data('colorpicker').el);
                },
                show = function (ev)
                {
                    var cal = $('#' + $(this).data('colorpickerId'));
                    cal.data('colorpicker').onBeforeShow.apply(this, [cal.get(0)]);
                    var pos = $(this).offset();
                    var viewPort = getViewport();
                    var top = pos.top + this.offsetHeight;
                    var left = pos.left;
                    if (top + 176 > viewPort.t + viewPort.h)
                    {
                        top -= this.offsetHeight + 176;
                    }
                    if (left + 356 > viewPort.l + viewPort.w)
                    {
                        left -= 356;
                    }
                    cal.css(
                    {
                        left: left + 'px',
                        top: top + 'px'
                    });
                    if (cal.data('colorpicker').onShow.apply(this, [cal.get(0)]) != false)
                    {
                        cal.show();
                    }
                    $(document).bind('mousedown', {
                        cal: cal
                    }, hide);
                    return false;
                },
                hide = function (ev)
                {
                    if (!isChildOf(ev.data.cal.get(0), ev.target, ev.data.cal.get(0)))
                    {
                        if (ev.data.cal.data('colorpicker').onHide.apply(this, [ev.data.cal.get(0)]) != false)
                        {
                            ev.data.cal.hide();
                        }
                        $(document).unbind('mousedown', hide);
                    }
                },
                isChildOf = function (parentEl, el, container)
                {
                    if (parentEl == el)
                    {
                        return true;
                    }
                    if (parentEl.contains)
                    {
                        return parentEl.contains(el);
                    }
                    if (parentEl.compareDocumentPosition)
                    {
                        return !!(parentEl.compareDocumentPosition(el) & 16);
                    }
                    var prEl = el.parentNode;
                    while (prEl && prEl != container)
                    {
                        if (prEl == parentEl) return true;
                        prEl = prEl.parentNode;
                    }
                    return false;
                },
                getViewport = function ()
                {
                    var m = document.compatMode == 'CSS1Compat';
                    return {
                        l: window.pageXOffset || (m ? document.documentElement.scrollLeft : document.body.scrollLeft),
                        t: window.pageYOffset || (m ? document.documentElement.scrollTop : document.body.scrollTop),
                        w: window.innerWidth || (m ? document.documentElement.clientWidth : document.body.clientWidth),
                        h: window.innerHeight || (m ? document.documentElement.clientHeight : document.body.clientHeight)
                    };
                },
                fixHSB = function (hsb)
                {
                    return {
                        h: Math.min(360, Math.max(0, hsb.h)),
                        s: Math.min(100, Math.max(0, hsb.s)),
                        b: Math.min(100, Math.max(0, hsb.b))
                    };
                },
                fixRGB = function (rgb)
                {
                    return {
                        r: Math.min(255, Math.max(0, rgb.r)),
                        g: Math.min(255, Math.max(0, rgb.g)),
                        b: Math.min(255, Math.max(0, rgb.b))
                    };
                },
                fixHex = function (hex)
                {
                    var len = 6 - hex.length;
                    if (len > 0)
                    {
                        var o = [];
                        for (var i = 0; i < len; i++)
                        {
                            o.push('0');
                        }
                        o.push(hex);
                        hex = o.join('');
                    }
                    return hex;
                },
                HexToRGB = function (hex)
                {
                    var hex = parseInt(((hex.indexOf('#') > -1) ? hex.substring(1) : hex), 16);
                    return {
                        r: hex >> 16,
                        g: (hex & 0x00FF00) >> 8,
                        b: (hex & 0x0000FF)
                    };
                },
                HexToHSB = function (hex)
                {
                    return RGBToHSB(HexToRGB(hex));
                },
                RGBToHSB = function (rgb)
                {
                    var hsb = {
                        h: 0,
                        s: 0,
                        b: 0
                    };
                    var min = Math.min(rgb.r, rgb.g, rgb.b);
                    var max = Math.max(rgb.r, rgb.g, rgb.b);
                    var delta = max - min;
                    hsb.b = max;
                    if (max != 0)
                    {

                        }
                    hsb.s = max != 0 ? 255 * delta / max : 0;
                    if (hsb.s != 0)
                    {
                        if (rgb.r == max)
                        {
                            hsb.h = (rgb.g - rgb.b) / delta;
                        }
                        else if (rgb.g == max)
                        {
                            hsb.h = 2 + (rgb.b - rgb.r) / delta;
                        }
                        else
                        {
                            hsb.h = 4 + (rgb.r - rgb.g) / delta;
                        }
                    }
                    else
                    {
                        hsb.h = -1;
                    }
                    hsb.h *= 60;
                    if (hsb.h < 0)
                    {
                        hsb.h += 360;
                    }
                    hsb.s *= 100 / 255;
                    hsb.b *= 100 / 255;
                    return hsb;
                },
                HSBToRGB = function (hsb)
                {
                    var rgb = {};
                    var h = Math.round(hsb.h);
                    var s = Math.round(hsb.s * 255 / 100);
                    var v = Math.round(hsb.b * 255 / 100);
                    if (s == 0)
                    {
                        rgb.r = rgb.g = rgb.b = v;
                    }
                    else
                    {
                        var t1 = v;
                        var t2 = (255 - s) * v / 255;
                        var t3 = (t1 - t2) * (h % 60) / 60;
                        if (h == 360) h = 0;
                        if (h < 60)
                        {
                            rgb.r = t1;
                            rgb.b = t2;
                            rgb.g = t2 + t3
                        }
                        else if (h < 120)
                        {
                            rgb.g = t1;
                            rgb.b = t2;
                            rgb.r = t1 - t3
                        }
                        else if (h < 180)
                        {
                            rgb.g = t1;
                            rgb.r = t2;
                            rgb.b = t2 + t3
                        }
                        else if (h < 240)
                        {
                            rgb.b = t1;
                            rgb.r = t2;
                            rgb.g = t1 - t3
                        }
                        else if (h < 300)
                        {
                            rgb.b = t1;
                            rgb.g = t2;
                            rgb.r = t2 + t3
                        }
                        else if (h < 360)
                        {
                            rgb.r = t1;
                            rgb.g = t2;
                            rgb.b = t1 - t3
                        }
                        else
                        {
                            rgb.r = 0;
                            rgb.g = 0;
                            rgb.b = 0
                        }
                    }
                    return {
                        r: Math.round(rgb.r),
                        g: Math.round(rgb.g),
                        b: Math.round(rgb.b)
                    };
                },
                RGBToHex = function (rgb)
                {
                    var hex = [
                    rgb.r.toString(16), rgb.g.toString(16), rgb.b.toString(16)];
                    $.each(hex, function (nr, val)
                    {
                        if (val.length == 1)
                        {
                            hex[nr] = '0' + val;
                        }
                    });
                    return hex.join('');
                },
                HSBToHex = function (hsb)
                {
                    return RGBToHex(HSBToRGB(hsb));
                },
                restoreOriginal = function ()
                {
                    var cal = $(this).parent();
                    var col = cal.data('colorpicker').origColor;
                    cal.data('colorpicker').color = col;
                    fillRGBFields(col, cal.get(0));
                    fillHexFields(col, cal.get(0));
                    fillHSBFields(col, cal.get(0));
                    setSelector(col, cal.get(0));
                    setHue(col, cal.get(0));
                    setNewColor(col, cal.get(0));
                };
            return {
                init: function (opt)
                {
                    opt = $.extend(
                    {}, defaults, opt || {});
                    if (typeof opt.color == 'string')
                    {
                        opt.color = HexToHSB(opt.color);
                    }
                    else if (opt.color.r != undefined && opt.color.g != undefined && opt.color.b != undefined)
                    {
                        opt.color = RGBToHSB(opt.color);
                    }
                    else if (opt.color.h != undefined && opt.color.s != undefined && opt.color.b != undefined)
                    {
                        opt.color = fixHSB(opt.color);
                    }
                    else
                    {
                        return this;
                    }
                    return this.each(function ()
                    {
                        if (!$(this).data('colorpickerId'))
                        {
                            var options = $.extend(
                            {}, opt);
                            options.origColor = opt.color;
                            var id = 'collorpicker_' + parseInt(Math.random() * 1000);
                            $(this).data('colorpickerId', id);
                            var cal = $(tpl).attr('id', id);
                            if (options.flat)
                            {
                                cal.appendTo(this).show();
                            }
                            else
                            {
                                cal.appendTo(document.body);
                            }
                            options.fields = cal.find('input').bind('keyup', keyDown).bind('change', change).bind('blur', blur).bind('focus', focus);
                            cal.find('span').bind('mousedown', downIncrement).end().find('>div.colorpicker_current_color').bind('click', restoreOriginal);
                            options.selector = cal.find('div.colorpicker_color').bind('mousedown', downSelector);
                            options.selectorIndic = options.selector.find('div div');
                            options.el = this;
                            options.hue = cal.find('div.colorpicker_hue div');
                            cal.find('div.colorpicker_hue').bind('mousedown', downHue);
                            options.newColor = cal.find('div.colorpicker_new_color');
                            options.currentColor = cal.find('div.colorpicker_current_color');
                            cal.data('colorpicker', options);
                            cal.find('div.colorpicker_submit').bind('mouseenter', enterSubmit).bind('mouseleave', leaveSubmit).bind('click', clickSubmit);
                            fillRGBFields(options.color, cal.get(0));
                            fillHSBFields(options.color, cal.get(0));
                            fillHexFields(options.color, cal.get(0));
                            setHue(options.color, cal.get(0));
                            setSelector(options.color, cal.get(0));
                            setCurrentColor(options.color, cal.get(0));
                            setNewColor(options.color, cal.get(0));
                            if (options.flat)
                            {
                                cal.css(
                                {
                                    position: 'relative',
                                    display: 'block'
                                });
                            }
                            else
                            {
                                $(this).bind(options.eventName, show);
                            }
                        }
                    });
                },
                showPicker: function ()
                {
                    return this.each(function ()
                    {
                        if ($(this).data('colorpickerId'))
                        {
                            show.apply(this);
                        }
                    });
                },
                hidePicker: function ()
                {
                    return this.each(function ()
                    {
                        if ($(this).data('colorpickerId'))
                        {
                            $('#' + $(this).data('colorpickerId')).hide();
                        }
                    });
                },
                setColor: function (col)
                {
                    if (typeof col == 'string')
                    {
                        col = HexToHSB(col);
                    }
                    else if (col.r != undefined && col.g != undefined && col.b != undefined)
                    {
                        col = RGBToHSB(col);
                    }
                    else if (col.h != undefined && col.s != undefined && col.b != undefined)
                    {
                        col = fixHSB(col);
                    }
                    else
                    {
                        return this;
                    }
                    return this.each(function ()
                    {
                        if ($(this).data('colorpickerId'))
                        {
                            var cal = $('#' + $(this).data('colorpickerId'));
                            cal.data('colorpicker').color = col;
                            cal.data('colorpicker').origColor = col;
                            fillRGBFields(col, cal.get(0));
                            fillHSBFields(col, cal.get(0));
                            fillHexFields(col, cal.get(0));
                            setHue(col, cal.get(0));
                            setSelector(col, cal.get(0));
                            setCurrentColor(col, cal.get(0));
                            setNewColor(col, cal.get(0));
                        }
                    });
                }
            };
        }();
    $.fn.extend(
    {
        ColorPicker: ColorPicker.init,
        ColorPickerHide: ColorPicker.hidePicker,
        ColorPickerShow: ColorPicker.showPicker,
        ColorPickerSetColor: ColorPicker.setColor
    });
})(jQuery)

var ChartHelper = function ()
    {

        var visualizeChartType = 'area';
        var visualizeChartHeight = '280px';
        var visualizeChartColors = ['#06C', '#222', '#777', '#555', '#002646', '#999', '#bbb', '#ccc', '#eee'];
        var visualizeChartWidth = '';

        return {
            fusion: fusion,
            visualize: visualize
        };

        function visualize(config)
        {
            config.el.each(function ()
            {
                visualizeChartHeight = ($(this).attr('data-chart-height') != null) ? $(this).attr('data-chart-height') + 'px' : visualizeChartHeight;
                visualizeChartType = ($(this).attr('data-chart-type') != null) ? $(this).attr('data-chart-type') : visualizeChartType;

                visualizeChartWidth = $(this).parent().width() * .92;

                if (visualizeChartType == 'line' || visualizeChartType == 'pie')
                {
                    $(this).hide().visualize(
                    {
                        type: visualizeChartType,
                        width: visualizeChartWidth,
                        height: visualizeChartHeight,
                        colors: visualizeChartColors,
                        lineDots: 'double',
                        interaction: true,
                        multiHover: 5,
                        tooltip: true,
                        tooltiphtml: function (data)
                        {
                            var html = '';
                            for (var i = 0; i < data.point.length; i++)
                            {
                                html += '<p class="chart_tooltip"><strong>' + data.point[i].value + '</strong> ' + data.point[i].yLabels[0] + '</p>';
                            }
                            return html;
                        }
                    }).addClass('chartHelperChart');;
                }
                else
                {
                    $(this).hide().visualize(
                    {
                        type: visualizeChartType,
                        colors: visualizeChartColors,
                        width: visualizeChartWidth,
                        height: visualizeChartHeight
                    }).addClass('chartHelperChart');
                }
            });
        }

        function fusion(object)
        {

            var el = $('#' + object.id);

            el.addClass('chart-holder');
            el.empty();
            object.width = object.width || el.width();
            object.height = object.height || el.height();

            object.width = el.width();

            var chart = new FusionCharts("./FusionCharts/FCF_" + object.chart + ".swf", object.id, object.width, object.height);
            if (object.dataUrl)
            {
                chart.setDataURL(object.dataUrl);
            }
            else
            {
                chart.setDataXML(object.data);
            }

            chart.render(object.id);

            return chart;

        }
    }();

$(function ()
{
    Layout.init();
    Menu.init();
    Nav.init();

    if ($.fn.dataTable)
    {
        $('.data-table').dataTable(
        {
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
        });
    };

    drawChart();

    $(document).bind('layout.resize', function ()
    {
        drawChart();
    });

    if ($('.chartHelperChart').length < 1)
    {
        $(document).unbind('layout.resize');
    }

    $('.uniformForm').find("select, input:checkbox, input:radio, input:file").uniform();

    $('.validateForm').validationEngine();

    $('#reveal-nav').live('click', toggleNav);

    $('.notify').find('.close').live('click', notifyClose);

    $('.tooltip').tipsy();
});

function notifyClose(e)
{
    e.preventDefault();

    $(this).parents('.notify').slideUp('medium', function ()
    {
        $(this).remove();
    });
}

function toggleNav(e)
{
    e.preventDefault();

    $('#sidebar').toggleClass('revealShow');
}

function drawChart()
{
    $('.chartHelperChart').remove();
    ChartHelper.visualize(
    {
        el: $('table.stats')
    });
}