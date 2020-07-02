$(document).ready(function()
{
  var switchClasses;
  
  $('.fl-switch').each(function()
  {
    var targetSelector = $(this).data('target');
    var target = $(targetSelector);
    
    if(target.length != 0)
    {
      var activeClass = sessionStorage.getItem(targetSelector);
      var switchers = $(this).find('.fl-switcher');
      var activeSwitcher;
      
      if(activeClass)
      {
        activeSwitcher = $(this).find('[data-class="' + activeClass + '"]');
      }
      else
      {
        activeSwitcher = $(this.getElementsByClassName('fl-switcher')[0]);
        
        activeClass = (activeSwitcher.data('class')) ? activeSwitcher.data('class') : '';
      }
      
      if(activeClass && activeSwitcher.length != 0)
      {
        var tmp = [];
        
        switchers.each(function()
        {
          tmp.push($(this).data('class'));
        });
        
        switchClasses = tmp.join(' ');
        
        target.removeClass(switchClasses);
        target.addClass(activeClass);
        activeSwitcher.addClass('fl-active');
        
        sessionStorage.setItem(targetSelector, activeClass);
      }
    }
  });
  
  $('.fl-switcher').click(function()
  {
    if(!$(this).hasClass('fl-active'))
    {
      var targetSelector = $(this).parent().data('target');
      var target = $(targetSelector);
      
      if(target.length != 0)
      {
        var active = $(this).parent().find('.fl-active');
        var activeClass = $(this).data('class');
        
        target.removeClass(switchClasses);
        target.addClass(activeClass);
        
        active.removeClass('fl-active');
        $(this).addClass('fl-active');
        
        sessionStorage.setItem(targetSelector, activeClass);
      }
    }
    
    $(window).trigger('resize');
  });
});

jQuery(function($)
{
  // fit footer
  (function (main, meta, fitFooter)
  {
    if (!main.length)
      return;
    
    fitFooter = function (){
      
      main.css('min-height', '');
      
      meta = document.body.getBoundingClientRect();
      
      if (meta.height <= window.innerHeight)
      {
        main.css('min-height', (main.outerHeight() + (window.innerHeight - meta.height)) + 'px');
      }
      
      return fitFooter;
    };

    UIkit.$win.on('load resize', fitFooter());

  })($('main'));
  
  
  
  
  // (function(nav){
    
    // if (!nav.length)
      // return;
    
    // navHeight = function ()
    // {
      // nav.css('height', '');
      // nav.css('margin-bottom', '');
      
      // var height = nav.outerHeight();
      
      // console.log(height);
      
      // nav.css('height', 0);
      // nav.css('margin-bottom', height);
      
      // return navHeight;
    // };

    // UIkit.$win.on('load resize', navHeight());

  // })($('#nav'));
  
  
});