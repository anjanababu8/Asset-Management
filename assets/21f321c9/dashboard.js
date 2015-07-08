(function($, undefined) {
    $.fn.dashbrd = function(params)
    {
        if(!params.autoSave)
        {
            $( "#dash-column td").sortable({
                opacity: 0.8,
                connectWith: "#dash-column td"
            });
        }
        else
        {
            $( "#dash-column td").sortable({
                connectWith: "#dash-column td",
                opacity: 0.8,
                stop: function(){
                    var result = new Array(),
                    i = 0;
                    $('#dash-column td').each(function()
                    {
                        result[i++] = $(this).sortable('toArray');
                    });
                    $.post(params.saveUrl, {
                        widgetsPos: result,
                        columnsCount: --i
                    } );
                    return true;
                }
            });
        }
        $( ".dash-portlet" ).addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
        .find( ".dash-portlet-header" )
        .addClass( "ui-widget-header ui-corner-all" )
        .prepend( "<span class='ui-icon ui-icon-minusthick'></span>")
        .end()
        .find( ".dash-portlet-content" );

        $('#dash-header').addClass('dash-portlet-header ui-widget-header ui-corner-all');

        $( ".dash-portlet-header .ui-icon" ).click(function() {
            $( this ).toggleClass( "ui-icon-minusthick" ).toggleClass( "ui-icon-plusthick" );
            $( this ).parents( ".dash-portlet:first" ).find( ".dash-portlet-content" ).toggle();
        });

        $( ".dash-column").disableSelection();

        // Invert All Portlets
        $('#all_invert').click(function()
        {
            $( ".dash-portlet-header .ui-icon" ).toggleClass( "ui-icon-minusthick" ).toggleClass( "ui-icon-plusthick" );
            $( ".dash-portlet-header .ui-icon" ).parents( ".dash-portlet" ).find( ".dash-portlet-content" ).toggle();
        }
        );

        // Expand All Portlets
        $('#all_expand').click(function()
        {
            $( ".dash-portlet-header .ui-icon" ).addClass( "ui-icon-minusthick" ).removeClass( "ui-icon-plusthick" );
            $( ".dash-portlet-header .ui-icon" ).parents( ".dash-portlet" ).find( ".dash-portlet-content" ).show();
        }
        );

        // Collapse All Portlets
        $('#all_collapse').click(function()
        {
            $( ".dash-portlet-header .ui-icon" ).removeClass( "ui-icon-minusthick" ).addClass( "ui-icon-plusthick" );
            $( ".dash-portlet-header .ui-icon" ).parents( ".dash-portlet" ).find( ".dash-portlet-content" ).hide();
        }
        );

        // Open All Portlets
        $('#all_open').click(function()
        {
            $('#dashboard').show();
            $('#all_open:visible').hide();
            $('#all_close:hidden').show();
        }
        );

        // Close All Portlets
        $('#all_close').click(function()
        {
            $('#dashboard').hide();
            $('#all_close:visible').hide();
            $('#all_open:hidden').show();
        }
        );

        $('#all_save').click(function()
        {
            var result = new Array(),
            i = 0;
            $('#dash-column td').each(function()
            {
                result[i++] = $(this).sortable('toArray');
            });            
            $.post(params.saveUrl, {
                widgetsPos: result,
                columnsCount: --i
                },
                function(data){
                    $('#msgSave').show('slow').delay(1500).hide('slow');
                }
            );
            return false;
        }
        );
    }
})(jQuery);
