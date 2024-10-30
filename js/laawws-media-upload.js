jQuery(document).ready(function ($) {
 
   $(document).on("click", ".laawws_upload_image_button", function (e) {
      e.preventDefault();
      var $button = $(this);
 
 
      // Create the media frame.
      var file_frame = wp.media.frames.file_frame = wp.media({
         title: 'Select or upload image',
         library: { // remove these to show all
            type: 'image' // specific mime
         },
         button: {
            text: 'Select'
         },
         multiple: false  // Set to true to allow multiple files to be selected
      });
 
      // When an image is selected, run a callback.
      file_frame.on('select', function () { 
         // We set multiple to false so only get one image from the uploader 
         var attachment = file_frame.state().get('selection').first().toJSON();
 
         $button.siblings('input').val(attachment.url);
         $button.closest('form').find('input.widget-control-save').removeAttr("disabled");
 
      });
 
      // Finally, open the modal
      file_frame.open();
   });

   // By default enable show the icons option for image field
   $('.laawws_image_radio_wrap').find('input[type=radio][value="left"]').attr('checked', true);
   
   // By default enable show the icons option for email/phone/fax fields 
   $('.laawws_epf_radio_wrap').find('input[type=radio][value="icons"]').attr('checked', true);
   
   // // By default enable show the schema for address field
   $('.laawws_address_radio_wrap').find('input[type=radio][value="on"]').attr('checked', true);


   // Address Icons change
   $('.laawws_address_radio_wrap').find('input[type=radio][value="icon"]').attr('checked', true);
   $('.laawws_address_radio_wrap').find('input[type=radio][value="font-awesome"]').attr('checked', true);
   $('.laawws_address_radio_wrap').find('input[type=radio][value="custom-image"]').attr('checked', true);

   $('.laawws_address_fawesome_wrap').hide();
   $('.laawws_address_custom_image_wrap').hide();
    // Uncheck the checkbox for weekdays if the checkbox Mon-Fri is selected
   $(document).on('click', ".laawws_address_radio_wrap input[type=radio]", function (){

      if($(this).is(":checked")) {
         if($(this).val() == "font-awesome" ) {
            $('.laawws_address_fawesome_wrap').show();
            $('.laawws_address_custom_image_wrap').hide();
         } else if($(this).val() == "custom-image" ) {
            $('.laawws_address_fawesome_wrap').hide();
            $('.laawws_address_custom_image_wrap').show();         
         } else {
            $('.laawws_address_fawesome_wrap').hide();
            $('.laawws_address_custom_image_wrap').hide();
         }
      }

   });
   

   // Uncheck the checkbox for weekdays if the checkbox Mon-Fri is selected
   $(document).on('click', ".laawws-date-left.mon-fri input[type=checkbox]", function (){

      if($(this).is(":checked")) {

         // alert("test");

         $('.laawws-date-left.mon').find('input[type=checkbox]').attr('checked', false);
         $('.laawws-date-left.tue').find('input[type=checkbox]').attr('checked', false);
         $('.laawws-date-left.wed').find('input[type=checkbox]').attr('checked', false);
         $('.laawws-date-left.thu').find('input[type=checkbox]').attr('checked', false);
         $('.laawws-date-left.fri').find('input[type=checkbox]').attr('checked', false);
         $('.laawws-date-left.mon-fri input[type=checkbox]').attr('checked', true);

      } else{

         $('.laawws-date-left.mon').find('input[type=checkbox]').attr('checked', true);
         $('.laawws-date-left.tue').find('input[type=checkbox]').attr('checked', true);
         $('.laawws-date-left.wed').find('input[type=checkbox]').attr('checked', true);
         $('.laawws-date-left.thu').find('input[type=checkbox]').attr('checked', true);
         $('.laawws-date-left.fri').find('input[type=checkbox]').attr('checked', true);
         $('.laawws-date-left.mon-fri input[type=checkbox]').attr('checked', false);
      }

   });

   // Uncheck the checkbox Mon-Fri if any weekday is selected
   $(document).on('click', ".laawws-date-left.mon input[type=checkbox], .laawws-date-left.tue input[type=checkbox], .laawws-date-left.wed input[type=checkbox], .laawws-date-left.thu input[type=checkbox], .laawws-date-left.fri input[type=checkbox]", function (){

      if($(this).is(":checked")) {
         $('.laawws-date-left.mon-fri').find('input[type=checkbox]').attr('checked', false);
      }

   });

   // Show open hours or not.
   $(document).on('click', ".laawws-open-hrs-checkbox", function (){

      var laawws_address_check = $(this).is(":checked");
      if(laawws_address_check){
         $(".laawws-open-hrs-time-wrap").show(); 
      } else {
         $(".laawws-open-hrs-time-wrap").hide(); 
      }  
   });

});