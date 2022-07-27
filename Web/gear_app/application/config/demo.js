/**
 * AdminLTE Demo Menu
 * ------------------
 * You should not use this file in production.
 * This file is for demo purposes only.
 */
$(function () {
  'use strict'

  /**
   * Get access to plugins
   */

  $('[data-toggle="control-sidebar"]').controlSidebar()
  $('[data-toggle="push-menu"]').pushMenu()

  var $pushMenu       = $('[data-toggle="push-menu"]').data('lte.pushmenu')
  var $controlSidebar = $('[data-toggle="control-sidebar"]').data('lte.controlsidebar')
  var $layout         = $('body').data('lte.layout')

  /**
   * List of all the available skins
   *
   * @type Array
   */
  var mySkins = [
    'skin-blue',
    'skin-black',
    'skin-red',
    'skin-yellow',
    'skin-purple',
    'skin-green',
    'skin-blue-light',
    'skin-black-light',
    'skin-red-light',
    'skin-yellow-light',
    'skin-purple-light',
    'skin-green-light'
  ]

  /**
   * Get a prestored setting
   *
   * @param String name Name of of the setting
   * @returns String The value of the setting | null
   */
  function get(name) {
    if (typeof (Storage) !== 'undefined') {
      return localStorage.getItem(name)
    } else {
      window.alert('Please use a modern browser to properly view this template!')
    }
  }

  /**
   * Store a new settings in the browser
   *
   * @param String name Name of the setting
   * @param String val Value of the setting
   * @returns void
   */
  function store(name, val) {
    if (typeof (Storage) !== 'undefined') {
      localStorage.setItem(name, val)
    } else {
      window.alert('Please use a modern browser to properly view this template!')
    }
  }

  /**
   * Toggles layout classes
   *
   * @param String cls the layout class to toggle
   * @returns void
   */
  function changeLayout(cls) {
    $('body').toggleClass(cls)
    //$layout.fixSidebar()
    if ($('body').hasClass('fixed') && cls == 'fixed') {
      $pushMenu.expandOnHover()
      $layout.activate()
    }
    $controlSidebar.fix()
  }

  /**
   * Replaces the old skin with the new skin
   * @param String cls the new skin class
   * @returns Boolean false to prevent link's default action
   */
  function changeSkin(cls) {
    $.each(mySkins, function (i) {
      $('body').removeClass(mySkins[i])
    })

    $('body').addClass(cls)
    store('skin', cls)
    return false
  }

  /**
   * Retrieve default settings and apply them to the template
   *
   * @returns void
   */
  function setup() {
    var tmp = get('skin')
    if (tmp && $.inArray(tmp, mySkins))
      changeSkin(tmp)

    // Add the change skin listener
    $('[data-skin]').on('click', function (e) {
      if ($(this).hasClass('knob'))
        return
      e.preventDefault()
      changeSkin($(this).data('skin'))
    })

    // Add the layout manager
    $('[data-layout]').on('click', function () {
		
      changeLayout($(this).data('layout'))
    })

    $('[data-controlsidebar]').on('click', function () {
     changeLayout($(this).data('controlsidebar'))
      var slide = !$controlSidebar.options.slide	  
      $controlSidebar.options.slide = slide
      if (!slide)
        $('.control-sidebar').removeClass('control-sidebar-open')
    })

    $('[data-sidebarskin="toggle"]').on('click', function () {
		
      var $sidebar = $('.control-sidebar')
      if ($sidebar.hasClass('control-sidebar-dark')) {
        $sidebar.removeClass('control-sidebar-dark')
        $sidebar.addClass('control-sidebar-light')
      } else {
        $sidebar.removeClass('control-sidebar-light')
        $sidebar.addClass('control-sidebar-dark')
      }
    })

    $('[data-enable="expandOnHover"]').on('click', function () {
		
      $(this).attr('disabled', true)
      $pushMenu.expandOnHover()
      if (!$('body').hasClass('sidebar-collapse'))
        $('[data-layout="sidebar-collapse"]').click()
    })

    //  Reset options
    if ($('body').hasClass('fixed')) {
      $('[data-layout="fixed"]').attr('checked', 'checked')
    }
    if ($('body').hasClass('layout-boxed')) {
      $('[data-layout="layout-boxed"]').attr('checked', 'checked')
    }
    if ($('body').hasClass('sidebar-collapse')) {
      $('[data-layout="sidebar-collapse"]').attr('checked', 'checked')
    }

  }

  // Create the new tab
  var $tabPane = $('<div />', {
    'id'   : 'control-sidebar-theme-demo-options-tab',
    'class': 'tab-pane'
  })

  // Create the tab button
  var $tabButton = $('<li />')
  //var $tabButton = $('<li />', { 'class': 'active' })
    .html('<a href=\'#control-sidebar-theme-demo-options-tab\' data-toggle=\'tab\'>'
      + '<i class="fa fa-wrench"></i>'
      + '</a>')
  // Add the tab button to the right sidebar tabs
  $('[href="#control-sidebar-home-tab"]')
    .parent()
    .before($tabButton)

  // Create the menu
  var $demoSettings = $('<div />')

  // Layout options
  $demoSettings.append(
    '<h4 class="control-sidebar-heading">'
    + 'Layout Options'
    + '</h4>'
    // Sidebar Toggle
    + '<div class="form-group">'
    + '<label class="control-sidebar-subheading">'
    + '<input type="checkbox"data-layout="sidebar-collapse"class="pull-right"/> '
    + 'Toggle Sidebar'
    + '</label>'
    + '<p>Toggle the left sidebar\'s state (open or collapse)</p>'
    + '</div>'
    // Sidebar mini expand on hover toggle
    + '<div class="form-group">'
    + '<label class="control-sidebar-subheading">'
    + '<input type="checkbox"data-enable="expandOnHover"class="pull-right"/> '
    + 'Sidebar Expand on Hover'
    + '</label>'
    + '<p>Let the sidebar mini expand on hover</p>'
    + '</div>'
    // Control Sidebar Toggle
    + '<div class="form-group">'
    + '<label class="control-sidebar-subheading">'
    + '<input type="checkbox"data-controlsidebar="control-sidebar-open"id="chkrightsidebarslide"class="pull-right" checked /> '
    + 'Toggle Right Sidebar Slide'
    + '</label>'
    + '<p>Toggle between slide over content and push content effects</p>'
    + '</div>'
    // Control Sidebar Skin Toggle
    + '<div class="form-group">'
    + '<label class="control-sidebar-subheading">'
    + '<input type="checkbox"data-sidebarskin="toggle"class="pull-right"/> '
    + 'Toggle Right Sidebar Skin'
    + '</label>'
    + '<p>Toggle between dark and light skins for the right sidebar</p>'
    + '</div>'
  )
  var $skinsList = $('<ul />', { 'class': 'list-unstyled clearfix' })

  // Dark sidebar skins
  var $skinBlue =
        $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
          .append('<a href="javascript:void(0)" data-skin="skin-blue" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
            + '<div><span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9"></span><span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
            + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
            + '</a>'
            + '<p class="text-center no-margin">Blue</p>')
  $skinsList.append($skinBlue)
  var $skinBlack =
        $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
          .append('<a href="javascript:void(0)" data-skin="skin-black" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
            + '<div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe"></span><span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe"></span></div>'
            + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
            + '</a>'
            + '<p class="text-center no-margin">Black</p>')
  $skinsList.append($skinBlack)
  var $skinPurple =
        $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
          .append('<a href="javascript:void(0)" data-skin="skin-purple" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
            + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active"></span><span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
            + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
            + '</a>'
            + '<p class="text-center no-margin">Purple</p>')
  $skinsList.append($skinPurple)
  var $skinGreen =
        $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
          .append('<a href="javascript:void(0)" data-skin="skin-green" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
            + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active"></span><span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
            + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
            + '</a>'
            + '<p class="text-center no-margin">Green</p>')
  $skinsList.append($skinGreen)
  var $skinRed =
        $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
          .append('<a href="javascript:void(0)" data-skin="skin-red" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
            + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active"></span><span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
            + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
            + '</a>'
            + '<p class="text-center no-margin">Red</p>')
  $skinsList.append($skinRed)
  var $skinYellow =
        $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
          .append('<a href="javascript:void(0)" data-skin="skin-yellow" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
            + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active"></span><span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
            + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
            + '</a>'
            + '<p class="text-center no-margin">Yellow</p>')
  $skinsList.append($skinYellow)

  // Light sidebar skins
  var $skinBlueLight =
        $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
          .append('<a href="javascript:void(0)" data-skin="skin-blue-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
            + '<div><span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9"></span><span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
            + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
            + '</a>'
            + '<p class="text-center no-margin" style="font-size: 12px">Blue Light</p>')
  $skinsList.append($skinBlueLight)
  var $skinBlackLight =
        $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
          .append('<a href="javascript:void(0)" data-skin="skin-black-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
            + '<div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe"></span><span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe"></span></div>'
            + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
            + '</a>'
            + '<p class="text-center no-margin" style="font-size: 12px">Black Light</p>')
  $skinsList.append($skinBlackLight)
  var $skinPurpleLight =
        $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
          .append('<a href="javascript:void(0)" data-skin="skin-purple-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
            + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active"></span><span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
            + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
            + '</a>'
            + '<p class="text-center no-margin" style="font-size: 12px">Purple Light</p>')
  $skinsList.append($skinPurpleLight)
  var $skinGreenLight =
        $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
          .append('<a href="javascript:void(0)" data-skin="skin-green-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
            + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active"></span><span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
            + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
            + '</a>'
            + '<p class="text-center no-margin" style="font-size: 12px">Green Light</p>')
  $skinsList.append($skinGreenLight)
  var $skinRedLight =
        $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
          .append('<a href="javascript:void(0)" data-skin="skin-red-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
            + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active"></span><span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
            + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
            + '</a>'
            + '<p class="text-center no-margin" style="font-size: 12px">Red Light</p>')
  $skinsList.append($skinRedLight)
  var $skinYellowLight =
        $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
          .append('<a href="javascript:void(0)" data-skin="skin-yellow-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
            + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active"></span><span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
            + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
            + '</a>'
            + '<p class="text-center no-margin" style="font-size: 12px">Yellow Light</p>')
  $skinsList.append($skinYellowLight)

  $demoSettings.append('<h4 class="control-sidebar-heading">Skins</h4>')
  $demoSettings.append($skinsList)

  $tabPane.append($demoSettings)
  $('#control-sidebar-home-tab').after($tabPane)

  setup()

  $('[data-toggle="tooltip"]').tooltip()
})

