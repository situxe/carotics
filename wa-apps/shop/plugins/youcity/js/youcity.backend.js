 $(document).ready(function(){
    
     $(".auto-city-input input").on('keyup',function(e){
       var len = $(this).val().length;
       var query = $(this).val();
       var country = $(this).data('country');
       var that = $(this).closest('div');
       if(len <= 1)
       {
            that.find('#find_city').empty().hide();
       }
       
       if(len > 1)
       {
          if((e.keyCode >= 38 && e.keyCode <= 40) || e.keyCode == 13)
          { 
            if(that.find('#find_city').is(':visible'))
            {
                if(that.find('#find_city li').hasClass('active'))
                {
                    if(e.keyCode == 40)
                    {
                        var next = that.find('#find_city li.active').next().index();
                        if(next == -1)
                        {
                            next = 0;
                        }
                        that.find('#find_city li.active').removeClass('active');
                        that.find('#find_city li:eq('+next+')').addClass('active');
                    }
                    else if(e.keyCode == 38)
                    {
                        var prev = that.find('#find_city li.active').prev().index();
                        if(prev == -1)
                        {
                            prev = parseInt(that.find('#find_city li').length)-1;
                        }
                        that.find('#find_city li.active').removeClass('active');
                        that.find('#find_city li:eq('+prev+')').addClass('active');
                        console.log(prev);
                    }
                    $(this).val(that.find('#find_city li.active #city_active').text());
                    
                    if(e.keyCode == 13)
                    {
                        var city = that.find('#find_city li.active #city_active').text();
                        var country = that.find('#find_city li.active a').data('country');
                        var region = that.find('#find_city li.active a').data('region');
                        if(that.hasClass('default_city'))
                        {
                            that.find('input[name="settings[default_city]"]').val(city);
                            that.find('input[name="settings[default_country]"]').val(country);
                            that.find('input[name="settings[default_region]"]').val(region);
                            that.find('#find_city').empty().hide();
                        }
                        else
                        {
                            $.post('?plugin=youcity&module=backend&action=addyoucity',{city:city, country:country, region:region},function(response){
                               if(response.data.message == 'ok')
                               {
                                  that.closest('.city_list').find('.zebra').append('<li><a href="">'+city+'</a><a data-id="'+response.data.id+'" href="#" class="city-del"><i class="icon16 delete"></i></a></li>')
                               }
                               that.find('input').val('');
                               that.find('#find_city').empty().hide();
                            },'json');
                        }
                    }
                }
                else
                {
                    that.find('#find_city li:eq(0)').addClass('active');
                    $(this).val(that.find('#find_city li:eq(0) #city_active').text());
                }     
            } 
          }
          else
          {
            $.post('?plugin=youcity&module=backend&action=searchyoucity',{query:query , country:country},function(response){
                var html = '';
                $.each(response.data.search,function(key,value){
                    html = '<li><a data-region="'+value[2]+'" data-country="'+value[4]+'" href=""><span id="city_active">'+value[1]+'</span> ('+value[5]+'<span style="font-weight:bold;">'+value[6]+'</span>)</a></li>'+html;
                });
                if(response.data.search != 'fail')
                {
                    that.find('#find_city').empty().show().html(html);     
                }
                else
                {
                    that.find('#find_city').empty().hide();
                } 
            },'json');
          } 
       }
   });
   
   $('.auto-city-input a').live('click',function(e){
        e.preventDefault();
        var country = $(this).data('country');
        var region = $(this).data('region');
        var city = $(this).find('#city_active').text();
        var that = $(this).closest('.city_list');
        var tr = $(this).closest('div');
        if(tr.hasClass('default_city'))
        {
            tr.find('input[name="settings[default_city]"]').val(city);
            tr.find('input[name="settings[default_country]"]').val(country);
            tr.find('input[name="settings[default_region]"]').val(region);
            tr.find('#find_city').empty().hide();
        }
        else
        {
            $.post('?plugin=youcity&module=backend&action=addyoucity',{city:city, country:country, region:region},function(response){
               if(response.data.message == 'ok')
               {
                  that.find('.zebra').append('<li><a href="">'+city+'</a><a href="#" data-id="'+response.data.id+'" class="city-del"><i class="icon16 delete"></i></a></li>')
               }
               that.find('input').val('');
               that.find('#find_city').empty().hide(); 
            },'json');
        }
       });  
       
       
     $('.city_list a.city-del').live('click',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var tr = $(this).closest('li');

            $.post('?plugin=youcity&module=backend&action=deleteyoucity',{id:id},function(response){
               if(response.data.message == 'ok')
               {
                  tr.remove();
               }
            },'json');
       });    
    
    
$('.status_country').iButton( { labelOn : "", labelOff : "", className: 'mini', resizeHandle: false, resizeContainer: true });
$('#recent_shop_recent_count').iButton( { labelOn : "", labelOff : "", className: 'mini', resizeHandle: false, resizeContainer: true });
//$('#reset_tpls').iButton( { labelOn : "", labelOff : "", className: 'mini', resizeHandle: false, resizeContainer: true });

 //change list by country
   function eachList(){
   $('.country-changer li').each(function(){
        var dataYouCity = $(this).data('youcity');
        if($(this).hasClass('active')){
            $('.city-changer .city_list').hide();
            $('.city-changer .city_list[data-youcitylist='+dataYouCity+']').show();
        }
   });
   }
   eachList();
   $('.country-changer li').click(function(){
        $('.country-changer li').removeClass('active')
        $(this).addClass('active');
        eachList();
   }); 
});

$(function() {
        var ids = "sf-template";
            var c = CodeMirror.fromTextArea(document.getElementById(ids), {
                mode: "text/html",
                tabMode: "indent",
                height: "dynamic",
                lineWrapping: true
            });
    });