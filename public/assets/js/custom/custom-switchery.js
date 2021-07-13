/*
---------------------------------
    : Custom - Switchery js :
---------------------------------
*/
!function($) {
  "use strict";
      /* -- Switchery - Colored Switches -- */
       makeSwitchery('.js-switch-primary',{ color: '#0080ff' });
       makeSwitchery('.js-switch-secondary',{ color: '#93b4d4' });
       makeSwitchery('.js-switch-success',{ color: '#18d26b' });
       makeSwitchery('.js-switch-danger',{ color: '#ff3f3f' });
       makeSwitchery('.js-switch-warning',{ color: '#ffa800' });
       makeSwitchery('.js-switch-info',{ color: '#00b8d4' });
       makeSwitchery('.js-switch-light',{ color: '#d4d8de' });
       makeSwitchery('.js-switch-dark',{ color: '#263a5b' });

      /* -- Switchery - Small Switches -- */
       makeSwitchery('.js-switch-primary-small',{ color: '#0080ff' , size: 'small'});
       makeSwitchery('.js-switch-secondary-small',{ color: '#93b4d4' , size: 'small'});
       makeSwitchery('.js-switch-success-small',{ color: '#18d26b' , size: 'small'});
       makeSwitchery('.js-switch-danger-small',{ color: '#ff3f3f' , size: 'small'});
       makeSwitchery('.js-switch-warning-small',{ color: '#ffa800' , size: 'small'});
       makeSwitchery('.js-switch-info-small',{ color: '#00b8d4' , size: 'small'});
       makeSwitchery('.js-switch-light-small',{ color: '#d4d8de' , size: 'small'});
       makeSwitchery('.js-switch-dark-small',{ color: '#263a5b' , size: 'small'});

      /* -- Switchery - Large Switches -- */
       makeSwitchery('.js-switch-primary-large',{ color: '#0080ff' , size: 'large'});
       makeSwitchery('.js-switch-secondary-large',{ color: '#93b4d4' , size: 'large'});
       makeSwitchery('.js-switch-success-large',{ color: '#18d26b' , size: 'large'});
       makeSwitchery('.js-switch-danger-large',{ color: '#ff3f3f' , size: 'large'});
       makeSwitchery('.js-switch-warning-large',{ color: '#ffa800' , size: 'large'});
       makeSwitchery('.js-switch-info-large',{ color: '#00b8d4' , size: 'large'});
       makeSwitchery('.js-switch-light-large',{ color: '#d4d8de' , size: 'large'});
       makeSwitchery('.js-switch-dark-large',{ color: '#263a5b' , size: 'large'});

      /* -- Switchery - Multicolor Switches -- */
       makeSwitchery('.js-switch-primary-multicolor',{ color: '#0080ff' , jackColor: '#dbe5fd'});
       makeSwitchery('.js-switch-secondary-multicolor',{ color: '#93b4d4' , jackColor: '#e9eaed'});
       makeSwitchery('.js-switch-success-multicolor',{ color: '#18d26b' , jackColor: '#a5ecc4' });
       makeSwitchery('.js-switch-danger-multicolor',{ color: '#ff3f3f' , jackColor: '#ffe4e6'});
       makeSwitchery('.js-switch-warning-multicolor',{ color: '#ffa800' , jackColor: '#fef7e6' });
       makeSwitchery('.js-switch-info-multicolor',{ color: '#00b8d4' , jackColor: '#c7ecee'});
       makeSwitchery('.js-switch-light-multicolor',{ color: '#d4d8de' , jackColor: '#e2e6ea'});
       makeSwitchery('.js-switch-dark-multicolor',{ color: '#263a5b', jackColor: '#7e7e7e' });

      /* -- Switchery - On-Off Multicolor Switches -- */
       makeSwitchery('.js-switch-primary-multicolor-on-off',{ color: '#0080ff' , secondaryColor: '#949ca9', jackColor: '#dbe5fd', jackSecondaryColor: '#e9eaed' });
       makeSwitchery('.js-switch-secondary-multicolor-on-off',{ color: '#93b4d4' , secondaryColor: '#0080ff', jackColor: '#e9eaed', jackSecondaryColor: '#dbe5fd'});
       makeSwitchery('.js-switch-success-multicolor-on-off',{ color: '#18d26b' , secondaryColor: '#ff3f3f', jackColor: '#a5ecc4', jackSecondaryColor: '#ffe4e6' });
       makeSwitchery('.js-switch-danger-multicolor-on-off',{ color: '#ff3f3f' , secondaryColor: '#18d26b', jackColor: '#ffe4e6', jackSecondaryColor: '#a5ecc4' });
       makeSwitchery('.js-switch-warning-multicolor-on-off',{ color: '#ffa800' , secondaryColor: '#00b8d4', jackColor: '#fef7e6', jackSecondaryColor: '#c7ecee' });
       makeSwitchery('.js-switch-info-multicolor-on-off',{ color: '#00b8d4' , secondaryColor: '#ffa800', jackColor: '#c7ecee', jackSecondaryColor: '#fef7e6'});
       makeSwitchery('.js-switch-light-multicolor-on-off',{ color: '#d4d8de' , secondaryColor: '#263a5b', jackColor: '#e2e6ea', jackSecondaryColor: '#7e7e7e'});
       makeSwitchery('.js-switch-dark-multicolor-on-off',{ color: '#263a5b', secondaryColor: '#d4d8de', jackColor: '#7e7e7e', jackSecondaryColor: '#e2e6ea' });

}(window.jQuery);

function makeSwitchery(cls,options){
    var primary = $(cls);
    $.each( primary, function(index ) {
        var switchery = new Switchery(this, options);
    });
}