// start new java script 26/02/2018
    function toggleRightSidebarSlide() {
        $('#chkrightsidebarslide').prop('checked', false);
    }
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
        //Date range as a button
        $('#daterange-btn').daterangepicker(
          {
              ranges: {
                  'Today': [moment(), moment()],
                  'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                  'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                  'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                  'This Month': [moment().startOf('month'), moment().endOf('month')],
                  'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate: moment()
          },
          function (start, end) {
              $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
          }
        )

        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })
		$('#datepicker1').datepicker({
            autoclose: true
        })

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        })

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        //Timepicker
        $('.timepicker').timepicker({
            showInputs: false
        })
		
		
    })
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
       // CKEDITOR.replace('editor1')
        //bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5()
    })
	  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
	  'pageLength': 15,
	  "columnDefs": [	  
        {"className": "text-center", "targets":[1,2,4,5]},
		{"className": "text-right", "targets":[3]},
		{"className": "text-left", "targets":[0]}
      ]
    })
	
  })
    //numeric value
    function isNumberKey(evt)
    {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57) )
    return false;

   return true;
   }
   //Numeric value 2
            var specialKeys = new Array();
        specialKeys.push(8); //Backspace
        function IsNumeric(e) {
            var keyCode = e.which ? e.which : e.keyCode
            var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
           // document.getElementById("spanTextbox_Numeric").style.display = ret ? "none" : "inline";
            return ret;
        }
    //decimal value
    function isNumberKey2(txt, evt) {

        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode == 46) {
            //Check if the text already contains the . character
            if (txt.value.indexOf('.') === -1) {
                return true;
            } else {
			//document.getElementById("spanTextbox_Decimal").style.display = ret ? "none" : "inline";
                return false;
            }
        } else {
            if (charCode > 31
                 && (charCode < 48 || charCode > 57)|| specialKeys.indexOf(keyCode) != -1)
				// document.getElementById("spanTextbox_Decimal").style.display = ret ? "none" : "inline";
                return false;
        }
        return true;
    }
    // Email must be an email
    $('#txtEmailIDTextbox').on('input', function () {
        var input = $(this);
       // var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
	    var re= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        var is_email = re.test(input.val());
        if (is_email) { input.removeClass("invalid").addClass("valid"); }
        else { input.removeClass("valid").addClass("invalid"); }
    });
	// Website must be a website
