    function hideYoucityList() { $('#city_win .youcity_content').stop().animate({opacity: 0,    top: "-=170",},300,function(){ $('#city_win').hide();})}
    function showYoucityList() {$('#city_win').show();  $('#city_win .youcity_content').stop().animate({opacity: 1,    top: "+=170",},300) }
    function hideYoucityAsk() {$('.Youcity_ask').hide();}    
    function showYoucityAsk() {$('.Youcity_ask').show();}

        $(document).ajaxComplete(function() {
            var Youcity = getYoucityCookie('Youcity'); 
            $('.cityName').text(Youcity);
            
            if($('input[name="customer[address.shipping][city]"]').length)
            {                
              var Youregion = getYoucityCookie('Youregion');
              var Youcountry = getYoucityCookie('Youcountry');
              $('[name="customer[address.shipping][country]"] option').removeAttr('selected'); 
              $('[name="customer[address.shipping][country]"] option[value='+Youcountry+']').attr('selected','selected');
              $('[name="customer[address.shipping][region]"] option').removeAttr('selected');
              $('[name="customer[address.shipping][region]"] option[value='+Youregion+']').attr('selected','selected');
              $('input[name="customer[address.shipping][city]"]').val(Youcity);
            }  
        }); 
    

    $(document).ready(function() { 
        var youcityHtml = $('.Youcity_ask').html();
        var citywin = $('#city_win').html();
        $('#city_win').remove();
        $('.Youcity_ask').remove();
        $('#city_frontend_link').prepend('<div class="Youcity_ask" >'+youcityHtml+'</div>');
        $('body').prepend('<div id="city_win">'+citywin+'</div>');
        hideYoucityAsk();
        
      if(getYoucityCookie('Youcity')=='')
       {
            $.ajax({
                    type: 'POST',
                    url: $.youcityPluginUrl,
                    dataType: 'json'})
                    .done(function(html)
                    {
                        if($.youcityWindows == 0)
                        {
                            showYoucityAsk();
                        } 
                       $('.Youcity_ask .Youcity_city').text(html.data.city); 
                       document.cookie = "Youcity="+encodeURI(html.data.city)+"; path=/;";
                       document.cookie = "Youregion="+html.data.region+"; path=/;";
                       document.cookie = "Youcountry="+html.data.country+"; path=/;";
                       $('.cityName').text(html.data.city);
                    }); 
       }
       else
       {
            var Youcity = getYoucityCookie('Youcity'); 

            $('.cityName').text(Youcity);
            
            if($('input[name="customer[address.shipping][city]"]').length)
            {                
              var Youregion = getYoucityCookie('Youregion');
              var Youcountry = getYoucityCookie('Youcountry');
              $('[name="customer[address.shipping][country]"] option').removeAttr('selected'); 
              $('[name="customer[address.shipping][country]"] option[value='+Youcountry+']').attr('selected','selected');
              $('[name="customer[address.shipping][region]"] option').removeAttr('selected');
              $('[name="customer[address.shipping][region]"] option[value='+Youregion+']').attr('selected','selected');
              $('input[name="customer[address.shipping][city]"]').val(Youcity);
            }  
       }
       
       
       //change list by country
       function eachList(){
       $('.country-changer li').each(function(){
            var dataYouCity = $(this).data('youcity');
            if($(this).hasClass('active')){
                $('.city-changer ul').hide();
                $('.city-changer ul[data-youcitylist='+dataYouCity+']').show();
            }
       });
       }
       eachList();
       $('.country-changer li').click(function(){
            $('.country-changer li').removeClass('active')
            $(this).addClass('active');
            eachList();
       });

   //new code for Youcity
   $(".auto-city-input input").on('keyup',function(e){
       var len = $(this).val().length;
       var query = $(this).val();
       if(len <= 1)
       {
            $('.auto-city-input #find_city').empty().hide();
       }
       
       if(len > 1)
       {
          if((e.keyCode >= 38 && e.keyCode <= 40) || e.keyCode == 13)
          { 
            if($('.auto-city-input #find_city').is(':visible'))
            {
                if($('.auto-city-input #find_city li').hasClass('active'))
                {
                    if(e.keyCode == 40)
                    {
                        var next = $('.auto-city-input #find_city li.active').next().index();
                        if(next == -1)
                        {
                            next = 0;
                        }
                        $('.auto-city-input #find_city li.active').removeClass('active');
                        $('.auto-city-input #find_city li:eq('+next+')').addClass('active');
                    }
                    else if(e.keyCode == 38)
                    {
                        var prev = $('.auto-city-input #find_city li.active').prev().index();
                        $('.auto-city-input #find_city li.active').removeClass('active');
                        $('.auto-city-input #find_city li:eq('+prev+')').addClass('active');
                    }
                    $(".auto-city-input input").val($('.auto-city-input #find_city li.active #city_active').text());
                    
                    if(e.keyCode == 13)
                    {
                        var country = $('.auto-city-input #find_city li.active a').data('country');
                        var region = $('.auto-city-input #find_city li.active a').data('region');
                        var city = $('.auto-city-input #find_city li.active #city_active').text();
                        $(".auto-city-input input").val('');
                        $('.cityName').text(city);
                        $('.auto-city-input #find_city').empty().hide();
                        setYoucityCookie(city,region,country);
                        hideYoucityList();
                    }
                }
                else
                {
                    $('.auto-city-input #find_city li:eq(0)').addClass('active');
                    $(".auto-city-input input").val($('.auto-city-input #find_city li:eq(0) #city_active').text());
                }     
            } 
          }
          else
          {
            $.post($.youcitySearchUrl,{query:query},function(response){
                var html = '';
                $.each(response.data.search,function(key,value){
                    html = '<li><a data-region="'+value[2]+'" data-country="'+value[4]+'" href=""><span id="city_active">'+value[1]+'</span> ('+value[5]+'<span style="font-weight:bold;">'+value[6]+'</span>)</a></li>'+html;
                });
                if(response.data.search != 'fail')
                {
                    $('.auto-city-input #find_city').empty().show().html(html);
                    clickYoucityCity();        
                }
                else
                {
                    $('.auto-city-input #find_city').empty().hide();
                } 
            },'json');
          } 
       }
   }); 
   
    clickYoucityCity();  
 
    //show-hide model window
    $('#city_win .youcity-close').on('click',function(){
            hideYoucityList();
        });
        
    $("#city_win div.grey_bg").on('click',function() {
            hideYoucityList();
        });
    $("#find_city").on('mouseleave',function(){
        $('.auto-city-input #find_city').empty().hide();
    });

    $('#city_select_link').on('click',function(e){
        e.preventDefault();
        showYoucityList();
    });            
                
}); 
    function clickYoucityCity()
    {
        $('.city_list a, .auto-city-input a').on('click',function(e){
        e.preventDefault();
        var country = $(this).data('country');
        var region = $(this).data('region');
        var city = $(this).find('#city_active').text();
        $(".auto-city-input input").val('');
        $('.cityName').text(city);
        $('.auto-city-input #find_city').empty().hide();
        setYoucityCookie(city,region,country);
        hideYoucityList();
       });
    }       
            
    function setYoucityCookie(city,region,country)
    {
        document.cookie = "Youcity="+encodeURI(city)+"; path=/;";
        document.cookie = "Youregion="+region+"; path=/;";
        document.cookie = "Youcountry="+country+"; path=/;";
    }        
            
    function getYoucityCookie(cname)
                {
                 var name = cname + '=';
                 var ca = document.cookie.split(';');
                 for(var i=0; i<ca.length; i++) 
                     {
                      var c = ca[i].trim();
                      if (c.indexOf(name)==0) return decodeURI(c.substring(name.length,c.length));
                     }
                 return '';
                } 
                
   function deleteYoucityCookie(name) {document.cookie = name+'=; expires=Thu, 01 Jan 1970 00:00:00 GMT';}
   
   
   

   
   
   
   
    