$('#contact_website').on('input', function() {
	var input=$(this);
	if (input.val().substring(0,4)=='www.'){input.val('http://www.'+input.val().substring(4));}
	var re = /(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&:\/~+#-]*[\w@?^=%&\/~+#-])?/;
	var is_url=re.test(input.val());
	if(is_url){input.removeClass("invalid").addClass("valid");}
	else{input.removeClass("valid").addClass("invalid");}
});

    function validation() {
		var Auto50_TextBoxVarchar=$('#txtAuto50_TextBoxVarchar').val();
		//var TextAreaAuto=$('#txtTextAreaAuto').val();
		var EmailIDTextbox=$('#txtEmailIDTextbox').val();
		//var ContactNo=$('#txtContactNo').val();
		//var Textbox_Numeric=$('#txtTextbox_Numeric').val();
		//var Textbox_Decimal=$('#txtTextbox_Decimal').val();
	    var inputs = document.getElementsByTagName('input');
		var Span = document.getElementsByTagName('Span');
		var textarea=document.getElementsByTagName('textarea');
		
		 if(Auto50_TextBoxVarchar=='')
		 {
			   $( "#txtAuto50_TextBoxVarchar" ).focus();
			   $('[data-toggle="popover"]').popover(); 
				 return false;
		 }
		// else if(TextAreaAuto=='')
		// {
				// return false;
		// }
		if(EmailIDTextbox=='')
		{
			var input = $('#txtEmailIDTextbox');
			var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
			var is_email = re.test(mail);
			if (is_email) {
				input.removeClass("invalid").addClass("valid");
			}
			else {
				input.removeClass("valid").addClass("invalid");
			}			
		}
		// else if(ContactNo=='')
		// {
				// return false;
		// }
		// else if(Textbox_Numeric=='')
		// {
				// return false;
		// }
		// else if(Textbox_Decimal=='')
		// {
				// return false;
		// }
		$('#btnsubmit').attr('data-toggle', 'modal');
		$('#btnsubmit').attr('data-target', '#modal-default-Submit');
		return true;
		}
		
	$(':required').one('blur keydown', function() {
    $(this).addClass('touched');
    });
	
function savedata(url)
{
	
	//alert(document.getElementById("qty2").innerHTML);
	var ordernumber=document.getElementById("selectedOrderNumber").value.trim();
	var statusid=document.getElementById("selectedStatus").value.trim();
	$.post(""+url+"/saveOrderStatus",
    {
        ordernumber: ordernumber,
		statusid:statusid
        
    },
    function(data, status){
		console.log('response='+data);
		console.log('status='+status);
		if(status=="success")
		{
       // document.getElementById("qty"+i).innerHTML=qty;
		alert('Order details updated');
		}
		 
    });	
}
	
function editbutton(url,order_id,order_no,user_name,dealer_name,order_status,order_date)
{
	try{
	$('#activity, #listActivity').removeClass('active');
	$('#timeline,#listTimeline').addClass('active');
	$('#timeline,#listTimeline').removeClass('disabled');
	$('#timelinetab').attr('data-toggle', 'tab');
	/*$('#example1 tr:last').after('<tr><td style='text-align:center;'>LG</td><td>Microwave</td><td>Convection</td><td>MC2146BP.DBKQILN</td>				  <td>1</td></tr>');*/
	var markup = "";

          $("#selectedOrderNumber").val(order_no); 
          $("#selectedOrderDate").val(order_date);
          var select_customer = document.getElementById("selectedCustomer");
            select_customer.options.length = 0;
            select_customer.options[select_customer.options.length] = new Option(''+dealer_name, '', false, false);
			
			var select_user = document.getElementById("selectedUser");
            select_user.options.length = 0;
            select_user.options[select_user.options.length] = new Option(''+user_name, '', false, false);
			
			$('[name=selectedStatus] option').filter(function() { 
    return ($(this).text() == ''+order_status); //To select Blue
}).prop('selected', true);
		  
		  
			console.log('order='+order_no);
			
		$.post(""+url+"/getOrderedItems",
    {
        orderid: order_id
        
    },
    function(data, status){
        //alert("Data: " + data + "\nStatus: " + status);
		//console.log(data);
		
		var itemdetails_obj=JSON.parse(data);
		//console.log(itemdetails_obj.productarray.length);
		//console.log(itemdetails_obj.productarray);
		for(var i=0;i<itemdetails_obj.productarray.length;i++)
		{
			markup += "<tr><td>"+itemdetails_obj.productarray[i]['brandname']+"</td><td>"+itemdetails_obj.productarray[i]['parentcategoryname']+"</td><td>"+itemdetails_obj.productarray[i]['categoryname']+"</td><td>"+itemdetails_obj.productarray[i]['productname']+"</td><td>"+itemdetails_obj.productarray[i]['orderedquantity']+"</td>				  <td><p id='qty"+i+"' name='qty"+i+"' onclick=\"updateqty('"+url+"','"+i+"','"+itemdetails_obj.productarray[i]['orderdetailid']+"')\">"+itemdetails_obj.productarray[i]['approvedquantity']+"</p></td></tr>";
			
		}
		 
		 $("#items").append(markup);
		 
    });	
			
			
	}catch(e)
	{
		
	alert(e);	
	}
							
	
}
function updateqty(url,i,orderdetailid)
{
	var prevqty=document.getElementById("qty"+i).innerHTML;
	var qty = prompt("Please enter quantity", prevqty);
	
	if (qty === null) {return;}
	
	$.post(""+url+"/saveOrderedItems",
    {
        orderdetailid: orderdetailid,
		approvedquantity:qty
        
    },
    function(data, status){
		console.log('response='+data);
		console.log('status='+status);
		if(status=="success")
		{
        document.getElementById("qty"+i).innerHTML=qty;
		//alert('Approved quantity updated');
		}
		 
    });	
			
	
	
	
	
}
function returnbutton(url)
{
	
	$("#items").empty();
	$('#timeline, #listTimeline').removeClass('active');
	$('#activity, #listActivity').addClass('active');
	$('#timeline, #listTimeline').removeClass('disabled');
	//window.location=""+url+"/getOrderListItems";
	
}

function returngrnbutton(url)
{
	
	window.location=""+url+"/getGrnListItems";
	
}
// End new java script 26/02/2018

//newly added for grn on 17/05/2017

function editgrnbutton(url,grn_id,grn_no,user_name,dealer_name,grn_status,grn_date)
{


	try{
	$('#activity, #listActivity').removeClass('active');
	$('#timeline,#listTimeline').addClass('active');
	$('#timeline,#listTimeline').removeClass('disabled');
	$('#timelinetab').attr('data-toggle', 'tab');
	//alert(grn_id);
	var markup = "";

          $("#selectedGrnNumber").val(grn_no); 
          $("#selectedGrnDate").val(grn_date);
          var select_customer = document.getElementById("selectedCustomer");
            select_customer.options.length = 0;
            select_customer.options[select_customer.options.length] = new Option(''+dealer_name, '', false, false);
			
			var select_user = document.getElementById("selectedUser");
            select_user.options.length = 0;
            select_user.options[select_user.options.length] = new Option(''+user_name, '', false, false);
			
			$('[name=selectedStatus] option').filter(function() { 
    return ($(this).text() == ''+grn_status); //To select Blue
}).prop('selected', true);
		  
		  
			
			
		$.post(""+url+"/getGrnItems",
    {
        grnid: grn_id
        
    },
    function(data, status){
        //alert("Data: " + data + "\nStatus: " + status);
		//console.log(data);
		
		var itemdetails_obj=JSON.parse(data);
		//console.log(itemdetails_obj.productarray.length);
		//console.log(itemdetails_obj.productarray);
		for(var i=0;i<itemdetails_obj.productarray.length;i++)
		{
			markup += "<tr><td>"+itemdetails_obj.productarray[i]['brandname']+"</td><td>"+itemdetails_obj.productarray[i]['parentcategoryname']+"</td><td>"+itemdetails_obj.productarray[i]['categoryname']+"</td><td>"+itemdetails_obj.productarray[i]['productname']+"</td><td>"+itemdetails_obj.productarray[i]['grnquantity']+"</td><td>"+itemdetails_obj.productarray[i]['grndefect']+"</td><td>"+itemdetails_obj.productarray[i]['grnfeedback']+"</td></tr>";
			
		}
		// alert(markup);
		 $("#items").append(markup);
		 
    });	
			
			
	}catch(e)
	{
		
	alert(e);	
	}
	
}
						
	function editcollctionbutton(url,collection_id,user_name,dealer_name,colln_type,collection_date)
	{
	
	try{
	$('#activity, #listActivity').removeClass('active');
	$('#timeline,#listTimeline').addClass('active');
	$('#timeline,#listTimeline').removeClass('disabled');
	$('#timelinetab').attr('data-toggle', 'tab');
	//alert(grn_id);
	var markup = "";

          $("#collectionid").val(collection_id); 
          $("#selectedCollectionDate").val(collection_date);
          var select_customer = document.getElementById("selectedCustomer");
            select_customer.options.length = 0;
            select_customer.options[select_customer.options.length] = new Option(''+dealer_name, '', false, false);
			
			var select_user = document.getElementById("selectedUser");
            select_user.options.length = 0;
            select_user.options[select_user.options.length] = new Option(''+user_name, '', false, false);
			
			$('[name=collectiontype] option').filter(function() { 
    return ($(this).text() == ''+colln_type); //To select Blue
}).prop('selected', true);
		  
		  
			
			
		$.post(""+url+"/getCollections",
    {
        collectionid: collection_id
        
    },
    function(data, status){
        //alert("Data: " + data + "\nStatus: " + status);
		//console.log(data);
		
		var itemdetails_obj=JSON.parse(data);
		//console.log(itemdetails_obj.productarray.length);
		//console.log(itemdetails_obj.productarray);
		for(var i=0;i<itemdetails_obj.collectionarray.length;i++)
		{
			markup += "<tr><td>"+itemdetails_obj.collectionarray[i]['CollectionID']+"</td><td>"+itemdetails_obj.collectionarray[i]['bankname']+"</td><td>"+itemdetails_obj.collectionarray[i]['transactionID']+"</td><td>"+itemdetails_obj.collectionarray[i]['Cheque']+"</td><td>"+itemdetails_obj.collectionarray[i]['ChequeNo']+"</td></tr>";
			
		}
		// alert(markup);
		 $("#items").append(markup);
		 
    });	
			
			
	}catch(e)
	{
		
	alert(e);	
	}
	}
	function edituserbutton(url,UserID,Name,Location,UserGroup,brand,ID)
	{
	try{
	$('#activity, #listActivity').removeClass('active');
	$('#timeline,#listTimeline').addClass('active');
	$('#timeline,#listTimeline').removeClass('disabled');
	$('#timelinetab').attr('data-toggle', 'tab');
	//alert(grn_id);
	var markup = "";

          $("#userid").val(UserID); 
          $("#username").val(Name);
		  $("#location").val(Location);
		  $("#userGroup").val(UserGroup);
		  $("#brand").val(brand);
     
		  
		  
			
			
		$.post(""+url+"/getUsers",
    {
        userid: ID
        
    },
    function(data, status){
       
		
		var itemdetails_obj=JSON.parse(data);
		
					
					
		
 var option = '';
    for(var i = 0; i < itemdetails_obj.length; i++){
	var userlist=itemdetails_obj[i].userlist;
			for(var j = 0; j < userlist.length; j++)
			{
			markup += "<tr><input type='hidden' value='"+ID+"' name='userid'><td><label>IMEI NO</label></td><td><input type='text' name='imei_no' value='"+userlist[j]['IMEI_No']+"'></td><td><td><label>Brand List</label></td><td><select name='brandid[]' id='brandid' multiple></select></td></tr>";
				
				var dealearray=userlist[j].dealerArray;
				for(var k=0;k<dealearray.length;k++)
				{
					option += '<option value="' + dealearray[k]['CategoryID'] + '">' + dealearray[k]['CategoryName'] + '</option>';
				}
				
			}
	
       
    }
   
	 $("#items").append(markup);
	 $("#brandid").append(option);
		 
    });	
			
			
	}catch(e)
	{
		
	alert(e);	
	}
	
	}
